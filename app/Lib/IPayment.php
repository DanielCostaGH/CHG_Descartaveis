<?php

namespace Lib;

use Payment;
use Provider;
use Transaction;
use User;
use LedgerBankAccount;

interface IPayment
{

    /**
     * Charge a credit card with split rules
     *
     * @param Payment       $payment
     * @param Provider      $provider 
     * @param Decimal       $totalAmount        A positive decimal representing how much to charge
     * @param Decimal       $providerAmount 
     * @param String        $description        An arbitrary string which you can attach to describe a Charge object
     * @param Boolean       $capture            Whether to immediately capture the charge. When false, the charge issues an authorization (or pre-authorization), and will need to be captured later. 
     * @param User          $user               The customer that will be charged in this request
     * 
     * @return Array ['success', 'status', 'captured', 'paid', 'transaction_id']
     */
    public function chargeWithSplit(Payment $payment, Provider $provider, $totalAmount, $providerAmount, $description, $capture = true, User $user = null);

    /**
     * Charge a credit card
     *
     * @param Payment       $payment
     * @param Decimal       $totalAmount        A positive decimal representing how much to charge
     * @param String        $description        An arbitrary string which you can attach to describe a Charge object
     * @param Boolean       $capture            Whether to immediately capture the charge. When false, the charge issues an authorization (or pre-authorization), and will need to be captured later. 
     * @param User          $user               The customer that will be charged in this request
     * 
     * @return Array ['success', 'status', 'captured', 'paid', 'transaction_id']
     */
    public function charge(Payment $payment, $amount, $description, $capture = true, User $user = null);

    /**
     * Charge with billet
     *
     * @param Decimal       $amount
     * @param Object        $client                 User / Provider instance
     * @param String        $postbackUrl            Url to receive gateway webhook notifications
     * @param String        $billetExpirationDate   Billet expiration date
     * @param String        $billetInstructions     Instructions to print in billet file
     * 
     * @return Array ['success', 'status', 'captured', 'paid', 'transaction_id', 'billet_url', 'billet_expiration_date']
     */      
    public function billetCharge($amount, $client, $postbackUrl, $billetExpirationDate, $billetInstructions);

    /**
     * Check the notification from gateway webhook
     *
     * @param Object $request Body params received from gateway notification
     * 
     * @return Array ['success', 'status', 'transaction_id']
     */      
    public function billetVerify ($request, $transaction_id = null);

    /**
     * Capture the payment of an existing, uncaptured, charge with split rules
     *
     * @param Transaction   $transaction
     * @param Provider      $provider
     * @param Decimal       $totalAmount        A positive decimal representing how much to charge
     * @param Decimal       $providerAmount 
     * @param Payment       $payment               
     * 
     * @return Array ['success', 'status', 'captured', 'paid', 'transaction_id']
     */
    public function captureWithSplit(Transaction $transaction, Provider $provider, $totalAmount, $providerAmount, Payment $payment = null);

    /**
     * Capture the payment of an existing, uncaptured, charge
     *
     * @param Transaction   $transaction
     * @param Decimal       $totalAmount        A positive decimal representing how much to charge
     * @param Payment       $payment     
     * 
     * @return Array ['success', 'status', 'captured', 'paid', 'transaction_id']
     */
    public function capture(Transaction $transaction, $amount, Payment $payment = null);

    /**
     * Refund a charge that has previously been created with split rules
     *
     * @param Transaction   $transaction
     * @param Payment       $payment 
     * 
     * @return Array ['success', 'status', 'transaction_id']
     */
    public function refundWithSplit(Transaction $transaction, Payment $payment);

    /**
     * Refund a charge that has previously been created
     *
     * @param Transaction   $transaction
     * @param Payment       $payment 
     * 
     * @return Array ['success', 'status', 'transaction_id']
     */
    public function refund(Transaction $transaction, Payment $payment);

    /**
     * Retrieves the details of a charge that has previously been created
     *
     * @param Transaction   $transaction
     * 
     * @return Array ['success', 'transaction_id', 'amount', 'destination', 'status', 'card_last_digits']
     */
    public function retrieve(Transaction $transaction, Payment $payment = null);

    /**
     *  Create a new credit card
     *
     * @param Payment       $payment
     * @param User          $user               The customer that this card belongs to
     * 
     * @return Array ['success', 'token', 'card_token', 'customer_id', 'card_type', 'last_four']
     */
    public function createCard(Payment $payment, User $user = null);

    /**
     *  Delete a existing credit card
     *
     * @param Payment       $payment
     * @param User          $user               The customer that this card belongs to
     * 
     * @return Array ['success']
     */
    public function deleteCard(Payment $payment, User $user = null);


    /**
     *  Create accounts for users
     *
     * @param LedgerBankAccount       $ledgerBankAccount
     * 
     * @return Array ['success', 'recipient_id']
     */
    public function createOrUpdateAccount(LedgerBankAccount $ledgerBankAccount);

    /**
     *  Return a gateway fee
     * 
     * @return Decimal
     */
    public function getGatewayFee();

    /**
     *  Return a gateway tax
     * 
     * @return Decimal
     */
    public function getGatewayTax();

    /**
     *  Return a date for the next compensation
     * 
     * @return Carbon
     */
    public function getNextCompensationDate();


    /**
     *  Return a bool value that determine if auto transfer to provider is enabled
     * 
     * @return bool
     */
    public function checkAutoTransferProvider();

    /**
     *  Return a date for the next compensation
     * 
     * @return Password
     */ 
    // public function createDirectPassword($encryptKey, $encryptValue);

    /**
     *  Return a date for the next compensation
     * 
     * @return Token
     */ 
    // public function createDirectToken();

    /**
     * Paid the debit transaction
     *
     * @param Object        $payment        Object that represents requester card.
     * @param Decimal       $amount         Decimal that represents amount paied on debit card.
     * @param String        $description    String that represents details of transaction.
     *
     * @return Array       [
     *                      'success',
	 *                      'captured',
	 *                      'paid',
	 *                      'status',
	 *                      'transaction_id'
     *                     ]
     */
    public function debit(Payment $payment, $amount, $description);

    /**
     * Paid the debit transaction with split rules
     *
     * @param Object        $payment        Object that represents requester card.
     * @param Object        $provider       Object that represents provider of the service.
     * @param Decimal       $totalAmount    A positive decimal representing how much to debit.
     * @param Decimal       $providerAmount A positive decimal representing how much provider recives into the transaction.
     * @param String        $description    String that represents details of transaction.
     *
     * @return Array       [
     *                      'success',
	 *                      'captured',
	 *                      'paid',
	 *                      'status',
	 *                      'transaction_id'
     *                     ]
     */
    public function debitWithSplit(Payment $payment, Provider $provider, $totalAmount, $providerAmount, $description);

    /**
     * Create a pix charge
     *
     * @param Decimal       $amount         A positive decimal representing how much to charge.
     * @param Object        $holder         User / Provider instance
     * @return Array       [
     *                      'success',
     *                      'qr_code_base64'
     *                      'copy_and_paste'
	 *                      'transaction_id'
     *                     ]
     */
    public function pixCharge($amount, $holder);

    /**
     * Retrieve a pix charge
     *
     * @param Decimal       transaction_id
     * @param Object        $request         gateway postback api request instance
     * @return Array       [
     *                      'success',
     *                      'transaction_id'
     *                      'paid'
     *                      'value'
     *                      'qr_code_base64'
     *                      'copy_and_paste'
     *                     ]
     */
    public function retrievePix($transaction_id, $request = null);

}
