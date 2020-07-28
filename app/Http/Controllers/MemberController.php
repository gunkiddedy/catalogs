<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    // dashboard index per member
    public function index()
    {
        // $products = DB::table('view_products')->where('user_id', Auth::id())->orderBy('product_id', 'desc')->get();
        // $productImages = DB::table('view_product_image')->where('product_id', $id)->get();
        // dd($imagesArray);
        $id = Auth::id();
        // $products = \App\User::find($id)->products;
        $products = \App\Product::where('user_id', $id)->orderby('id', 'desc')->paginate(10);
        // dd($productImages);
        return view('member.index',[
            'products' => $products,
        ]);
    }

}
