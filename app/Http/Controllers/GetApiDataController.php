<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Payment;
use App\Models\Product;
use App\Models\TokenFrete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function getCards()
    {
        $userId = Auth::guard('user')->id();
        $cards = Payment::GetAvaillableCards($userId);
    
        $formattedCards = $cards->map(function ($card) {
            return [
                'cardtype' => $card->cardtype,
                'display' => '**** **** **** ' . $card->last_four,
                'last_four' => $card->last_four,
            ];
        });
    
        return response()->json($formattedCards);
    }
    
}
