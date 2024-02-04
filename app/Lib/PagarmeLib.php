<?php

namespace Lib;

use Carbon\Carbon;

use Lib\PagarmeApi;

use ApiErrors;
use Codificar\PaymentGateways\Libs\handle\pagarme\HandleResponsePagarmeV5;
use Codificar\PaymentGateways\Libs\handle\message\MessageExceptionPagarme;
use Codificar\PaymentGateways\Libs\IPayment;
use Codificar\PaymentGateways\Utils\Functions;
use Exception;
use Payment;
use Provider;
use Transaction;
use User;
use LedgerBankAccount;
use Settings;
use Log;

class PagarmeLib implements IPayment
{
    /**
     * Payment status strings
     */
    const GATEWAY_PAID						=	"paid";
    const GATEWAY_FAILED					=	"failed";
    const GATEWAY_VOIDED					=	"voided";
    const GATEWAY_CAPTURED					=	"captured";
    const GATEWAY_REFUNDED					=	"refunded";
    const GATEWAY_OVERPAID					=	"overpaid";
    const GATEWAY_GENERATED					=	"generated";
    const GATEWAY_UNDERPAID					=	"underpaid";
    const GATEWAY_PROCESSING				=	"processing";
    const GATEWAY_WITH_ERROR				=	"with_error";
    const GATEWAY_PARTIAL_VOID				=	"partial_void";
    const GATEWAY_NOT_AUTHORIZED			=	"not_authorized";
    const GATEWAY_PARTIAL_CAPTURE			=	"partial_capture";
    const GATEWAY_WAITING_CAPTURE			=	"waiting_capture";
    const GATEWAY_ERROR_ON_VOIDING			=	"error_on_voiding";
    const GATEWAY_PARTIAL_REFUNDED			=	"partial_refunded";
    const GATEWAY_ERROR_ON_REFUNDING		=	"error_on_refunding";
    const GATEWAY_WAITING_CANCELATION		=	"waiting_cancellation";
    const GATEWAY_AUTHORIZED_PENDING_CAPTURE=	"authorized_pending_capture";

    /**
     * Payment status string
     */
    const PAYMENT_NOTFINISHED  =   'not_finished';
    const PAYMENT_AUTHORIZED   =   'authorized';
    const PAYMENT_PAID         =   'paid';
    const PAYMENT_DENIED       =   'denied';
    const PAYMENT_VOIDED       =   'voided';
    const PAYMENT_REFUNDED     =   'refunded';
    const PAYMENT_PENDING      =   'pending';
    const PAYMENT_ABORTED      =   'aborted';
    const PAYMENT_SCHEDULED    =   'scheduled';
    const PAYMENT_ERROR        =   'error';

    const WAITING_PAYMENT = 'waiting_payment';
    
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
    public function charge(Payment $payment, $amount, $description, $capture = true, User $user = null, Provider $provider = null, $estimateValueProvider = null)
    {
        try {
            $response = PagarmeApi::chargeWithOrNotSplit($payment, $provider ?? null, $amount, $estimateValueProvider ?? null, $capture);
            $response = HandleResponsePagarmeV5::handle($response);

            if(!$response['success']){
                return $response;
            }

            $response = $response['data'];
            $statusMessage = $response->data->charges[0]->last_transaction->status;
            return array(
                'success'           =>  true,
                'captured'          =>  $statusMessage == self::GATEWAY_CAPTURED ? true : false,
                'paid'              =>  $statusMessage == self::GATEWAY_CAPTURED ? true : false,
                'status'            =>  $statusMessage == self::GATEWAY_CAPTURED ? 'paid' : 'authorized',
                'transaction_id'    =>  (string)$response->data->charges[0]->id
            );
            
        } catch (Exception $th) {
            Log::error($th->getMessage() . $th->getTraceAsString());

			return array(
				"success"           =>  false ,
				'data'              =>  null,
                'status'            => self::PAYMENT_ERROR,
				'transaction_id'    =>  '',
				'error' => array(
					"code"      =>  ApiErrors::CARD_ERROR,
					"messages"  =>  array(trans('creditCard.customerCreationFail'))
				)
            );
        }
    }

