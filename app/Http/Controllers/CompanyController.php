<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function FunctionName(Type $var = null)
    {
        # code...
        return view('profile.company-profile');
    }

    // show member profile
    public function detail($id)
    {        
        // $user = User::find($id);
        $user = User::find($id);
        $provinsi = User::find($id)->provinsi;
        $kabupaten = User::find($id)->kabupaten;
        $kecamatan = User::find($id)->kecamatan;
        $products = User::find($id)->products;
        //$image = DB::table('product_images')->where('product_id', $id)->first();
        // dd($image);
        return view('profile.company-detail', [
            'user' => $user,
            'products' => $products,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            // 'image' => $image,
        ]);
    }

    // public function search(Request $request)
    // {
    //     $company = User::find()->products;
    //     // $products = Product::where('name', 'like', '%'.$request->search.'%')->paginate(12);
    //     // $products = User::find('name', 'like', '%'.$request->search.'%')->paginate(12);
    // }
}
