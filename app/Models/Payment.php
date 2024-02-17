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
        return self::where('id', $userId)->get();
    }
    

    public static function getCardNumber($encrypted){
        $cardDecrypted = self::decryptCard($encrypted);
        return $cardDecrypted['number'];
	}

    public static function getCardExpirationMonth($encrypted) {
        $cardDecrypted = self::decryptCard($encrypted);
        return $cardDecrypted['exp_month'];
    }

    public static function getCardExpirationYear($encrypted){
		$cardDecrypted = self::decryptCard($encrypted);
		return $cardDecrypted['exp_year'];
	}

    public static function getCardHolder($encrypted){
		$cardDecrypted = self::decryptCard($encrypted);
		return $cardDecrypted['name'];
	}

    public static function getCardCvc($encrypted){
		$cardDecrypted = self::decryptCard($encrypted);
		return $cardDecrypted['cvc'];
	}

    private static function decryptCard($encrypted) {
        $cardDecrypted = ['number' => null]; 
        if ($encrypted && $cardDecrypted['number'] == null) {
            $decrypted = Crypt::decrypt($encrypted->encrypted);
            $cardDecrypted = unserialize($decrypted);
        }
        return $cardDecrypted;
    }
}
