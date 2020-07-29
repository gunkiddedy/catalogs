<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function index()
    {
        $provinsis = \App\Provinsi::paginate(10);
        // dd($categories);
        return view('admin.provinsi', [
            'provinsis' => $provinsis,
        ]);
    }
}
