<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index()
    {
        $products = DB::table('view_products')->where('user_id', Auth::id())->orderBy('product_id', 'desc')->get();
        // $productImages = DB::table('view_product_image')->where('product_id', $id)->get();
        // dd($imagesArray);
        return view('member.index',[
            'products' => $products,
        ]);
    }

    public function profile($id)
    {
        $users = DB::table('view_profile')->where('id', $id)->get();
        foreach($users as $user)
            $profile = $user;
        return view('member.profile', ['user' => $profile]);
    }

    public function editProfile($id)
    {
        $provinsi = DB::table('provinsi')->get();
        $kabupaten = DB::table('kabupaten')->get();
        $kecamatan = DB::table('kecamatan')->get();
        $users = DB::table('view_profile')->where('id', $id)->get();
        
        foreach($users as $user)
            $profile = $user;

        return view('member.edit_profile', [
            'user' => $profile,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            ]);
    }

    public function updateProfile(Type $var = null)
    {
        # code...
    }

    

}
