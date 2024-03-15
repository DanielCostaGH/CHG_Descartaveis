<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class MelhorEnvioServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(MelhorEnvioServiceProvider::class, function ($app) {
            return new MelhorEnvioServiceProvider($app);
        });
    }

    public function getToken($code)
    {
        $client = new Client();

        // Atenção: 'form_params' é usado em vez de 'json', pois estamos enviando dados de formulário
        $response = $client->request('POST', 'https://melhorenvio.com.br/oauth/token', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => '14301',
                'client_secret' => 'vy4PrPr4KBlbrotfKOcR85woGpEOyVbDoGWlAdJH',
                'redirect_uri' => 'https://63f3-2804-14c-5bd2-8632-40a8-bae6-e1f7-c934.ngrok-free.app/auth',
                'code' => $code,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

}
