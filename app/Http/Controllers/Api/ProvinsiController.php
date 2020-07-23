<?php

namespace App\Http\Controllers\Api;

use App\Provinsi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProvinsiResource;

class ProvinsiController extends Controller
{
    public function index()
    {
        $provinsis = Provinsi::withCount([
            'products' => function ($query) {
                $query->withFilters();
            }])->get();

        return ProvinsiResource::collection($provinsis);
    }
}
