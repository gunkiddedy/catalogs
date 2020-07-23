<?php

namespace App\Http\Controllers\Api;

use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductDetailsResource;

class ProductDetailsController extends Controller
{
    public function index()
    {
        // $productImage = ProductImage::get();
        // return ProductImageResource::collection($productImage);
        // ProductImage::where('product_id', $product->id)->with('product')->first()->image_path;
        
        // $grouped = $productImage->groupBy('product_id');
        
        // $grouped->toArray();
        $image = DB::select('SELECT p.id,p.name 
            AS product_name,p.brand,p.price,p.description,u.name 
            AS company_name,i.image_path
            FROM products p 
            JOIN users u ON u.id=p.user_id
            JOIN product_images i ON i.product_id=p.id
            GROUP BY id'
        );

        return ProductDetailsResource::collection($image);
        // $productImage = \App\ProductImage::with('product')->get();


        // return $image;

        // return ProductImageResource::collection($productImage)->where('product_id', $id)->first();
    }
}
