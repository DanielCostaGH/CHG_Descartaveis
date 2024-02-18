<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use CardFlag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PaymentController extends Controller
{
    public static function retrieveCardPayment(Request $request) {
    }


    public function createCard(PaymentRequest $request){
        $cardNumber = $request->card_number;
        $cardExpirationMonth = $request->expiration_mouth;
        $cardExpirationYear = $request->expiration_year;
        $cardCvv = $request->card_cvv;
        $cardHolder = $request->card_holder;
        $cardPassword = null;


        $payment = new Payment();
        $payment->cardtype = 'mastercard';
        $payment->user_id = $request->user_id;
        $payment->last_four = substr($cardNumber, -4);
        $payment->card_token = null;
        $payment->is_default = 1;
        $payment->encrypted = $payment->encryptCard($cardNumber, $cardExpirationMonth,$cardExpirationYear, $cardCvv, $cardHolder, $cardPassword);
        
        if ($payment->save()) {
            
            $success_payment_message = "Cartão adicionado com sucesso";
            $response_array = array('success' => true, 'message' => $success_payment_message);
            $response_code = 200;
            $response = Response::json($response_array, $response_code);

            return $response;
        }

    }

    public function getCardsByUserId(Request $request) {
        $payments = Payment::where('user_id', $request->user_id)->get();

        foreach ($payments as $payment) {
            $last_four = $payment->last_four;
        }
        
        return $last_four;
    }    
}
