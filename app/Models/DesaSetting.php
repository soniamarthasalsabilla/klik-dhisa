<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesaSetting extends Model
{
    protected $table = 'desa_settings';
    protected $fillable = ['key', 'value'];

    public static function get(string $key, string $default = ''): string
    {
        $setting = static::where('key', $key)->first();
        return $setting ? (string) $setting->value : $default;
    }

    public static function set(string $key, ?string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
