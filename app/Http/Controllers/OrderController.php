<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Review;
use App\Models\ShoppingCart;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class OrderController extends Controller
{
    public function index()
    {
        return view("dashboard.order.index");
    }

    public function shipped()
    {
        return view("dashboard.order.shipped");
    }

    public function getPendingOrders()
    {
        $orders = Order::getPendingOrders();
        foreach ($orders as $order) {
            $orderItems = OrderItem::where('order_id', $order->id)->get();
            $productIds = $orderItems->pluck('product_id');
            $products = Product::whereIn('id', $productIds)->get();
            $order->products = $products;
        }
    
        return response()->json($orders);
    }

    public function getShippedOrders()
    {
        $orders = Order::getShippedOrders();
        foreach ($orders as $order) {
            $orderItems = OrderItem::where('order_id', $order->id)->get();
            $productIds = $orderItems->pluck('product_id');
            $products = Product::whereIn('id', $productIds)->get();
            $order->products = $products;
        }
        return response()->json($orders);
    }

    public function orderDetails($id) {
        $order = Order::find($id);
    
        if (!$order) {
            return view('user.orders');
        }
    
        if (!$this->checkIfOrderBelongsToUser($order)) {
            return view('user.orders');
        }
    
        $transaction = Transaction::where('order_id', $order->id)->first();
        $user = User::find($order->user_id);
        $userAddress = UserAddress::where('user_id', $user->id)->first();
    
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        $productIds = $orderItems->pluck('product_id');
        $products = Product::whereIn('id', $productIds)->get();
    
        return view("user.order_details", compact('order', 'transaction', 'user', 'userAddress', 'products'));
    }
    


    public function checkIfOrderBelongsToUser($order)
    {
        if (!auth('user')->check()) {
            return false;
        }

        $userId = auth('user')->user()->id;

        return $order->user_id == $userId;
    }


    public function store(Request $request)
    {
        if ($request->paymentMethod == "PIX") {
            $payment_method = "pix";
            $payment_opt = 9;
        } elseif ($request->paymentMethod == "Boleto Bancário") {
            $payment_method = "boleto";
            $payment_opt = 1;
        } else {
            $payment_method = "credit_card";
            $payment_opt = 0;
        }

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

        if ($payment_method && $order) {
            $transaction = Transaction::createTransactionByOrderId($order->id, $payment, $order->total_price, $user, $payment_opt, $order->address_id);

            if ($payment_method == "credit_card" && isset($transaction)) {
                $order = Order::find($order->id);
                $order->status = ($transaction->status == 'paid') ? "paid" : "pending";
                $order->save();
            }
        }


        $cartItems = CartItem::where('cart_id', $order->cart_id)->get();

        foreach ($cartItems as $item) {
            $orderItem = new OrderItem(); 
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->quantity = $item->quantity; 
            $orderItem->unit_price = $item->unit_price;
            $orderItem->variation = $item->variation; 
            $orderItem->color = $item->color;
            $orderItem->save(); 
        }
        return response()->json($order, 201);
    }

    public function getUserOrders() {
        $userId = auth('user')->user()->id;
        
        $orders = Order::where('user_id', $userId)->get();
        
        foreach ($orders as $order) {
            $orderItems = OrderItem::where('order_id', $order->id)->get();
            $productIds = $orderItems->pluck('product_id');
            $products = Product::whereIn('id', $productIds)->get();
            $order->products = $products;
        }
    
        return response()->json($orders);
    }
    
    


    public function reviewUpdate(Request $request){
        $userId = auth('user')->user()->id;
        $productId = $request->productId;
        $rating = $request->rating;
        $feedback = $request->feedback;
    
        $lastReview = Review::where('user_id', $userId)->where('product_id', $productId)->first();
    
        if($lastReview){
            $lastReview->rating = $rating;
            $lastReview->comment = $feedback;
            $lastReview->save();
            return response()->json(['message' => 'Avaliação atualizada com sucesso']);
        } else {
            Review::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'comment' => $feedback,
                'rating' => $rating,
            ]);
            return response()->json(['message' => 'Obrigado por nos avaliar!']);
        }
    }
    

    public function getUserReviews(){
        $userId     = auth('user')->user()->id;
        $reviewsResponse    = Review::where('user_id', $userId)->get();
        $reviews = $reviewsResponse->toArray();

        return response()->json($reviews, 200);
    }

}
