<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorsController extends Controller
{
    public function listColors()
    {
        $colors = Color::getAllColors();
        return response()->json($colors);
    }
}
