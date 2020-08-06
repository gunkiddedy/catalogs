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
        $products = Product::with('user')->orderBy('id', 'desc')->paginate(20);

        return view('products.index', ['products' => $products]);
    }

    public function findBySubCategory($id)
    {
        $products = \App\SubCategory::find($id=555)->products;

        dd($products);
    }

    // public function index()
    // {
    //     $products = Product::withFilters()->get();

    //     return ProductResource::collection($products);
    // }


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
            'description'=> 'required|min:20',
            'price' => 'required',
            'hs_code' => 'required|min:3',
            'category_id' => 'required',
            'images' => 'required',
        ]); 

        DB::transaction(function () use ($request) {
            $user_id = Auth::id();
            $provinsi_id = Auth::user()->provinsi_id;
            $kabupaten_id = Auth::user()->kabupaten_id;
            $kecamatan_id = Auth::user()->kecamatan_id;
            $company = Auth::user()->name;
            $name = $request->name;
            $description = $request->description;
            $sni = $request->sni;
            $nomor_sni = $request->nomor_sni;
            $tkdn = $request->tkdn;
            $nilai_tkdn = $request->nilai_tkdn;
            $nomor_sertifikat_tkdn = $request->nomor_sertifikat_tkdn;
            $nomor_laporan_tkdn = $request->nomor_laporan_tkdn;
            $price = $request->price;
            $hs_code = $request->hs_code;
            $category_id = $request->category_id;
            $subcategory_id = $request->subcategory_id;
            $images = $request->images;

            if($request->hasFile('images')) {
                foreach($images as $imagex)
                $filenamewithextension = $imagex->getClientOriginalName();
            
                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        
                //get file extension
                $extension = $imagex->getClientOriginalExtension();
        
                //filename to store
                $filenametostore = $filename.'_'.$user_id.'.'.$extension;

                $product = Product::create([
                    'name' => $name,
                    'description' => $description,
                    'sni' => $sni,
                    'nomor_sni' => $nomor_sni,
                    'tkdn' => $tkdn,
                    'nilai_tkdn' => $nilai_tkdn,
                    'nomor_sertifikat_tkdn' => $nomor_sertifikat_tkdn,
                    'nomor_laporan_tkdn' => $nomor_laporan_tkdn,
                    'price' => $price,
                    'hs_code' => $hs_code,
                    'category_id' => $category_id,
                    'subcategory_id' => $subcategory_id,
                    'user_id' => $user_id,
                    'company_name' => $company,
                    'provinsi_id' => $provinsi_id,
                    'kabupaten_id' => $kabupaten_id,
                    'kecamatan_id' => $kecamatan_id,
                    
                    'image_path' => 'images/'.$filenametostore
                ]);

                foreach($images as $image) {
                    //get filename with extension
                    $filenamewithextension = $image->getClientOriginalName();
            
                    //get filename without extension
                    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            
                    //get file extension
                    $extension = $image->getClientOriginalExtension();
            
                    //filename to store
                    // $filenametostore = $filename.'_'.time().'.'.$extension;
                    $filenametostore = $filename.'_'.$user_id.'.'.$extension;
            
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
            'price' => 'required',
            'description' => 'required',
            'hs_code' => 'required',
            'category_id' => 'required'
        ]);

        $images = $request->images;
        $user_id = Auth::id();

        if($request->hasFile('images')) {
            //delete image on table product_images firts--------------
            $imgp = DB::table('product_images')->where('product_id', $id)->get();
            for($i=0; $i<count($imgp); $i++){
                if($imgp[$i]->image_path){
                    Storage::delete('/public/'.$imgp[$i]->image_path);
                }
            }
            // ------------------------------------------------------

            // get index 0 of images array---------------------------
            foreach($images as $imagex){}
            $filenamewithextension = $imagex->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $imagex->getClientOriginalExtension();
            $filenametostore = $filename.'_'.$user_id.'.'.$extension;

            $product = Product::find($id);
            $product->name = $request->get('name');
            $product->description = $request->get('description');
            $product->sni = $request->get('sni');
            $product->nomor_sni =  $request->get('nomor_sni');
            $product->tkdn = $request->get('tkdn');
            $product->nilai_tkdn = $request->get('nilai_tkdn');
            $product->nomor_sertifikat_tkdn = $request->get('nomor_sertifikat_tkdn');
            $product->nomor_laporan_tkdn = $request->get('nomor_laporan_tkdn');
            $product->price = $request->get('price');
            $product->hs_code = $request->get('hs_code');
            $product->category_id = $request->get('category_id');
            $product->subcategory_id = $request->get('subcategory_id');
            $product->is_active = 0;
            $product->image_path = 'images/'.$filenametostore;
            $product->save();

            // delete product_images first, then insert with the new images
            DB::table('product_images')->where('product_id', '=', $id)->delete();

            // ---------------------------------------------------------


            foreach($images as $image) {
                $filenamewithextension = $image->getClientOriginalName();
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $filenametostore = $filename.'_'.$user_id.'.'.$extension;
                $image->storeAs('public/images', $filenametostore);        
                $imagePath = public_path('storage/images/'.$filenametostore);
                $imgSave = Image::make($imagePath)->fit(300);
                $imgSave->save($imagePath);
                
                // DB::table('product_images')->where('product_id', $id)->update([
                //     'name' => $request->get('name'),
                //     'image_path' => 'images/'.$filenametostore,
                // ]);
                

                ProductImage::create([
                    'name' => $request->get('name'),
                    'product_id' => $id,
                    'image_path' => 'images/'.$filenametostore,
                ]);
            }
        }
        else{
            DB::table('product_images')->where('product_id', $id)->update([
                'name' => $product->name
            ]);

            $product = Product::find($id);
            $product->name = $request->get('name');
            $product->description = $request->get('description');

            $product->sni = $request->get('sni');
            $product->nomor_sni =  $request->get('nomor_sni');

            $product->tkdn = $request->get('tkdn');
            $product->nilai_tkdn = $request->get('nilai_tkdn');
            $product->nomor_sertifikat_tkdn = $request->get('nomor_sertifikat_tkdn');
            $product->nomor_laporan_tkdn = $request->get('nomor_laporan_tkdn');

            $product->price = $request->get('price');
            $product->hs_code = $request->get('hs_code');
            $product->category_id = $request->get('category_id');
            $product->subcategory_id = $request->get('subcategory_id');
            $product->is_active = 0;
            $product->save();

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
