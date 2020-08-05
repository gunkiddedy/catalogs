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
        $user = User::find($id);
        $provinsi = User::find($id)->provinsi;
        $kabupaten = User::find($id)->kabupaten;
        $kecamatan = User::find($id)->kecamatan;
        return view('profile.profile', [
            'user' => $user,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
        ]);
    }

    // edit profile member
    public function editProfile($id)
    {
        // $users = DB::table('view_profile')->where('id', $id)->get();
        $user = User::find($id);

        $provinsi = DB::table('provinsis')->get();
        $kabupaten = DB::table('kabupatens')->get();
        $kecamatan = DB::table('kecamatans')->get();
        
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
            'phone' => 'required|min:9|max:15',
            'provinsi_id' => 'required',
            'kabupaten_id' => 'required',
            // 'kecamatan_id' => 'required',
            'zipcode' => 'required|min:5',
            'address' => 'required|min:5',
            'nib' => 'required|min:5|max:20',
        ]);

        $users = User::find($id);
        // dd($users);
        $users->is_active = 0;
        $users->name =  $request->get('name');
        $users->email =  $request->get('email');
        $users->phone =  $request->get('phone');
        $users->provinsi_id =  $request->get('provinsi_id');
        $users->kabupaten_id =  $request->get('kabupaten_id');
        // $users->kecamatan_id = $request->get('kecamatan_id');
        $users->zipcode = $request->get('zipcode');
        $users->address =  $request->get('address');
        $users->nib =  $request->get('nib');
        $users->additional_info =  $request->get('additional_info');
        $users->save();

        DB::table('products')->where('user_id', $id)->update(['company_name' => $request->get('name')]);
        
        // return redirect()->route('profile.show', $id)->with('success', 'data updated successfully!');
        return redirect()->route('company.detail', $id)->with('success', 'data updated successfully!');
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
