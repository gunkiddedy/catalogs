<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'member')->get();
        // dd($users);
        return view('admin.members', [
            'users' =>$users
        ]);
    }
}
