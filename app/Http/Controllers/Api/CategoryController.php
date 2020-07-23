<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    // public function index()
    // {
    //     return CategoryResource::collection(Category::all());
    // }

    public function index()
    {
        $categories = Category::withCount(['products' => function ($query) {
                $query->withFilters();
            }])
            ->get();

        return CategoryResource::collection($categories);
    }
}
