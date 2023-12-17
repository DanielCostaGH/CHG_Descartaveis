<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{


    public function index(){
        return view('cart.shopping_cart');
    }

    public function payment(){
        return view('cart.payment_cart');
    }

    public function confirmation(){
        return view('cart.confirmation_cart');
    }


    public function addToCart(Request $request)
    {
        $user = auth('user')->user();
        $productId = $request->productId;
        $color = $request->color;
        $variation = $request->variation;
        $unitPrice = Product::getProductPrice($productId)['price'];

        if ($user) {
            $shoppingCart = ShoppingCart::firstOrCreate(
                ['user_id' => $user->id, 'status' => 'active'],
                ['total_price' => 0]
            );

            $cartItem = CartItem::where('product_id', $productId)
                                ->where('cart_id', $shoppingCart->id)
                                ->first();

            if ($cartItem && $cartItem->$color && $cartItem->$variation) {
                $cartItem->quantity += 1;
                $cartItem->save();
            } else {
                $cartItem = new CartItem([
                    'product_id' => $productId,
                    'cart_id'    => $shoppingCart->id,
                    'quantity'   => 1,
                    'unit_price' => $unitPrice,
                    'color'      => $color,
                    'variation'  => $variation
                ]);
                $cartItem->save();
            }

            return response()->json(['message' => 'Produto adicionado ao carrinho'], 200);
        } else {

            return response()->json(['message' => 'Usuário não logado. Carrinho armazenado localmente.'], 200);
        }
    }


    public function getCart(){
        $user = auth('user')->user();
        $userId = $user->id;
        $shoppingCart = ShoppingCart::getUserCart($userId);
        $cartItems = CartItem::where('cart_id', $shoppingCart->id)
                         ->with('product')
                         ->get();

    return response()->json($cartItems);
    }


    public function updateCartItem(Request $request, $cartItemId)
{
    $newQuantity = $request->input('quantity');

    $cartItem = CartItem::find($cartItemId);
    if (!$cartItem) {
        return response()->json(['message' => 'Item do carrinho não encontrado'], 404);
    }

    $cartItem->quantity = $newQuantity;
    $cartItem->save();

    return response()->json(['message' => 'Quantidade atualizada com sucesso']);
}

}
