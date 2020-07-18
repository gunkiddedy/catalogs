<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index()
    {
        $kecamatans = \App\Kecamatan::all();
        $kabupatens = \App\Kabupaten::all();
        $provinsis = \App\Provinsi::all();
        // dd($categories);
        return view('admin.kecamatan', [
            'kecamatans' => $kecamatans,
            'kabupatens' => $kabupatens,
            'provinsis' => $provinsis,
        ]);
    }
}
