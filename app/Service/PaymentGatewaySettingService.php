<?php

namespace App\Service;

use App\Models\PaymentSetting;
use Illuminate\Support\Facades\Cache;

class PaymentGatewaySettingService
{

    /**
     * Get the payment settings from the database, and cache them forever.
     *
     * @return array
     */
    public function get_settings(): array
    {
        return Cache::rememberForever('gatewaySettings', function () {
            return PaymentSetting::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Set the settings in the config file.
     *
     */
    public function set_global_settings()
    {
        $settings = $this->get_settings();
        config()->set('gateway_setting', $settings);
    }
}
