<?php

namespace App\Service;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    /**
     * Get the payment settings from the database, and cache them forever.
     *
     * @return array
     */
    public function get_settings(): array
    {
        return Cache::rememberForever('settings', function () {
            return Setting::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Set the settings in the config file.
     *
     */
    public function set_global_settings()
    {
        $settings = $this->get_settings();
        config()->set('settings', $settings);
    }
}
