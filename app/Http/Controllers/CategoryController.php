<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // public function index()
    // {
    //     $categories = \App\Category::all();
    //     $subcategories = \App\SubCategory::all();
    //     // dd($categories);
    //     return view('admin.category', [
    //         'categories' => $categories,
    //         'subcategories' => $subcategories,
    //     ]);
    // }

    public function index()
    {
        $categories = Category::withCount(['products' => function ($query) {
                $query->withFilters();}])->get();

        return CategoryResource::collection($categories);
    }

    public function subcategories()
    {
        $subcategories = SubCategory::withCount(['products' => function ($query) {
                $query->withFilters();}])->get();

        return SubCategoryResource::collection($subcategories);
    }
}
