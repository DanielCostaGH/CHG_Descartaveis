<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return view("dashboard.order.index");
    }

    public function shipped(){
        return view("dashboard.order.shipped");
    }
}
