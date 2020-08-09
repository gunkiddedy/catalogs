<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function edit($id)
    {   
        $user = \App\User::find($id);
        return view('admin.edit_user', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {    
        $user = \App\User::find($id);
        $user->is_active = $request->get('is_active');
        $user->save();
        
        return redirect('/members')->with('success', 'data updated successfully');
    }

    public function emailBlacklist()
    {
        $emails = \App\Blacklist::paginate(10);
        return view('admin.blacklist', ['emails' => $emails]);
    }

    public function emailDestroy($id)
    {
        $emails = \App\Blacklist::find($id)->delete();

        return redirect('/blacklist')->with('success', 'data deleted successfully');
    }

    public function userDestroy(Request $request, $id)
    {
        $user = \App\User::find($id);
        $blacklist = new \App\BlackList;
        
        // get email user
        $email = $user->email;
        $name = $user->name;
        // dd($email);
        
        $blacklist->user_id = $id;
        $blacklist->name = $name;
        $blacklist->email = $email;
        
        $product = \App\Product::where('user_id', $id)->get();
        
        $product_id_user = array();
        
        foreach($product as $p)
            $product_id_user[] = $p->id;

        // dd($product_id_user);

        $images = \App\ProductImage::where('product_id', $id)->get();
        // DELETE IMAGE FROM local storage
        foreach($images as $image){
            Storage::disk('public')->delete($image->image_path);
        }
        
        // DELETE images product on table product_images
        DB::table('product_images')->whereIn('product_id', $product_id_user)->delete();

        // DELETE user product from table products by user_id
        DB::table('products')->where('user_id', '=', $id)->delete();
        // dd($products);

        // SAVE user email into table black_lists
        $blacklist->save();

        // DELETE user from table users by id
        $user->delete();
        
        return redirect('/members')->with('success', 'user deleted successfully');
    }
    
}
