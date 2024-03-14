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
        $response = $client->request('POST', 'https://sandbox.melhorenvio.com.br/oauth/token', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => '4151',
                'client_secret' => 'p0TGKb5HJngC2WedSDI9AnKG7GoP4HBc86Vq07Ki',
                'redirect_uri' => 'https://chgdescartaveis.com/auth',
                'code' => $code,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

}
