<?php

namespace App\Http\Controllers;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getConfigValue(Request $request) {
        $settings = Settings::all();
        return response()->json($settings);
    }

    public function freteUpdate(Request $request){
        $validatedData = $request->validate([
            'freight' => 'required|numeric',
            'zipcode' => 'required|string|max:9'
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
    
}
