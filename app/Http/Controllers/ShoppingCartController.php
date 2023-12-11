<?php

namespace App\Http\Controllers;

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
}
