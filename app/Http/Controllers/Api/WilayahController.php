<?php

namespace App\Http\Controllers\Api;

use App\Provinsi;
use App\Kabupaten;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProvinsiResource;
use App\Http\Resources\KabupatenResource;

class WilayahController extends Controller
{
    public function getProvinsi()
    {
        // $data = \App\Provinsi::get();

        // return response()->json($data);
        $provinsis = Provinsi::withCount(['products' => function ($query) {
                                                            $query->withFilters();}
                                                            ])->get();
    
        return ProvinsiResource::collection($provinsis);

        // $categories = Category::withCount([
        //     'products' => function ($query) {
        //         $query->withFilters();
        // }])->get();

        // return CategoryResource::collection($categories);
    }

    public function getKabupaten(Request $request)
    {
        // $data = \App\Kabupaten::where('provinsi_id', $request->provinsi_id)->get();
        // return response()->json($data);
        $kabupatens = Kabupaten::withCount([
            'products' => function ($query) {
                $query->withFilters();
        }])->where('provinsi_id', $request->provinsi_id)->get();

        return KabupatenResource::collection($kabupatens);
    }

    // $provinsis = Provinsi::withCount([
    //     'products' => function ($query) {
    //         $query->withFilters();
    //     }])->get();

    // return ProvinsiResource::collection($provinsis);
}
