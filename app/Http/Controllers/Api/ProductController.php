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
        $products = Product::withFilters()->orderBy('id', 'desc')->paginate(12);
        // $image = \App\ProductImage::with('product')->get();
        // return $image;
        return ProductResource::collection($products);
    }

    public function search(Request $request)
    {
        $products = Product::withFilters()
            ->where('name', 'like', '%'.$request->keyword.'%')
            ->orWhere('company_name', 'like', '%'.$request->keyword.'%')->paginate(12);
        // $image = \App\ProductImage::with('product')->get();
        // return $image;
        return ProductResource::collection($products);
    }

    public function indexCompany($id)
    {
        $products = \App\User::find($id)->products->paginate(12);
        // $image = \App\ProductImage::with('product')->get();
        // return $image;
        return ProductResource::collection($products);
    }

    public function searchCompany(Request $request)
    {
        $products = Product::where('user_id', '=', $request->id)
        ->where(function ($query) {
            $query->where('name', 'like', '%'.$request->name.'%');
        })->paginate(12);
        // $image = \App\ProductImage::with('product')->get();
        // return $image;
        return ProductResource::collection($products);
    }
}
