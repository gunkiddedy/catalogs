<?php

namespace App\Http\Controllers\Api;

use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategoryResource;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::withCount(['products' => function ($query) {
                $query->withFilters();
            }])
            ->get();

        return SubCategoryResource::collection($subcategories);
    }
}
