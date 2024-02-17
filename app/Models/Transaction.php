<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lib\PagarmeLib;
use Psy\Readline\Transient;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'cart_id',
        'address_id',
        'total_price',
        'payment_method',
        'status',
        'gateway_transaction_id',
        'order_id',
        'pix_base64',
        'pix_copy_paste',
        'pix_expiration_date_time',
    ];

    public static function createTransactionByOrderId($order_id, $payment, $total, $user, $payment_opt, $address_id){
        $transaction = New Transaction();
        $response = PagarmeLib::chargeWithSplit($payment, $total, trans('payment.ride_authorization'), true, $user, $payment_opt, $order_id, $address_id);
    }

}
