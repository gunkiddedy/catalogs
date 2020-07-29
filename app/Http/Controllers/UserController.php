<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit($id)
    {   
        $user = \App\User::find($id);
        return view('admin.edit_user', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {    
        $user = \App\User::find($id);
        $user->is_active = $request->get('is_active');
        $user->save();
        
        return redirect('/members')->with('success', 'data updated successfully');
    }

}
