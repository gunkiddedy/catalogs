<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('user')->orderBy('id', 'desc')->paginate(16);

        return view('products.index', ['products' => $products]);
    }


    public function details($id)
    {
        $product = Product::find($id);
        // $images = DB::table('view_product_images')->where('product_id', $id)->get();
        $images = ProductImage::where('product_id', $id)->with('product')->get();
        // dd($images);
        $company = Product::find($id)->user;
        $category = Product::find($id)->category;
        $subcategory = Product::find($id)->subcategory;
        return view('products.detail', [
            'product' => $product,
            'images' => $images,
            'company' => $company,
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
            // if($request->hasfile('images')) {
            //     foreach($images as $image) {
            //         $filename = $image->getClientOriginalName();
            //         $path = $image->storeAs('images', $product->id.'-'.$filename, 'public');
            //         ProductImage::create([
            //             'name' => $product->name,
            //             'product_id' => $product->id,
            //             'image_path' => $path,
            //         ]);
            //     }
            // }

            if($request->hasFile('images')) {
                foreach($images as $image) {
                    //get filename with extension
                    $filenamewithextension = $image->getClientOriginalName();
            
                    //get filename without extension
                    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            
                    //get file extension
                    $extension = $image->getClientOriginalExtension();
            
                    //filename to store
                    $filenametostore = $filename.'_'.time().'.'.$extension;
            
                    //Upload File
                    $image->storeAs('public/images', $filenametostore);
                    // $image->storeAs('public/images/thumbnail', $filenametostore);
            
                    //Resize image here
                    // $thumbnailpath = public_path('storage/images/thumbnail/'.$filenametostore);
                    $imagePath = public_path('storage/images/'.$filenametostore);
                    

                    // $img = Image::make($thumbnailpath)->resize(100, 100, function($constraint) {
                    //     $constraint->aspectRatio();
                    // });
                    // $img2 = Image::make($imagePath)->resize(null, 225, function($constraint) {
                    //     $constraint->aspectRatio();
                    // });

                    $imgSave = Image::make($imagePath)->fit(300);

                    // crop image
                    // $imgSave = Image::make($imagePath)->crop(200, 200, 5, 5);

                    // $path = $imgSave->storeAs('images', $product->id.'-'.$filenametostore, 'public');

                    // $img->save($thumbnailpath);
                    $imgSave->save($imagePath);
                    
                    ProductImage::create([
                        'name' => $product->name,
                        'product_id' => $product->id,
                        'image_path' => 'images/'.$filenametostore,
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
            DB::table('product_images')->where('product_id', $id)->update([
                'name' => $product->name
            ]);
        }

        return redirect('/member')->with('success', 'product '.$product->name.' updated successfully');
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
