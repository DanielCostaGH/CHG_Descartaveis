<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\ShoppingCart;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return view("dashboard.order.index");
    }

    public function shipped(){
        return view("dashboard.order.shipped");
    }

    public function getPendingOrders() {
        $orders = Order::getPendingOrders();
        return response()->json($orders);
    }


    public function orderDetails(){
        return view("user.order_details");
    }

    public function store(Request $request){

        if ($request->paymentMethod == "PIX") {
            $payment_method = "pix";
            $payment_opt = 9;
        } else if ($request->paymentMethoD == "BOLETO") {
            $payment_method = "boleto";
            $payment_opt = 1;
        } else {
            $payment_method = "credit_card";
            $payment_opt = 0;
        }

        $payment_opt = 0;


        $order = new Order();
        $order->user_id = $request->userId;
        $order->cart_id = ShoppingCart::getUserCart($request->userId)->id;
        $order->address_id = $request->addressId;
        $order->total_price = $request->total;
        $order->payment_method = $payment_method;
        $order->save();

        $user = User::find($order->user_id);

        $payment = Payment::where('last_four', substr($request->paymentMethod, -4))
                    ->where('user_id', $request->userId)
                    ->first();

        $payment = Payment::where('user_id', $user->id)->first();

        if ($payment_method == "credit_card" && $order) {
            $transaction = Transaction::createTransactionByOrderId($order->id, $payment, $order->total_price, $user, $payment_opt, $order->address_id);
        };

        
    }
}
