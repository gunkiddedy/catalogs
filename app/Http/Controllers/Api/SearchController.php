<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    // public function search(Request $request)
    // {
    //     $products = \App\Product::where('name', $request->keywords)
    //         ->orWhere('company_name', $request->keywords)->get();

    //     return response()->json($products);
    // }

    // public function filter(Request $request)
    // {
    //     $category_id = $request->category_id;
    //     $category = \App\Product::where('category_id', $category_id)->get();

    //     return response()->json($category);
    // }

    public function search(Request $request)
    {
        $products = Product::orderBy('id', 'desc')->paginate(20);

        if ($request->has('category_id') && $request->has('subcategory_id')) {
            $products = Product::where('category_id', $request->category_id)
                ->where('subcategory_id', $request->subcategory_id)
                ->paginate(20);

            return response()->json($products);
        }

        else if ($request->has('category_id')) {
            $products = Product::where('category_id', $request->category_id)->paginate(20);

            return response()->json($products);
        }

        else if ($request->has('subcategory_id')) {
            $products = Product::where('subcategory_id', $request->subcategory_id)->withFilters()->paginate(20);

            return response()->json($products);
        }
        else
            return response()->json($products);
    }

}
