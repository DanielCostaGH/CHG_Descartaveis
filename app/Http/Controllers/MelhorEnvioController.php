<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Providers\MelhorEnvioServiceProvider;
use App\Models\TokenFrete;
use App\Models\User;
use App\Models\UserAddress;

class MelhorEnvioController extends Controller
{

    public function redirectToProvider()
    {
        $clientId = '14301';
        $redirectUri = 'https://63f3-2804-14c-5bd2-8632-40a8-bae6-e1f7-c934.ngrok-free.app/auth';

        $urlDeAutorizacao = "https://app.melhorenvio.com.br/oauth/authorize?response_type=code&client_id={$clientId}&redirect_uri={$redirectUri}";
        return response()->json(['authUrl' => $urlDeAutorizacao]);
    }


    public function handleProviderCallback(Request $request)
    {
        $melhorEnvio = app(MelhorEnvioServiceProvider::class);
        $code = $request->query('code');
        if (!$code) {
            return response()->json(['error' => 'Código de autorização não recebido.'], 400);
        }

        $tokenResponse = $melhorEnvio->getToken($code);

        if (!isset($tokenResponse['access_token'])) {
            return response()->json(['error' => 'Token de acesso não recebido.'], 500);
        }

        $tokenData = [
            'access_token' => $tokenResponse['access_token'],
            'expires_at' => now()->addSeconds($tokenResponse['expires_in']),
        ];

        $existingToken = TokenFrete::first();
        if ($existingToken) {
            $existingToken->update($tokenData);
        } else {
            TokenFrete::create($tokenData);
        }

        return redirect('/dashboard/config');
    }

    public function calculate(Request $request)
    {
        $fromPostalCode = Settings::where('name', 'zipcode')->first()->value;
        $toPostalCode = $request->to['postal_code'];
        $token = TokenFrete::latest()->first()->access_token;    
        $packages = [];

        $packageData = [
            'width' => 0,
            'height' => 0,
            'length' => 0,
            'weight' => 0
        ];
    
        foreach ($request['products'] as $product) {
            $quantity = $product['quantity'];
    
            for ($i = 0; $i < $quantity; $i++) {
                $packed = false;
    
                foreach ($packages as &$package) {
                    if ($this->tryToFit($product, $package)) {
                        $packed = true;
                        break;
                    }
                }
    
                if (!$packed) {
                    $packageData['width'] += $product['width'];
                    $packageData['height'] += $product['height'];
                    $packageData['length'] += $product['length'];
                    $packageData['weight'] += $product['weight'];
                }
            }
        }    
        $package = $packageData;

        $ch = curl_init();

        $postData = [
            "from" => [
                "postal_code" => $fromPostalCode
            ],
            "to" => [
                "postal_code" => $toPostalCode
            ],
            "package" => [ 
                [
                    "width" => $package['width'],
                    "height" => $package['height'],
                    "length" => $package['length'],
                    "weight" => $package['weight']   
                ]
            ],
            "options" => [
                "insurance_value" => 0,
                "receipt" => false,
                "own_hand" => false,
                "collect" => false
            ],
            "services" => "1,2,3,4,15,16,17,27,28,29,30",
        ];

        curl_setopt($ch, CURLOPT_URL, 'https://melhorenvio.com.br/api/v2/me/shipment/calculate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token,
            'User-Agent: CHG_Descartaveis (dfscs.costa@gmail.com)'
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response, true);

        $minPriceService = null;
        $minPrice = PHP_INT_MAX; 

        foreach ($response as $service) {
            if (isset($service['price']) && $service['price'] < $minPrice) {
                $minPrice = $service['price'];
                $minPriceService = $service;
            }
        }
        $freight = Settings::where('name', 'freight')->first();

        if (isset($freight)) {
            $minPriceService['price'] = $freight->value;
        }

        if ($minPriceService !== null) {
            return response()->json($minPriceService, 200);
        } else {
            return response()->json(['error' => 'Nenhum serviço com preço encontrado.'], 404);
        }
            return response()->json($response, $package, 200);
        }

    public static function createShipment(Request $request) {
        $user = User::find($request->userId);
        $userAddress = UserAddress::where('user_id', $user['id'])->first();
        $fromPostalCode = Settings::where('name', 'zipcode')->first()->value;
        $toPostalCode = $userAddress->zipcode;
        $token = TokenFrete::latest()->first()->access_token; 
        $package = $request['packages'];


        $serviceId = $request['service']['id'];
        $ch = curl_init();

        $postData = [
            "service" => [
                "id" => 2
            ],
            "from" => [
                "postal_code" => $fromPostalCode,
                "name" => $user['name'],
                "address" => "Rua Geraldo pereira da silva",
                "city" => "Belo Horizonte",
                "document" => "93557043649",
            ],
            "to" => [
                "postal_code" => $toPostalCode,
                "name" => "CHG Descartáveis",
                "address" => "Av. Santa Terezinha",
                "city" => "Belo Horizonte",
                "document" => $user['document'],
                "number" => $userAddress['number'],
            ],
            "package" => [ 
                [
                    "width" => $package[0]['dimensions']['width'],
                    "height" => $package[0]['dimensions']['height'],
                    "length" => $package[0]['dimensions']['length'],
                    "weight" => $package[0]['weight']   
                ]
            ],
            "options" => [
                "insurance_value" => 12,
                "receipt" => false,
                "own_hand" => false,
                "collect" => false
            ],
        ];

        curl_setopt($ch, CURLOPT_URL, 'https://melhorenvio.com.br/api/v2/me/cart');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token,
            'User-Agent: CHG_Descartaveis (dfscs.costa@gmail.com)'
        ]);

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response, true);


    }

    public static function rastrearPedido(Request $request) {
        $ch = curl_init();
        $token = TokenFrete::latest()->first()->access_token; 

        $postData = [
            "orders" => [
                "id" => "9b96b38c-e735-41b6-9877-30279d2229cf"
            ],
        ];


        curl_setopt($ch, CURLOPT_URL, 'https://melhorenvio.com.br/api/v2/me/shipment/tracking');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token,
            'User-Agent: CHG_Descartaveis (dfscs.costa@gmail.com)'
        ]);

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response, true);
    }

}
