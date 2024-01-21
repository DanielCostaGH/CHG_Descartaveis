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

    return redirect($urlDeAutorizacao);
}


    public function handleCallback(Request $request, MelhorEnvioServiceProvider $melhorEnvio)
{
    dd('Callback chamado');
    $code = $request->query('code');
    if (!$code) {
        return response()->json(['error' => 'Código de autorização não recebido.'], 400);
    }

    try {
        $tokenResponse = $melhorEnvio->getToken($code);

        if (!isset($tokenResponse['access_token'])) {
            return response()->json(['error' => 'Token de acesso não recebido.'], 500);
        }
        $accessToken = $tokenResponse['access_token'];
        $expiresAt = now()->addSeconds($tokenResponse['expires_in']);

        $token = new TokenFrete();
        $token->access_token = $accessToken;
        $token->expires_at = $expiresAt;
        $token->save();

        return response()->json(['message' => 'Token recebido e salvo com sucesso.']);

    } catch (\Exception $e) {
        return response()->json(['error' => 'Erro ao processar a solicitação.'], 500);
    }
}



    public function calculate(Request $request)
    {
        $client = new Client();
        $fromPostalCode = '30810423'; 
        $toPostalCode = $request->to['postal_code']; // CEP de destino

        $token = TokenFrete::latest()->first()->access_token;

        $products = $request->products; 

        $response = $client->request('POST', 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/calculate', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'from' => ['postal_code' => $fromPostalCode],
                'to' => ['postal_code' => $toPostalCode],
                'volumes' => $products,
                'services' => '1,2,3,4,12,15,16,17,22,27,28,29,30,31,32,33', 
                'options' => [
                    'receipt' => false,
                    'own_hand' => false
                ],
            ],
        ]);

        return response()->json(json_decode((string) $response->getBody(), true));
    }
}
