<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function index()
    {
        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')->get();
        $products = DB::table('view_images')->orderBy('id', 'desc')->get();
        $minPrice = DB::table('products')->min('price');
        $maxPrice = DB::table('products')->max('price');
        // dd($maxPrice);
        return view('products.index', [
            'products' => $products,
            'category' => $category,
            'subcategory' => $subcategory,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ]);
    }
}
