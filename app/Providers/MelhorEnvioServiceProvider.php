<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class MelhorEnvioServiceProvider extends ServiceProvider
{
    public function getToken($code)
    {
        dd($code);
        $client = new Client();
        $response = $client->request('POST', 'https://sandbox.melhorenvio.com.br/oauth/token', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'User-Agent' => 'CHG_Descartaveis (dfscs.snow@gmail.com)',
            ],
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => env('MELHOR_ENVIO_CLIENT_ID'),
                'client_secret' => env('MELHOR_ENVIO_CLIENT_SECRET'),
                'redirect_uri' => env('MELHOR_ENVIO_REDIRECT_URI'),
                'code' => $code,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