    /**
     * Função para gerar boletos de pagamentos
     * @param int $amount valor do boleto
     * @param User/Provider $client instância do usuário ou prestador
     * @param string $postBackUrl url para receber notificações do status do pagamento
     * @param string $billetExpirationDate data de expiração do boleto
     * @param string $billetInstructions descrição no boleto
     * @return array
     */
    public function billetCharge($amount, $client, $postBackUrl, $billetExpirationDate, $billetInstructions)
    {
        try {
            $response = PagarmeApi::billetCharge($amount, $client, $billetExpirationDate);

            if (
                (isset($response->success) && $response->success) 
                || isset($response->data->charges[0]->id)
            ) {
                return array(
                    'success'                   =>  true,
                    'captured'                  =>  false,
                    'paid'                      =>  false,
                    'status'                    =>  self::WAITING_PAYMENT,
                    'transaction_id'            =>  (string)$response->data->charges[0]->id,
                    'billet_url'                =>  $response->data->charges[0]->last_transaction->url,
                    'digitable_line'            =>  $response->data->charges[0]->last_transaction->line,
                    'billet_expiration_date'    =>  Carbon::parse($response->data->charges[0]->last_transaction->due_at)->format('Y-m-d H:i:s')
                );
            } else {
                return array(
                    "success" 				=> false,
                    "type" 					=> 'api_charge_error',
                    "code" 					=> '',
                    "message" 				=> '',
                    "transaction_id"		=> ''
                );
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage() . $th->getTraceAsString());

            return array(
                "success" 				=> false ,
                "type" 					=> 'api_charge_error' ,
                "code" 					=> '',
                "message" 				=> MessageExceptionPagarme::handleMessagePagarmeException($th->getMessage()),
                "transaction_id"		=> ''
            );
        }
    }

    /**
     * Handles the postback returned by the gateway
     * 
     * @param Request       $request
     * @param Integer       $transaction_id 
     * @return array
     */
    public function billetVerify($request, $transaction_id = null)
    {
        try {
            if (
                !isset($request->data->charges[0]->id) ||
                !isset($request->data->charges[0]->last_transaction->transaction_type) ||
                $request->data->charges[0]->last_transaction->transaction_type != 'boleto'
            ) {
                return [
                    'success'       =>  false,
                    'status'        =>  '',
                    'transaction_id'=>  ''
                ];
            }

            Log::alert("postback pagarme billet: " . print_r($request->all(), 1));

            if ($transaction_id) {
                $transaction			=	Transaction::find($transaction_id);
            } else {
                $postBackTransaction	=	$request->data->charges[0]->id;
                $transaction			=	Transaction::getTransactionByGatewayId($postBackTransaction);
            }

            $retrieve					=	$this->retrieve($transaction);
            return [
                'success'           =>  true,
                'status'            =>  $retrieve['status'],
                'transaction_id'    =>  $retrieve['transaction_id']
            ];
        } catch (Exception $ex) {
            Log::error($ex->getMessage() . $ex->getTraceAsString());

            return [
                'success'       =>  false,
                'status'        =>  '',
                'transaction_id'=>  ''
            ];
        }
    }

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
    public function captureWithSplit(Transaction $transaction, Provider $provider, $totalAmount, $providerAmount, Payment $payment = null)
    {
        try {
            $retrievedCharge =  $this->retrieve($transaction);

            $this->checkException($retrievedCharge, 'api_retrievecapture_split_error');

            if ($providerAmount <= 0 || ($providerAmount >= $totalAmount)) {
                return array(
                    "success" 	=> false ,
                    'data' 		=> null,
                    'error' 	=> array(
                        "code" 		=> ApiErrors::CARD_ERROR,
                        "messages" 	=> array(trans('creditCard.customerCreationFail'))
                    )
                );
            }

            $response = PagarmeApi::captureWithSplit($transaction, $provider, $totalAmount, $providerAmount);

            if (
                isset($response->success) &&
                $response->success &&
                isset($response->data) &&
                (
                    $response->data->charges[0]->last_transaction->status == self::GATEWAY_CAPTURED ||
                    $response->data->charges[0]->last_transaction->status == self::GATEWAY_AUTHORIZED_PENDING_CAPTURE
                )
            ) {
                $statusMessage = $response->data->charges[0]->last_transaction->status;
                $result = array(
                    'success' 		 => true,
                    'captured' 		 => $statusMessage == self::GATEWAY_CAPTURED ? true : false,
                    'paid' 			 => $statusMessage == self::GATEWAY_CAPTURED ? true : false,
                    'status' 		 => $statusMessage == self::GATEWAY_CAPTURED ? 'paid' : 'authorized',
                    'transaction_id' => (string)$response->data->charges[0]->id
                );
                return $result;
            } else {
                return array(
                    "success" 	=> false ,
                    'data' 		=> null,
                    'error' 	=> array(
                        "code" 		=> ApiErrors::CARD_ERROR,
                        "messages" 	=> array(trans('creditCard.customerCreationFail'))
                    )
                );
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage() . $th->getTraceAsString());
            
            return array(
                "success" 	=> false ,
                'data' 		=> null,
                "message"   => MessageExceptionPagarme::handleMessagePagarmeException($th->getMessage()),
                'error' 	=> array(
                    "code" 		=> ApiErrors::CARD_ERROR,
                    "messages" 	=> array(trans('creditCard.customerCreationFail'))
                )
            );
        }
    }
    
