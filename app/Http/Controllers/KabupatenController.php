<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    public function index()
    {
        $kabupatens = \App\Kabupaten::paginate();
        $provinsis = \App\Provinsi::paginate();
        // dd($categories);
        return view('admin.kabupaten', [
            'kabupatens' => $kabupatens,
            'provinsis' => $provinsis,
        ]);
    }
}
