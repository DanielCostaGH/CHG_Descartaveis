<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\TokenFrete;
use Illuminate\Http\Request;

class GetApiDataController extends Controller
{
    public function listColors()
    {
        $colors = Color::getAllColors();
        return response()->json($colors);
    }
    
    public function listVariations($id)
    {
        $variations = explode(';', Product::find($id)->variation);
        return response()->json($variations);
    }

    public function getAccessToken(){
        $token = TokenFrete::getToken();
        return response()->json($token);
    }
}
