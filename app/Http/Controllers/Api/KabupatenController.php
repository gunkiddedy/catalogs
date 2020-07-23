<?php

namespace App\Http\Controllers\Api;

use App\Kabupaten;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\KabupatenResource;

class KabupatenController extends Controller
{
    public function index()
    {
        $kabupatens = Kabupaten::withCount(['products' => function ($query) {
                $query->withFilters();
            }])
            ->get();

        return KabupatenResource::collection($kabupatens);
    }
}
