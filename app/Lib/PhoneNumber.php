<?php
namespace app\Lib;
use Log;

class PhoneNumber
{
    private string $phoneNumber;
    private int $ddi = 0;
    private int $ddd = 0;
    private string $number = "";

    /**
     * Constructor for phone number format and fill all fields to phone number
     * @param string $phoneNumber
     */
    public function __construct(String $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        $this->treatNumber();
    }

    /**
     * trata o número passado e trata para iniciar cada váriavel
     */
    private function treatNumber()
    {
        if($this->phoneNumber) {
            $cleanStrPhone = preg_replace("/[^0-9]/", "", trim($this->phoneNumber));
            if(strlen($this->phoneNumber) >= 12){
                $ddi = mb_substr($cleanStrPhone, 0, 2);
                $ddd = mb_substr($cleanStrPhone, 2, 2);
                $number = mb_substr($cleanStrPhone, 4, strlen($cleanStrPhone));
            }else{
                $number = mb_substr($cleanStrPhone, -8, strlen($cleanStrPhone));
                $ddi = "55";
                $ddd = mb_substr($cleanStrPhone, 0, 2);
            }
            $this->ddi = $ddi;
            $this->ddd = $ddd;
            
            // verifica se tem o 8 digitos e adicionar o numero 9 no inicio
            $this->number = $number;
            if(strlen($number) == 8) {
                $this->number = '9' . $number;
            }
            // trata o numero par ao padrão BR de 14 digitos
            $this->phoneNumber = '+' . $ddi . $ddd .$this->number;
        }
    }

    /**
     * return the DDD phone number
     * @return string DDD phone number | 31
     */
    public function getDDD()
    {
        if($this->ddd){
            return $this->ddd;
        }
        return null;
    } 

    /**
     * return the DDI phone number
     * @param boolean $isPlus add plus digit in return
     * @return string DDI phone number | 55 | +55
     */
    public function getDDI($isPlus = false)
    {
        if($this->ddi) {
            return ($isPlus? '+': '') . $this->ddi;
        }
        return null;
    } 

    /**
     * return the phone number clean
     * @param boolea $isDDD when positive include ddD in return int
     * @param boolea $isDDI when positive include ddi in return int
     * @return string phone number | 988663322 | 77988663322 | 5577988663322
     */
       public function getPhoneNumber($isDDD = false, $isDDI = false)
    {
        if($this->number) {
            return intval(
                ($isDDI ? $this->ddi : '') . 
                ($isDDD ? $this->ddd : '') . 
                    $this->number
            );
        }
        return null;
    }

    /**
     * return the full phone number
     * @return string full phone number | +5531988663322
     */
    public function getFullPhoneNumber()
    {
        if($this->ddi && $this->ddd && $this->number) {
            return '+' . $this->ddi . 
                $this->ddd . 
                $this->number;
        }
        return null;
    }

    /**
     * return the full phone number
     * @return int full phone number integer | 5531988663322
     */
    public function getFullPhoneNumberInt()
    {
        if($this->ddi && $this->ddd && $this->number) {
            return intval($this->ddi . 
                $this->ddd . 
                $this->number);
        }
        return null;
    } 

    /**
     * return the phone number formated
     * @param boolea $isDDI when positive include ddi in return string
     * @param boolea $isSeparator when positive include char '-' to separate number in return string
     * @return string phone number formated | +55 (31) 98866-3322 | (31) 98866-3322 | (31) 988663322
     */
    public function getPhoneNumberFormatedBR($isDDI = true, $isSeparator = true)
    {
        if($this->ddi && $this->ddd && $this->number) {
            $firstNumbers = mb_substr($this->number, 0, 5);
            $lastNumbers = mb_substr($this->number, 5);

            return  ($isDDI ? '+' . $this->ddi : '') . 
                ' (' . $this->ddd . ') ' . 
                $firstNumbers . 
                ($isSeparator ? '-' : '') . 
                $lastNumbers;
        }
        return null;
    } 


}
