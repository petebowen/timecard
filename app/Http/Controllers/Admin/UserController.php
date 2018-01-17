<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use Auth;

class UserController extends Controller
{
    public function index()
    {
    	return view('admin.user.index',['users' => User::orderBy('last_name')->get()]);
    	
    }

    public function show(\App\User $user)
    {
    	return view('admin/user.edit', ['user' => $user]);
    }

    public function update(Request $request, \App\User $user)
    {
    	$user->update($request->all());

    	return redirect()->back();
    }
}