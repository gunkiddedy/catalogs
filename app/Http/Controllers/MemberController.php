<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    // dashboard index per member
    public function index()
    {
        $products = DB::table('view_products')->where('user_id', Auth::id())->orderBy('product_id', 'desc')->get();
        // $productImages = DB::table('view_product_image')->where('product_id', $id)->get();
        // dd($imagesArray);
        return view('member.index',[
            'products' => $products,
        ]);
    }

    // show member profile
    public function profile($id)
    {        
        $user = User::find($id);
        return view('member.profile', ['user' => $user]);
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

        return view('member.edit_profile', [
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
            'email' => 'required',
            'phone' => 'required|min:9',
            'provinsi_id' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan_id' => 'required',
            'address' => 'required|min:5',
            'nib' => 'required',
            'additional_info' => 'required'
        ]);

        $users = User::find($id);
        // dd($users);
        $users->name =  $request->get('name');
        $users->email =  $request->get('email');
        $users->phone =  $request->get('phone');
        $users->provinsi_id =  $request->get('provinsi_id');
        $users->kabupaten_id =  $request->get('kabupaten_id');
        $users->kecamatan_id = $request->get('kecamatan_id');
        $users->address =  $request->get('address');
        $users->nib =  $request->get('nib');
        $users->additional_info =  $request->get('additional_info');
        $users->save();

        return redirect('/member')->with('success', 'data updated successfully');
    }

    

}
