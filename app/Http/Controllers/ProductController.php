<?php

namespace App\Http\Controllers;

use App\User;
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
        // $products = DB::table('view_images')->orderBy('id', 'desc')->get();
        $products = DB::table('view_images')->orderBy('id', 'desc')->paginate(9);
        $category = DB::table('categories')->get();
        $subcategory = DB::table('subcategories')->get();
        $minPrice = DB::table('products')->min('price');
        $maxPrice = DB::table('products')->max('price');
        $brands = Product::all()->take(7);
        // dd($maxPrice);
        return view('products.index', [
            'products' => $products,
            'category' => $category,
            'subcategory' => $subcategory,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'brands' => $brands,
        ]);
    }


    public function details($id)
    {
        $product = Product::find($id);
        $images = DB::table('view_product_images')->where('product_id', $id)->get();
        $owner = Product::find($id)->user;
        $category = Product::find($id)->category;
        $subcategory = Product::find($id)->subcategory;
        // dd($subcategory);
        return view('products.detail', [
            'product' => $product,
            'images' => $images,
            'owner' => $owner,
            'category' => $category,
            'subcategory' => $subcategory,
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
            'brand' => 'required',
            'price' => 'required',
            'hs_code' => 'required|min:3',
            'description'=> 'required|min:20',
            'category_id' => 'required',
            'images' => 'required',
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
                    $path = $image->storeAs('images', $product->id.'-'.$filename, 'public');
                    // dd($imagePath);
                    ProductImage::create([
                        'name' => $product->name,
                        'product_id' => $product->id,
                        'image_path' => $path,
                    ]);
                }
            }

        });

        return redirect('/member')->with('success', 'data added successfully!');
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

        $images = $request->file('images');
        
        $product->save();
        
        // check if has image
        if($request->hasFile('images')) {
            $imgp = DB::table('product_images')->where('product_id', $id)->get();
            for($i=0; $i<count($imgp); $i++){
                if($imgp[$i]->image_path){
                    Storage::delete('/public/'.$imgp[$i]->image_path);
                }
            }
            foreach($images as $image) {
                $filename = $image->getClientOriginalName();
                $path = $image->storeAs('images', $product->id.'-'.$filename, 'public');
                // ProductImage::where('product_id', $id)->update([
                //     'name' => $product->name,
                //     'image_path' => $path,
                // ]);
                DB::table('product_images')
                ->updateOrInsert(
                    ['name' => $product->name],
                    ['image_path' => $path]
                );
            }
        }
        else{
            DB::table('product_images')->update([
                'name' => $product->name
            ]);
        }

        return redirect('/member')->with('success', 'data updated successfully');
    }

    public function destroy($id)
    {
        $images = ProductImage::where('product_id', $id)->get();
        foreach($images as $image){
            Storage::disk('public')->delete($image->image_path);
        }

        ProductImage::where('product_id', $id)->delete();
        Product::where('id', $id)->delete();
        return redirect('/member')->with('success', 'data deleted successfully');
    }

    
}