    /**
     * Capture the payment of an existing, uncaptured, charge
     *
     * @param Transaction   $transaction
     * @param Decimal       $totalAmount        A positive decimal representing how much to capture
     * @param Payment       $payment
     *
     * @return Array ['success', 'status', 'captured', 'paid', 'transaction_id']
     */
    public function capture(Transaction $transaction, $amount, Payment $payment = null)
    {
        try {
            $retrieve = PagarmeApi::retrieve($transaction);
            if($retrieve && $retrieve->data->status == self::GATEWAY_PAID){
                return array(
                    'success' 		 => true,
                    'captured' 		 => true,
                    'paid' 			 => true,
                    'status' 		 => 'paid',
                    'transaction_id' => (string)$transaction->id,
                );
            }
            
            $response = PagarmeApi::capture($transaction, $amount);
            $responseVerify = isset($response->success) &&
            $response->success 
            && isset($response->data) 
            && $response->data->last_transaction->status 
            && $response->data->last_transaction->status == self::GATEWAY_CAPTURED;

            if($responseVerify){
                $statusMessage = $response->data->last_transaction->status;
                return array(
                    'success' 		 => true,
                    'captured' 		 => $statusMessage == self::GATEWAY_CAPTURED ? true : false,
                    'paid' 			 => $statusMessage == self::GATEWAY_CAPTURED ? true : false,
                    'status' 		 => $statusMessage == self::GATEWAY_CAPTURED ? 'paid' : '',
                    'transaction_id' => (string)$response->data->id
                );
            }else {
                return array(
                "success" 	=> false ,
                'data' 		=> null,
                'error' 	=> array(
                        "code" 		=> ApiErrors::CARD_ERROR,
                        "messages" 	=> array(trans('creditCard.customerCreationFail'))
                    )
                );
            }
        }catch (\Throwable $th) {
            Log::error($th->getMessage() . $th->getTraceAsString());
            return array(
                "success" 	=> false ,
                'data' 		=> null,
                "message"   => MessageExceptionPagarme::handleMessagePagarmeException($th->getMessage()),
                'error' 	=> array(
                    "code" 		=> ApiErrors::CARD_ERROR,
                    "messages" 	=> array(trans('creditCard.customerCreationFail'))
                )
            );
        }
    }

