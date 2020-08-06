<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetDataProductController extends Controller
{
    public function getData($id)
    {
        $SNI = \App\Product::find($id);
        return response()->json($SNI);
    }
}
