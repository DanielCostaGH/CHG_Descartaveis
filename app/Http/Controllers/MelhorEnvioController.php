<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\MelhorEnvioServiceProvider;
use App\Models\TokenFrete;
use GuzzleHttp\Client;



class MelhorEnvioController extends Controller
{

    public function redirectToProvider()
    {
        $clientId = env('MELHOR_ENVIO_CLIENT_ID');
        $redirectUri = urlencode(env('MELHOR_ENVIO_REDIRECT_URI'));

        $urlDeAutorizacao = "https://sandbox.melhorenvio.com.br/oauth/authorize?response_type=code&client_id={$clientId}&redirect_uri={$redirectUri}";
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
        $client = new Client();
        $fromPostalCode = '30810423';
        $toPostalCode = $request->to['postal_code'];

        $token = TokenFrete::latest()->first()->access_token;

        $products = $request->products;

        $response = $client->request('POST', 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/calculate', [
            'headers' => [
              'Accept' => 'application/json',
              'Authorization' => 'Bearer ' . $token,
              'Content-Type' => 'application/json',
              'User-Agent' => 'CHG Descatáveis (dfscs.costa@gmail.com)'
            ],
            'json' => [
                'from' => ['postal_code' => $fromPostalCode],
                'to' => ['postal_code' => $toPostalCode],
                'volumes' => $products,
                'services' => '1,2,3,4,17',
                'options' => [
                    'receipt' => false,
                    'own_hand' => false
                ],
            ],
        ]);

        return response()->json(json_decode((string) $response->getBody(), true));
    }
}
