<?php

namespace App\Http\Controllers;

use App\ViewProfile;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function memberList()
    {
        $users = ViewProfile::where('role', 'member')->get();
        // dd($users);
        return view('admin.members', [
            'users' =>$users
        ]);
    }

}
