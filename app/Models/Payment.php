<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Payment extends Model
{
    protected $table = 'payment';

    use HasFactory;

    public function encryptCard($cardNumber, $cardExpirationMonth, $cardExpirationYear, $cardCvv, $cardHolder, $cardPassword)
    {
        $cardDecrypted = array(
            "number" => $cardNumber,
            "exp_month" => $cardExpirationMonth,
            "exp_year" => $cardExpirationYear,
            "cvc" => $cardCvv,
            "name" => $cardHolder,
            "card_password" => $cardPassword
        );

        $encrypted = serialize($cardDecrypted);
        $encrypted = Crypt::encrypt($encrypted);

        $this->encrypted = $encrypted;
        $this->save();

		return $this->encrypted;
    }


    public static function GetAvaillableCards($userId){
        return self::where('user_id', $userId)->get();
    }
}
