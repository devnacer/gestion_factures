<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:Users Rights List|Add Role|Edit Role|Delete Role|View Role', ['only' => ['index']]);
        $this->middleware('permission:Add Role', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Role', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Role', ['only' => ['destroy']]);
        $this->middleware('permission:View Role', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('roles.index', compact('roles'));
        // ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('roles.create', compact('permissions'));
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
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $permissionArray = $request->input('permission');
        //convert to array in int values
        $permissionArray = array_map('intval', $permissionArray);
        $role->syncPermissions($permissionArray);
        return to_route('roles.index')->with('success', trans('messages.add'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();
        return view('roles.show', compact('role', 'rolePermissions'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
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
        // $this->validate($request, [
        //     // 'name' => 'required',
        //     'name' => 'required|name|unique:roles,name,' . $id,
        //     'permission' => 'required',
        // ]);
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $id,
            'permission' => 'required',
        ]);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $permissionArray = $request->input('permission');
        //convert to array in int values
        $permissionArray = array_map('intval', $permissionArray);
        $role->syncPermissions($permissionArray);
        return to_route('roles.index')->with('success', trans('messages.edit'));
    }
    public function stoddsre(Request $request)
    {

        $role = Role::create(['name' => $request->input('name')]);
        $permissionArray = $request->input('permission');
        //convert to array in int values
        $permissionArray = array_map('intval', $permissionArray);
        $role->syncPermissions($permissionArray);
        return to_route('roles.index')->with('success', trans('messages.edit'));
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
        Role::find($id)->delete();
        return redirect()->route('roles.index')->with('success', trans('messages.delete'));
    }
}
