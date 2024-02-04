<?php


class CardFlag {
    const MASTERCARD = 'mastercard';
    const VISA = 'visa';
    const AMERICAN_EXPRESS = 'amex';
    const ELO = 'elo';
    const HIPERCARD = 'hipercard';

    private $flags = [
        self::AMERICAN_EXPRESS => '/^3[47]\d{13}$/',
        self::ELO => '/(4011|431274|438935|451416|457393|4576|457631|457632|504175|627780|636297|636368|636369|(6503[1-3])|(6500(3[5-9]|4[0-9]|5[0-1]))|(6504(0[5-9]|1[0-9]|2[0-9]|3[0-9]))|(650(48[5-9]|49[0-9]|50[0-9]|51[1-9]|52[0-9]|53[0-7]))|(6505(4[0-9]|5[0-9]|6[0-9]|7[0-9]|8[0-9]|9[0-8]))|(6507(0[0-9]|1[0-8]))|(6507(2[0-7]))|(650(90[1-9]|91[0-9]|920))|(6516(5[2-9]|6[0-9]|7[0-9]))|(6550(0[0-9]|1[1-9]))|(6550(2[1-9]|3[0-9]|4[0-9]|5[0-8]))|(506(699|77[0-8]|7[1-6][0-9))|(509([0-9][0-9][0-9])))/',
        self::HIPERCARD => '/^(606282\d{10}(\d{3})?)|(3841\d{15})$/',
        self::MASTERCARD => '/^5[1-5]\d{14}$|^2(?:2(?:2[1-9]|[3-9]\d)|[3-6]\d\d|7(?:[01]\d|20))\d{12}$/',
        self::VISA => '/^4\d{12}(?:\d{3})?$/',
    ];

    public static function getBrandByCardNumber($number)
    {
        $number = str_replace(" ","",$number);
        return (new CardFlag)->checkFlag($number);
    }

    private function checkFlag(int $number): string
    {
        switch ($number) {
            case $this->getBrandPattern($this::AMERICAN_EXPRESS, $number):
                return $this::AMERICAN_EXPRESS;
            case $this->getBrandPattern($this::ELO, $number):
                return $this::ELO;
            case $this->getBrandPattern($this::HIPERCARD, $number):
                return $this::HIPERCARD;
            case $this->getBrandPattern($this::MASTERCARD, $number):
                return $this::MASTERCARD;
            case $this->getBrandPattern($this::VISA, $number):
                return $this::VISA;
            default:
                return '';
        }
    }

    private function getBrandPattern(string $pattern, int $number): bool
    {
        return preg_match($this->flags[$pattern], $number) > 0;
    }
}