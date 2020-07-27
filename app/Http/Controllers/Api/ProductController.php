<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withFilters()->paginate(12);
        // $image = \App\ProductImage::with('product')->get();
        // return $image;
        return ProductResource::collection($products);
    }

    public function search(Request $request)
    {
        $products = Product::withFilters()
            ->where('name', 'like', '%'.$request->search.'%')
            ->orWhere('company_name', 'like', '%'.$request->search.'%')->paginate(12);
        // $image = \App\ProductImage::with('product')->get();
        // return $image;
        return ProductResource::collection($products);
    }
}
