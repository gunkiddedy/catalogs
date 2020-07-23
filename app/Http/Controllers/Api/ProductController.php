<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    // public function index()
    // {
    //     return ProductResource::collection(Product::all());
    // }

    public function index()
    {
        $products = Product::withFilters()->paginate(20);
        // $image = \App\ProductImage::with('product')->get();
        // return $image;
        return ProductResource::collection($products);
    }
}
