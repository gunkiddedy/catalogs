<?php

namespace App\Http\Controllers;

use App\About;
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
        $users = ViewProfile::where('role', 'member')->get();
        // dd($users);
        return view('admin.members', [
            'users' =>$users
        ]);
    }

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
        
        return redirect('/admin/about')->with('success', 'data updated successfully');
    }

}