    /**
     * Refund a charge that has previously been created
     *
     * @param Transaction   $transaction
     * @param Payment       $payment
     *
     * @return Array ['success', 'status', 'transaction_id']
     */
    public function refund(Transaction $transaction, Payment $payment)
    {
        try {
            $response = PagarmeApi::refund($transaction);
            
            if (
                isset($response->success) &&
                $response->success &&
                isset($response->data) &&
                $response->data->last_transaction->status == self::GATEWAY_REFUNDED
            ) {
                $result = array(
                    "success"           =>  true ,
                    "status"            =>  'refunded',
                    "transaction_id"    =>  (string)$response->data->id
                );
                
                return $result;
            }
        } catch (\Throwable $ex) {
            Log::error($ex->getMessage() . $ex->getTraceAsString());

            return array(
                "success" 			=> false ,
                "type" 				=> 'api_refund_error' ,
                "code" 				=> 'api_refund_error',
                "message"           => MessageExceptionPagarme::handleMessagePagarmeException($ex->getMessage()),
                "transaction_id" 	=> ''
            );
        }
    }

    /**
     * Retrieves the details of a charge that has previously been created
     *
     * @param Transaction   $transaction
     *
     * @return Array ['success', 'transaction_id', 'amount', 'destination', 'status', 'card_last_digits']
     */
    public function retrieve(Transaction $transaction, Payment $payment = null)
    {
        try {
            $response = PagarmeApi::retrieve($transaction);

            if (
                isset($response->success) &&
                $response->success &&
                isset($response->data) &&
                isset($response->data->last_transaction->status)
            ) {
                return array(
                    'success' 			=> true,
                    'transaction_id' 	=> (string)$response->data->id,
                    'amount' 			=> $response->data->amount,
                    'destination' 		=> '',
                    'status' 			=> $this->getStatusString($response->data->last_transaction->status),
                    'card_last_digits' 	=> $payment ? $payment->last_four : ''
                );
            } else {
                Log::error($response->message);

                return array(
                    "success" 			=> false ,
                    "type" 				=> 'api_retrieve_error' ,
                    "code" 				=> 'api_retrieve_error',
                    "message" 			=> MessageExceptionPagarme::handleMessagePagarmeException($response->message)
                );
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage() . $th->getTraceAsString());

            return array(
                "success" 			=>  false ,
                "type" 				=>  'api_refund_error' ,
                "code" 				=>  'api_refund_error',
                "message"           => MessageExceptionPagarme::handleMessagePagarmeException($th->getMessage()),
                "transaction_id" 	=>  ''
            );
        }
    }

    /**
     *  Create a new credit card
     *
     * @param Payment       $payment
     * @param User          $user               The customer that this card belongs to
     *
     * @return Array ['success', 'token', 'card_token', 'customer_id', 'card_type', 'last_four']
     */
    public function createCard(Payment $payment, User $user = null)
    {
        $cardNumber 			= $payment->getCardNumber();

        $result = array(
            'success'		=>	true,
            'customer_id'	=>	'',
            'last_four'		=>	substr($cardNumber, -4),
            'card_type'		=>	detectCardType($cardNumber),
            'card_token'	=>	'',
            'token'	        =>	'',
            'gateway'       => 'pagarme'
        );

        return $result;
    }

    /**
     *  Delete a existing credit card
     *
     * @param Payment       $payment
     * @param User          $user               The customer that this card belongs to
     *
     * @return Array ['success']
     */
    public function deleteCard(Payment $payment, User $user = null)
    {
        $result = array(
            'success'	=>	true
        );
        return $result;
    }

    /**
     *  Create accounts for users
     *
     * @param LedgerBankAccount       $ledgerBankAccount
     *
     * @return Array ['success', 'recipient_id']
     */
    public function createOrUpdateAccount(LedgerBankAccount $ledgerBankAccount)
    {
        try {
            $newAccount = PagarmeApi::createOrUpdateAccount($ledgerBankAccount);

            if ($newAccount->success && isset($newAccount->data->id)) {
                $ledgerBankAccount->recipient_id = $newAccount->data->id;
                if($ledgerBankAccount->gateway) {
                    $ledgerBankAccount->gateway = 'pagarme';
                }
                $ledgerBankAccount->save();
                $result = array(
                    'success'       =>  true,
                    'recipient_id'  =>  $ledgerBankAccount->recipient_id
                );
            } else {
                $result = array(
                    'success'       =>  false,
                    'recipient_id'  =>  null
                );
            }

            return $result;
        } catch (\Throwable $ex) {
            Log::error($ex->getMessage() . $ex->getTraceAsString());

            $result = array(
                "success"               =>  false ,
                "recipient_id"          =>  null,
                "type"                  =>  'api_bankaccount_error' ,
                "code"                  =>  500 ,
                "message"               => MessageExceptionPagarme::handleMessagePagarmeException($ex->getMessage()),
            );

            return $result;
        }
    }

