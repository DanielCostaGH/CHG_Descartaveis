<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\MelhorEnvioServiceProvider;
use App\Models\TokenFrete; 

class MelhorEnvioController extends Controller
{
    public function handleCallback(Request $request, MelhorEnvioServiceProvider $melhorEnvio)
    {
        $code = $request->query('code');
        if ($code) {
            $tokenResponse = $melhorEnvio->getToken($code);

            if (isset($tokenResponse['access_token'])) {
                $accessToken = $tokenResponse['access_token'];
                $expiresAt = now()->addSeconds($tokenResponse['expires_in']);

                $token = new TokenFrete();
                $token->access_token = $accessToken;
                $token->expires_at = $expiresAt;
                $token->save();

            } else {
            // erro a tratar dps 
        }
        } else {
            // erro a tratar dps 
        }
    }
}

