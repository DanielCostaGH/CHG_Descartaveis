<?php

namespace App\Http\Controllers;
use App\Models\Settings;
use App\Models\TokenFrete;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getConfigValue(Request $request) {
        $settings = Settings::all();
        return response()->json($settings);
    }

    public function freteUpdate(Request $request){
        $validatedData = $request->validate([
            'freight' => 'numeric',
            'zipcode' => 'numeric|max:9'
        ]);
    
        // Atualiza o valor do frete
        $freightSetting = Settings::where('name', 'freight')->first();
    
        if ($freightSetting) {
            $freightSetting->value = $validatedData['freight'];
            $freightSetting->save();
        } else {
            Settings::create([
                'name' => 'freight',
                'value' => $validatedData['freight']
            ]);
        }
    
        // Atualize o zipcode
        $zipcodeSetting = Settings::where('name', 'zipcode')->first();
    
        if ($zipcodeSetting) {
            $zipcodeSetting->value = $validatedData['zipcode'];
            $zipcodeSetting->save();
        } else {
            // Se a configuração do zipcode não existir, crie-a
            Settings::create([
                'name' => 'zipcode',
                'value' => $validatedData['zipcode']
            ]);
        }
    
        return response()->json(['message' => 'Configurações de frete e CEP atualizadas com sucesso!']);
    }

    public function updateAccessToken(Request $request){
        $freightToken = TokenFrete::first();
        if($freightToken){
            $freightToken->access_token = $request->token;
            $freightToken->expires_at = Carbon::now()->addMonths(6);
            $freightToken->save();
        } else {
            TokenFrete::create([
                'access_token' => $request->token,
                'expires_at'   => Carbon::now()->addMonths(6)
            ]);
        }

        return response()->json(['message' => 'Token salvo com sucesso!']);
    }
    
}
