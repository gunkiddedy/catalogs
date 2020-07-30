<?php

namespace App\Http\Controllers\Api;

use App\Category;
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

    // [ 
    //     {
    //         id: 'category a',
    //         label: 'category a',
    //         children: [ 
    //             {
    //                 id: 'sub category a1',
    //                 label: 'sub category a1',
    //             }, 
    //             {
    //                 id: 'sub category a2',
    //                 label: 'sub category a2',
    //             } 
    //         ],
    //     },
    //     {
    //         id: 'category b',
    //         label: 'category b',
    //         children: [ 
    //             {
    //                 id: 'sub category b1',
    //                 label: 'sub category b1',
    //             }, 
    //             {
    //                 id: 'sub category b2',
    //                 label: 'sub category b2',
    //             } 
    //         ],
    //     }, 
    // ],

    public function mapingCategory()
    {
        $cats = DB::select('SELECT c.id,c.name AS cat_name,sc.id AS sub_id,sc.name AS subcat_name
        FROM categories c
        JOIN subcategories sc ON c.id=sc.category_id
        ORDER BY sc.category_id');

        $arr = array();

        foreach($cats as $cat){
            $arr[] = $cat;
        }

        return response()->json($arr);
    }
}
