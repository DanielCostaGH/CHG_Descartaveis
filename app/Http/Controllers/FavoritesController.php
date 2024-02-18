<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function update(Request $request){
        $user = auth('user')->user();
        $productId = $request->input('productId');

        $favorite = Favorite::where('user_id', $user->id)
                            ->where('product_id', $productId)
                            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['message' => 'Produto removido dos favoritos.']);
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            return response()->json(['message' => 'Produto adicionado aos favoritos.']);
        }

    }



    public function getUserFavorites(){
        $user = auth('user')->user();
        $userId = $user->id;

        $favorites = Favorite::getUserFavorites($userId);

        return response()->json($favorites);
    }


    public function getUserFavoritesProducts(){
        $user = auth('user')->user();
        $userId = $user->id;

        $favoriteProductIds = Favorite::where('user_id', $userId)->pluck('product_id');

        $favoriteProducts = Product::whereIn('id', $favoriteProductIds)->get();

        return response()->json($favoriteProducts);
    }
}
