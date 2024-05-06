<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToDoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255'
        ]);
      
        ToDo::create([
          'task' => $request->task,
          'completed' => false,

            'user_id' => (Auth::user()->id),
        ]);
        return to_route('dashboard');

       
    }
}
