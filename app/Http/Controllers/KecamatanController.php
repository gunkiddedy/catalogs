<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index()
    {
        $kecamatans = \App\Kecamatan::paginate();
        $kabupatens = \App\Kabupaten::paginate();
        $provinsis = \App\Provinsi::paginate();
        // dd($categories);
        return view('admin.kecamatan', [
            'kecamatans' => $kecamatans,
            'kabupatens' => $kabupatens,
            'provinsis' => $provinsis,
        ]);
    }
}
