<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable = ['name', 'value'];

    public static function getSettingsValues($settingsNames) {
        return static::whereIn('name', $settingsNames)->pluck('value', 'name');
    }
}
