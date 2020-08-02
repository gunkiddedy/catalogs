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

    // search product name or company name in home page
    public function search(Request $request)
    {
        $products = Product::withFilters()
                        ->where('name', 'like', '%'.$request->keyword.'%')
                        ->orWhere('company_name', 'like', '%'.$request->keyword.'%')->paginate(12);

        return ProductResource::collection($products);
    }

    public function findBySubCategory($id)
    {
        // $products = \App\SubCategory::find($id)->products->paginate(12);

        $products = Product::withFilters()->where('subcategory_id', '=', $id)->paginate(12);

        return ProductResource::collection($products);
        
        // dd($products);
    }


    // show products by company (user_id)
    public function companyProducts($id)
    {
        $products = Product::where('user_id', $id)->orderBy('id', 'desc')->paginate(8);

        return ProductResource::collection($products);
    }

    // search product in company detail page
    public function searchProductCompany(Request $request, $id)
    {
        $products = DB::table('products')->where([
            ['user_id', '=', $id],
            ['name', 'like', '%'.$request->keyword.'%']
        ])->paginate(8);

        return ProductResource::collection($products);
    }
}
