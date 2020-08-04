<?php

namespace App\Http\Controllers\Api;

use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProvinsiResource;
use App\Http\Resources\KabupatenResource;

class WilayahController extends Controller
{
    public function getProvinsi()
    {
        $provinsis = Provinsi::withCount(['products' => function ($query) {
            $query->withFilters();}
            ])->get();

        return ProvinsiResource::collection($provinsis);
    }

    public function getKabupaten(Request $request)
    {
        $kabupatens = Kabupaten::withCount([
            'products' => function ($query) {
                $query->withFilters();
        }])->where('provinsi_id', $request->provinsi_id)->get();

        return KabupatenResource::collection($kabupatens);
    }

    public function getProvinsix()
    {
        $provinsis = Provinsi::all();
        return response()->json($provinsis);
    }

    public function getKabupatenx(Request $request)
    {
        $kabupatens = Kabupaten::where('provinsi_id', $request->provinsi_id)->get();
        return response()->json($kabupatens);
    }

    public function getKecamatanx(Request $request)
    {
        $kecamatans = Kecamatan::where('kabupaten_id', $request->kabupaten_id)->get();
        return response()->json($kecamatans);
    }


}
