<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\MelhorEnvioServiceProvider;
use App\Models\TokenFrete;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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




    // public function calculate(Request $request)
    // {
    //     $fromPostalCode = '96055-710';
    //     $toPostalCode = $request->to['postal_code'];
    //     $token = TokenFrete::latest()->first()->access_token;
    //     $response = Http::withHeaders([
    //         'Accept' => 'application/json',
    //         'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0MTUxIiwianRpIjoiNGZjNTMxYjFlYWQ0YjcwMjI1YzI0YWY0NDJiNmFmNWMyZmYzMjFlNDY2MTgyOTU0Y2M0MjU3YmMyOGYzNTlmZWNhYjY4ZjJjZDZjYjBhOGUiLCJpYXQiOjE3MTA0NTUwNTkuODI4MjM1LCJuYmYiOjE3MTA0NTUwNTkuODI4MjM5LCJleHAiOjE3MTMwNDcwNTkuNzkwMzYyLCJzdWIiOiI5YjMxYmZkMi1jYWNjLTQ3YzYtODIyNS0xNDg3MGQ4NzRmYjkiLCJzY29wZXMiOltdfQ.jDKPbhgqAdmUa4z4dp635XYSt9LrI4nnLqDbikzB_3YKW6Mk_NIwcpM4L8O0ugujJ1K0rs_RNEoh1POI7JP7wU_zBFSq0T3N8Ow50PHRX8Pi6nELPi81HD05Z9q5As611i5ccEAIpienOrZjCBZKyGhHAOm3wB-qLGBir2DH49Hv6TOsNsX-43wC_xjGbvWwF-Ga6eERw0uJx6xmqZV_-gn4o6bcTFY6DZpR9v0lRdGHYTGE19h90vjbDF_OrB86RpJfBA5mZd5hQhAFF6sEdTx9ws2xKuTw_NPcKbEXN9xugEu5H92C-QVF4ujU0Cly1CSYxVGzyvsUq746KtqP9Ut2eZcKrgOgfAOTkMG9GAPuMhFI6h-8XNdr2_QN6PcB7qyidvpspcttpcPWne975SQag29HlaiG9cGjz-6z_M58xZ5bu2AS7RdIervecXgXBPuZ-pSDR76a7sKUII9NsC4Nk7NEfg5CWTElu3tOr5u5iU4xCc-dL8oSy74TtPlqWUwvWEhSthd0l99edhjJdIY-1QGTF2B9waE3bRpKSyyCGJNdsLSMGa4YwAxQ34SeNK2AdHSAMXhMtpil9LJzrveQx6REk5D8jkurIkddbNUSnEXcoZHoTEq3_Y3zDH7gD8Zey9_mTk3UgGWvATictfMLRM7beYVb_dvoPr9iLMg', 
    //         'Content-Type' => 'application/json',
    //         'User-Agent' => 'CHG_Descartáveis (dfscs.costa@gmail.com)',
    //     ])->post('https://melhorenvio.com.br/api/v2/me/shipment/calculate', [
    //         "from" => [
    //             "postal_code" => "96055-710"
    //         ],
    //         "to" => [
    //             "postal_code" => "26210000"
    //         ],
    //         "package" => [ 
    //             [
    //                 "width" => 1,
    //                 "height" => 5,
    //                 "length" => 10,
    //                 "weight" => 0.1   
    //             ]
    //         ],
    //         "options" => [
    //             "insurance_value" => 50,
    //             "receipt" => false,
    //             "own_hand" => false,
    //             "collect" => false
    //         ]
    //     ]);
    //     dd($response);
        
    //     $responseData = $response->json();
    // }

    public function calculate(Request $request)
    {
        $fromPostalCode = '96055-710';
        $toPostalCode = $request->to['postal_code'];
        $token = TokenFrete::latest()->first()->access_token;

        $ch = curl_init();

        $postData = [
            "from" => [
                "postal_code" => "96055-710"
            ],
            "to" => [
                "postal_code" => "26210000"
            ],
            "package" => [ 
                [
                    "width" => 1,
                    "height" => 5,
                    "length" => 10,
                    "weight" => 0.1   
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
