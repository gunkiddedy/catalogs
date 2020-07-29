<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = \App\Category::paginate();
        $subcategories = \App\SubCategory::paginate();
        // dd($categories);
        return view('admin.category', [
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    public function addCategory()
    {
        return view('admin.add-category');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3',
        ]); 

        DB::transaction(function () use ($request) {
            $name = $request->name;
            Category::create([
                'name' => $name
            ]);
        });

        return redirect('/category')->with('success', 'data added successfully!');
    }

    public function editCategory($id)
    {   
        $category = Category::find($id);
        return view('admin.edit-category', ['category' => $category]);
    }

    public function updateCategory(Request $request, $id)
    {    
        $request->validate([
            'name' => 'required|min:3',
        ]);

        $category = Category::find($id);
        $category->name =  $request->get('name');
        $category->save();
        
        return redirect('/category')->with('success', 'data updated successfully!');
    }
    // end category

    // ================================================subcategory
    public function addSubCategory()
    {
        $categories = Category::all();
        return view('admin.add-subcategory', ['categories' => $categories]);
    }

    public function storeSubCategory(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3',
            'category_id' => 'required'
        ]); 

        DB::transaction(function () use ($request) {
            $name = $request->name;
            $category_id = $request->category_id;

            SubCategory::create([
                'name' => $name,
                'category_id' => $category_id
            ]);
        });

        return redirect('/category')->with('success_subcat', 'data added successfully!');
    }

    public function editSubCategory($id)
    {   
        $subcategory = SubCategory::find($id);
        $categories = Category::all();
        return view('admin.edit-subcategory', [
            'subcategory' => $subcategory,
            'categories' => $categories
        ]);
    }

    public function updateSubCategory(Request $request, $id)
    {    
        $request->validate([
            'name' => 'required|min:3',
            'category_id' => 'required',
        ]);

        $subcategory = SubCategory::find($id);
        $subcategory->name =  $request->get('name');
        $subcategory->category_id = $request->get('category_id');

        $subcategory->save();
        
        return redirect('/category')->with('success_subcat', 'data added successfully!');
    }
}
