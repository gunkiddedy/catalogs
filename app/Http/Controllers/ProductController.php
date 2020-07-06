<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('view_images')->orderBy('id', 'desc')->get();
        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')->get();
        $minPrice = DB::table('products')->min('price');
        $maxPrice = DB::table('products')->max('price');
        // dd($maxPrice);
        return view('products.index', [
            'products' => $products,
            'category' => $category,
            'subcategory' => $subcategory,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ]);
    }

    public function create()
    {
        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')->get();
        
        return view('member.add_product', [
            'category' => $category,
            'subcat' => $subcategory
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'description'=> 'required',
        ]); 

        DB::transaction(function () use ($request) {
            $user_id = Auth::id();
            $name = $request->name;
            $brand = $request->brand;
            $price = $request->price;
            $description = $request->description;
            $category_id = $request->category_id;
            $subcategory_id = $request->subcategory_id;
            $hs_code = $request->hs_code;
            $sni = $request->sni;
            $images = $request->images;

            // insert to table product
            $product = Product::create([
                'name' => $name,
                'brand' => $brand,
                'price' => $price,
                'description' => $description,
                'category_id' => $category_id,
                'subcategory_id' => $subcategory_id,
                'user_id' => $user_id,
                'hs_code' => $hs_code,
                'sni' => $sni
            ]);

            // check if has file
            if($request->hasfile('images')) {
                // store each image into table product_image
                foreach($images as $image) {
                    $filename = $image->getClientOriginalName();
                    // dd($filename);
                    // $imagePath = Storage::disk('product_images')->put($product->name, $image);
                    // $imagePath = storeAs('images', $filename, 'public');
                    $path = $image->storeAs('images', $filename, 'public');
                    // dd($imagePath);
                    ProductImage::create([
                        'name' => $product->name,
                        'product_id' => $product->id,
                        'image_path' => $path,
                    ]);
                }
            }

        });

        return redirect('/dashboard');
    }

    public function edit($id)
    {   
        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')->get();

        $product = Product::find($id);
        return view('member.edit_product', ['product' => $product, 'category' => $category, 'subcat' => $subcategory]);
    }

    public function update(Request $request, $id)
    {    
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'description' => 'required',
            'hs_code' => 'required',
            'category_id' => 'required'
        ]);

        $product = Product::find($id);
        $product->name =  $request->get('name');
        $product->brand =  $request->get('brand');
        $product->price =  $request->get('price');
        $product->hs_code =  $request->get('hs_code');
        $product->category_id =  $request->get('category_id');
        $product->subcategory_id =  $request->get('subcategory_id');
        $product->description = $request->get('description');
        $product->save();

        return redirect('/dashboard')->with('success', 'data updated successfully');
    }

    public function destroy($id)
    {
        $images = ProductImage::where('product_id', $id)->get();
        foreach($images as $image){
            Storage::disk('public')->delete($image->image_path);
        }

        ProductImage::where('product_id', $id)->delete();
        Product::where('id', $id)->delete();
        return redirect('/dashboard')->with('success', 'data deleted successfully');
    }

    public function details($id)
    {
        $product = Product::find($id);
        $image = DB::table('view_images')->where('id', $id)->get();
        // dd($image);
        return view('products.detail', [
            'product' => $product,
            'image' => $image,
        ]);
    }

}
