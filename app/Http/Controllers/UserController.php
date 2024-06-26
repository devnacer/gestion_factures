<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Users List|Add User|Edit User|Delete User', ['only' => ['index']]);
        $this->middleware('permission:Add User', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit User', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete User', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $roles = Role::pluck('name', 'name')->all();
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|confirmed',
            'roles_name' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        $rolesNameArray = $request->input('roles_name');
        //convert to array in int values
        $rolesNameArray = array_map('intval', $rolesNameArray);
        $user->assignRole($rolesNameArray);



        // $user->assignRole($request->input('roles_name'));
        return redirect()->route('users.index')
            ->with('success', trans('messages.add'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $user = User::find($id);
    //     return view('users.show', compact('user'));
    // }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        // $roles = Role::pluck('name', 'name')->all();
        $roles = Role::all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles_name' => 'required',
            'password' => 'nullable|min:7|confirmed'

        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = \Illuminate\Support\Arr::except($input, ['password']);
            $input = \Illuminate\Support\Arr::except($input, ['password_confirmation']);
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $rolesNameArray = $request->input('roles_name');
        //convert to array in int values
        $rolesNameArray = array_map('intval', $rolesNameArray);
        $user->assignRole($rolesNameArray);

        return redirect()->route('users.index')
            ->with('success', trans('messages.edit'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success', trans('messages.delete'));
    }
}
