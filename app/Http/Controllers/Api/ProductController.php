<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withFilters()->orderBy('id', 'desc')->paginate(12);

        return ProductResource::collection($products);
    }

    public function search(Request $request)
    {
        $products = Product::withFilters()
                        ->where('name', 'like', '%'.$request->keyword.'%')
                        ->orWhere('company_name', 'like', '%'.$request->keyword.'%')->paginate(12);

        return ProductResource::collection($products);
    }

    public function companyProducts($id)
    {
        $products = Product::where('user_id', $id)->orderBy('id', 'desc')->paginate(8);

        return ProductResource::collection($products);
    }

    public function searchProductCompany(Request $request, $id)
    {
        // $products = Product::where('user_id', $id)
        //     ->orWhere('name', 'like', '%'.Request('keyword').'%')
        //     ->orderBy('id', 'desc')->paginate(8);

        $products = DB::table('products')->where([
            ['user_id', '=', $id],
            ['name', 'like', '%'.$request->keyword.'%']
        ])->paginate(8);

        // $products = DB::table('products')
        //     ->where('user_id', '=', $id)
        //     ->orWhere(function($query) {
        //         $query->where('name', 'like', '%'.$request->keyword.'%')
        //               ->where('brand', 'like', '%'.$request->keyword.'%');
        //     })->paginate(8);

        return ProductResource::collection($products);
    }
}
