<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function mapingCategory()
    {
        $categories = Category::all();
        
        foreach($categories as $cat){
            $arrCat[] = [
                'id' => $cat->id,
                'label' => $cat->name,
                'children' => $this->findSubCategory($cat->id)
            ];
        }

        $arrayCategory = $arrCat;


        return response()->json($arrayCategory);
    }

    public function findSubCategory($id)
    {
        $subcategories = Category::find($id)->subcategories;
        $children = array();
        foreach($subcategories as $subcat){
            $children[] = ['id' => $subcat->id, 'label' => $subcat->name];
        }

        return $children;
    }

    public function getCategory()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function getSubCategory(Request $request)
    {
        $subcategories = SubCategory::where('category_id', $request->category_id)->get();
        return response()->json($subcategories);
    }

}