    /**
     *  Return a gateway fee
     *
     * @return Decimal
     */
    public function getGatewayFee()
    {
        return 0.5;
    }

    /**
     *  Return a gateway tax
     *
     * @return Decimal
     */
    public function getGatewayTax()
    {
        return 0.5;
    }

    /**
     *  Return a date for the next compensation
     *
     * @return Carbon
     */
    public function getNextCompensationDate()
    {
        $carbon = Carbon::now();
        $compDays = Settings::findByKey('compensate_provider_days');
        $addDays = ($compDays || (string)$compDays == '0') ? (int)$compDays : 31;
        $carbon->addDays($addDays);
        
        return $carbon;
    }

    /**
     *  Return a bool value that determine if auto transfer to provider is enabled
     *
     * @return bool
     */
    public function checkAutoTransferProvider()
    {
        try {
            if (Settings::findByKey('auto_transfer_provider_payment') == "1") {
                return(true);
            } else {
                return(false);
            }
        } catch (Exception $ex) {
            Log::error($ex);

            return(false);
        }
    }

    /**
     * Make a charge with debit card
     * 
     * @param Payment $payment
     * @param Decimal    $amount
     * @param string  $description
     * @return array
     */
    public function debit(Payment $payment, $amount, $description)
    {
        try {
            $response = PagarmeApi::debit($payment, $amount);

            if (
                isset($response->success) &&
                $response->success &&
                isset($response->data) &&
                $response->data->charges[0]->last_transaction->status == self::GATEWAY_CAPTURED
            ) {
                $statusMessage = $response->data->charges[0]->last_transaction->status;
                $result = array(
                    'success'           =>  true,
                    'captured'          =>  $statusMessage == self::GATEWAY_CAPTURED ? true : false,
                    'paid'              =>  $statusMessage == self::GATEWAY_CAPTURED ? true : false,
                    'status'            =>  $this->getStatusString($statusMessage),
                    'transaction_id'    =>  (string)$response->data->charges[0]->id
                );
                return $result;
            } else {
                return array(
                    "success"           => false ,
                    'data'              => null,
                    'transaction_id'    => -1,
                    'error' => array(
                        "code"      => ApiErrors::CARD_ERROR,
                        "messages"  => array(trans('creditCard.customerCreationFail'))
                    )
                );
            }
        } catch (Exception $th) {
            \Log::error($th->getMessage() . $th->getTraceAsString());

            return array(
                "success"           =>  false ,
                'data'              =>  null,
                'transaction_id'    =>  '',
                "message"           => MessageExceptionPagarme::handleMessagePagarmeException($th->getMessage()),
                'error' => array(
                    "code"      =>  ApiErrors::CARD_ERROR,
                    "messages"  =>  array(trans('creditCard.customerCreationFail'))
                )
            );
        }
    }

    /**
     * Make a debit charge with split
     *
     * @param Payment        $payment 
     * @param Provider       $provider   
     * @param Decimal        $totalAmount
     * @param Decimal        $providerAmount 
     * @param string         $description 
     *  
     * @return array 
     */
    public function debitWithSplit(Payment $payment, Provider $provider, $totalAmount, $providerAmount, $description)
    {
        Log::error('debit_split_not_implemented');

        return array(
            "success" 			=> false,
            "type" 				=> 'api_debit_error',
            "code" 				=> 'api_debit_error',
            "message" 			=> 'split_not_implementd',
            "transaction_id" 	=> ''
        );
    }

