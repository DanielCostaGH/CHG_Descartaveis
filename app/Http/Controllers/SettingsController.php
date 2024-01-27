<?php

namespace App\Http\Controllers;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getConfigValue(Request $request) {
        $settingsNames = $request->input('settings', []);
        $settings = Settings::getSettingsValues($settingsNames);

        return response()->json($settings);
    }
}
