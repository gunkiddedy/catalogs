<?php

namespace App\Http\Controllers;

use App\User;
use App\ViewProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // show member profile
    public function profile($id)
    {        
        // $user = User::find($id);
        $user = ViewProfile::find($id);
        return view('profile.profile', ['user' => $user]);
    }

    // edit profile member
    public function editProfile($id)
    {
        // $users = DB::table('view_profile')->where('id', $id)->get();
        $user = User::find($id);

        $provinsi = DB::table('provinsi')->get();
        $kabupaten = DB::table('kabupaten')->get();
        $kecamatan = DB::table('kecamatan')->get();
        
        // foreach($users as $user) $profile = $user;

        return view('profile.edit_profile', [
            'user' => $user,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
        ]);
    }

    // update member profie
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|min:9|max:12',
            'provinsi_id' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan_id' => 'required',
            'address' => 'required|min:5',
            'nib' => 'required',
        ]);

        $users = User::find($id);
        // dd($users);
        $users->name =  $request->get('name');
        $users->email =  $request->get('email');
        $users->phone =  $request->get('phone');
        $users->tkdn =  $request->get('tkdn');
        $users->provinsi_id =  $request->get('provinsi_id');
        $users->kabupaten_id =  $request->get('kabupaten_id');
        $users->kecamatan_id = $request->get('kecamatan_id');
        $users->address =  $request->get('address');
        $users->nib =  $request->get('nib');
        $users->additional_info =  $request->get('additional_info');
        $users->save();
        
        return redirect()->route('profile.show', $id)->with('success', 'data updated successfully!');
    }

    public function updateAvatar(Request $request, $id)
    {
        // check if has file
        if($request->hasfile('avatar')) {
            $filename = $request->avatar->getClientOriginalName();
            $path = $request->avatar->storeAs('images', $filename, 'public');
            // dd($path);
            User::find($id)->update(['avatar' => $path]);
        }
        
        return redirect()->back()->with('success', 'Avatar updated successfully!');
    }
}