    /**
     * Returns status string based on status code
     *
     * @param Integer        $statusCode    Payment status code captured on gateway.
     * @return String                       String related to the payment status code.
     */
    private function getStatusString($statusCode)
    {
        switch ($statusCode) {
            case self::GATEWAY_UNDERPAID:
            case self::GATEWAY_WAITING_CAPTURE:
            case self::GATEWAY_PROCESSING:
                return self::PAYMENT_NOTFINISHED;
            case self::GATEWAY_PARTIAL_CAPTURE:
            case self::GATEWAY_AUTHORIZED_PENDING_CAPTURE:
                return self::PAYMENT_AUTHORIZED;
            case self::GATEWAY_PAID:
            case self::GATEWAY_OVERPAID:
            case self::GATEWAY_CAPTURED:
                return self::PAYMENT_PAID;
            case self::GATEWAY_NOT_AUTHORIZED:
                return self::PAYMENT_DENIED;
            case self::GATEWAY_ERROR_ON_VOIDING:
            case self::GATEWAY_ERROR_ON_REFUNDING:
            case self::GATEWAY_WITH_ERROR:
            case self::GATEWAY_FAILED:
            case self::GATEWAY_PARTIAL_VOID:
            case self::GATEWAY_PARTIAL_REFUNDED:
            case self::GATEWAY_VOIDED:
                return self::PAYMENT_VOIDED;
            case self::GATEWAY_REFUNDED:
                return self::PAYMENT_REFUNDED;
            case self::GATEWAY_GENERATED:
                return self::WAITING_PAYMENT;
            case self::GATEWAY_WAITING_CANCELATION:
                return self::PAYMENT_ABORTED;
            default:
                return 'not_obtained';
        }
    }

    /**
     * Make a charge with pix
     * 
     * @param Decimal $amount
     * @param User    $user
     * @return array
     */
    public function pixCharge($totalAmount, $user, $providerAmount = null, $provider = null)
    {
        try {
            $response = PagarmeApi::pixCharge($totalAmount, $user, $providerAmount, $provider);
            
            if (
                isset($response->success) ||
                $response->success ||
                isset($response->data->charges[0]->id)
            ) {
                return array(
                    'success'                   =>  true,
                    'captured'                  =>  true,
                    'paid'                      =>  false,
                    'status'                    =>  self::WAITING_PAYMENT,
                    'transaction_id'            =>  (string)$response->data->charges[0]->id,
                    'billet_expiration_date'    =>  $response->data->charges[0]->last_transaction->qr_code
                );
            } else {
                return array(
                    "success" 				=>  false,
                    "type" 					=>  'api_charge_error',
                    "code" 					=>  '',
                    "message" 				=>  '',
                    "transaction_id"		=>  '',
                    'billet_expiration_date'=>  ''
                );
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage() . $th->getTraceAsString());

            return array(
                "success" 				=>  false,
                "type" 					=>  'api_charge_error',
                "code" 					=>  '',
                "message"               => MessageExceptionPagarme::handleMessagePagarmeException($th->getMessage()),
                "transaction_id"		=>  '',
                'billet_expiration_date'=>  ''
            );
        }
    }

    /**
     * In the absence of a positive response, creates an exception with error response
     *
     * @param Array         $response           Array corresponding a gateway responses
     * @param String        $errorMessage       An arbitrary string which you can attach to describe a fail
     *
     * @return void
     */
    private function checkException($response, $errorMessage)
    {
        if (!isset($response['success']) || !$response['success']) {
            throw new Exception($errorMessage);
        }
    }

    /**
     * Verifi the pix status
     *
     * @param integer       $transaction_id     
     * @param request       $request     
     *
     * @return array
     */
    public function retrievePix($transaction_id, $request = null)
    {
        \Log::error('retrieve_pix_not_implemented');
        return array(
            "success" 			=> false,
            'paid'				=> false,
            "value" 			=> '',
            "qr_code_base64"    => '',
            "copy_and_paste"    => ''
        );
    }
}