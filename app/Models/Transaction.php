<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lib\PagarmeLib;
use Carbon\Carbon;
use Exception;
use Psy\Readline\Transient;

class Transaction extends Model
{

    protected $table = 'transaction';

    protected $fillable = [
        'status',
        'total',
        'gateway_transaction_id',
        'order_id',
        'pix_base64',
        'pix_copy_paste',
        'pix_expiration_date_time',
    ];

    public static function createTransactionByOrderId($order_id, $payment, $total, $user, $payment_opt, $address_id){
        try {
            if ($payment_opt == 0) { 
                    $transaction = new Transaction();

                    $response = PagarmeLib::chargeWithSplit($payment, $total, trans('payment.ride_authorization'), true, $user, $payment_opt, $order_id, $address_id);
                    $transaction->status = $response['status'];
                    $transaction->total = $total;
                    $transaction->gateway_transaction_id = $response['transaction_id'];
                    $transaction->order_id = $order_id;
                    $transaction->pix_base64 = null;
                    $transaction->pix_copy_paste = null;
                    $transaction->pix_expiration_date_time = null;

                    $transaction->save();

                    return $transaction;
                
            } else if ($payment_opt == 9) {
                $transaction = new Transaction();
                $response = PagarmeLib::chargeWithSplit($payment, $total, trans('payment.ride_authorization'), true, $user, $payment_opt, $order_id, $address_id);
                
                $carbonExpiresAt = Carbon::parse($response['expires_at']);
                
                $transaction->status = $response['status'];
                $transaction->total = $total;
                $transaction->gateway_transaction_id = $response['transaction_id'];
                $transaction->order_id = $order_id;
                $transaction->pix_base64 = $response['qr_code_base64'];
                $transaction->pix_copy_paste = $response['qr_code_base64'];
                $transaction->pix_expiration_date_time = $carbonExpiresAt;
                $transaction->save();
                
                return $transaction;
            } else if ($payment_opt == 1) {
                $transaction = new Transaction();
                $response = PagarmeLib::chargeWithSplit($payment, $total, trans('payment.ride_authorization'), true, $user, $payment_opt, $order_id, $address_id);
            }
        } catch (Exception $th) {
            throw $th;
        }
    }

}
