<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{


    public function index()
    {
        return view('cart.shopping_cart');
    }

    public function payment()
    {
        return view('cart.payment_cart');
    }

    public function confirmation()
    {
        return view('cart.confirmation_cart');
    }

    public function localCart()
    {
        return view('cart.local');
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
                ->where('color', $color)
                ->where('variation', $variation)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += 1;
                $cartItem->save();
                $this->updateShoppingCartTotal($shoppingCart->id);
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
                $this->updateShoppingCartTotal($shoppingCart->id);
            }

            return response()->json(['message' => 'Produto adicionado ao carrinho'], 200);
        } else {

            return response()->json(['message' => 'Usuário não logado. Carrinho armazenado localmente.'], 200);
        }
    }


    public function getCart()
    {
        $user = auth('user')->user();
        $userId = $user->id;
        $shoppingCart = ShoppingCart::getUserCart($userId);
        $cartItems = CartItem::where('cart_id', $shoppingCart->id)
            ->with('product')
            ->get();

        return response()->json($cartItems);
    }

    public function getLocalCartProducts(Request $request)
    {
        $productIds = $request->input('productIds', []);
        $products = Product::whereIn('id', $productIds)
            ->get()
            ->map(function ($product) {
                $firstImageName = explode(';', $product->images)[0];
                $product->imagePath = "/images/products/{$product->id}/{$firstImageName}";
                return $product;
            });

        return response()->json($products);
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
        $this->updateShoppingCartTotal($cartItem->cart_id);

        return response()->json(['message' => 'Quantidade atualizada com sucesso']);
    }


    public function deleteCartItem($cartItemId)
    {
        $cartItem = CartItem::find($cartItemId);

        if (!$cartItem) {
            return response()->json(['message' => 'Item do carrinho não encontrado'], 404);
        }

        $cartItem->delete();
        $this->updateShoppingCartTotal($cartItem->cart_id);

        return response()->json(['message' => 'Item removido do carrinho com sucesso']);
    }


    public function getTotalPrice($cartItemId)
    {
        $cartItem = CartItem::find($cartItemId);

        if (!$cartItem) {
            return response()->json(['message' => 'Item do carrinho não encontrado'], 404);
        }
    }

    public function mergeLocalCartToUserCart(Request $request)
{
    $user = auth('user')->user();
    if (!$user) {
        return response()->json(['message' => 'Usuário não logado.'], 401);
    }

    $localCartItems = $request->input('localCartItems', []); // Itens do carrinho local

    $shoppingCart = ShoppingCart::firstOrCreate(
        ['user_id' => $user->id, 'status' => 'active'],
        ['total_price' => 0]
    );

    foreach ($localCartItems as $localItem) {
        $cartItem = CartItem::where('product_id', $localItem['productId'])
            ->where('cart_id', $shoppingCart->id)
            ->where('color', $localItem['color'])
            ->where('variation', $localItem['variation'])
            ->first();

        if (!$cartItem) {
            // Se o item não existe no carrinho do usuário, adicione-o.
            $unitPrice = Product::getProductPrice($localItem['productId'])['price'];
            $newCartItem = new CartItem([
                'product_id' => $localItem['productId'],
                'cart_id'    => $shoppingCart->id,
                'quantity'   => $localItem['quantity'],
                'unit_price' => $unitPrice,
                'color'      => $localItem['color'],
                'variation'  => $localItem['variation']
            ]);
            $newCartItem->save();
        }
    }
    $this->updateShoppingCartTotal($cartItem->cart_id);

    return response()->json(['message' => 'Carrinho mesclado com sucesso'], 200);
}

public function updateShoppingCartTotal($cartId)
{
    $cartItems = CartItem::where('cart_id', $cartId)->get();
    $totalPrice = 0;

    foreach ($cartItems as $item) {
        $totalPrice += $item->quantity * $item->unit_price;
    }

    $shoppingCart = ShoppingCart::find($cartId);
    if ($shoppingCart) {
        $shoppingCart->total_price = $totalPrice;
        $shoppingCart->save();
    }
}

public function getCartPrice(){
    $user = auth('user')->user();
    if (!$user) {
        return response()->json(['message' => 'Usuário não logado.'], 401);
    }

    $response = ShoppingCart::where('user_id', $user->id)->first();
    $price = $response->total_price;
    
    return response()->json($price, 200);
}

}
