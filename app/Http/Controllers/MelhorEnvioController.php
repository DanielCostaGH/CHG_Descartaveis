<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\MelhorEnvioServiceProvider;
use App\Models\TokenFrete;

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
        $fromPostalCode = '31365-000';
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

        return response()->json($response, 200);
    }


}
