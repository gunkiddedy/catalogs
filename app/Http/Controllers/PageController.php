<?php

namespace App\Http\Controllers;

use App\About;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function product()
    {
        $products = DB::table('view_images')->orderBy('id', 'desc')->get();
        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')->get();
        $minPrice = DB::table('products')->min('price');
        $maxPrice = DB::table('products')->max('price');
        $brands = Product::all()->take(7);
        // dd($maxPrice);
        return view('products.index', [
            'products' => $products,
            'category' => $category,
            'subcategory' => $subcategory,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'brands' => $brands,
        ]);
    }

    public function about()
    {
        $about = About::find(1);
        return view('pages.about', ['about' => $about]);
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
