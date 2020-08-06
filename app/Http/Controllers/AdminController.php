<?php

namespace App\Http\Controllers;

use App\About;
use App\Contact;
use App\ViewProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function memberList()
    {
        $users = \App\User::where('role', 'member')->paginate(10);
        // $kecamatan = \App\User::find(1)->kecamatan->name;
        // dd($kecamatan);
        return view('admin.members', [
            'users' =>$users
        ]);
    }

    public function productRequire()
    {
        $products = \App\Product::orderBy('id', 'desc')->paginate(10);
        return view('admin.product-require', [
            'products' =>$products
        ]);
    }

    public function productRequireDetail($id)
    {
        $product = \App\Product::find($id);
        $images = \App\ProductImage::where('product_id', $id)->with('product')->get();
        $company = \App\Product::find($id)->user;
        $category = \App\Product::find($id)->category;
        $subcategory = \App\Product::find($id)->subcategory;
        
        return view('admin.product-require-detail', [
            'product' => $product,
            'images' => $images,
            'company' => $company,
            'kabupaten_name' => $kabupaten_name,
            'provinsi_name' => $provinsi_name,
            'category' => $category,
            'subcategory' => $subcategory,
        ]);
    }

    public function productRequireEdit ($id)
    {
        $product  = \App\Product::find($id);
        // dd($product);
        return view('admin.product-require-edit', ['product' => $product]);
    }

    public function productRequireUpdate(Request $request, $id)
    {    
        $product = \App\Product::find($id);
        $product->is_active = $request->get('is_active');
        $product->save();
        
        return redirect('/product-require')->with('success', 'data updated successfully');
    }

    // ABOUT======================================
    public function about()
    {
        $about = About::find(1);
        return view('admin.about', ['about' => $about]);
    }

    public function editAbout($id)
    {   
        $about = About::find($id);
        return view('admin.edit_about', ['about' => $about]);
    }

    public function updateAbout(Request $request, $id)
    {    
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $about = About::find($id);
        $about->title =  $request->get('title');
        $about->description = $request->get('description');

        // check if has image
        if($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            // check if image exist
            if($about->image){
                Storage::delete('/public/'.$about->image);
            }
            $path = $request->image->storeAs('images', $id.'-'.$filename, 'public');
            $about->image = $path;
        }
        $about->save();
        
        return redirect('/about')->with('success', 'data updated successfully');
    }
    // ********************END ABOUT======================================

    // ----------==========--------CONTACT======================================
    public function contact()
    {
        $contact = Contact::find(1);
        return view('admin.contact', ['contact' => $contact]);
    }

    public function editContact($id)
    {   
        $contact = Contact::find($id);
        return view('admin.edit_contact', ['contact' => $contact]);
    }

    public function updateContact(Request $request, $id)
    {    
        $request->validate([
            'company_name' => 'required', 
            'company_phone' => 'required|min:9|max:12', 
            'company_email' => 'required',
            'company_address' => 'required',
        ]);

        $contact = Contact::find($id);
        $contact->company_name =  $request->get('company_name');
        $contact->company_phone =  $request->get('company_phone');
        $contact->company_email =  $request->get('company_email');
        $contact->company_address =  $request->get('company_address');
        $contact->company_country =  $request->get('company_country');
        $contact->company_whatsapp =  $request->get('company_whatsapp');
        $contact->company_telegram =  $request->get('company_telegram');
        $contact->company_facebook =  $request->get('company_facebook');
        $contact->company_instagram =  $request->get('company_instagram');
        $contact->company_twitter =  $request->get('company_twitter');
        $contact->save();
        
        return redirect('/contact')->with('success', 'data updated successfully');
    }
    // end CONTACT -==================================

}
