<?php

namespace App\Providers;

use Config;
use App\Setting;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (\Schema::hasTable('settings')) {
            
            if ($settings = Setting::first()) {
                // Mail Configuration
                $this->app['config']['mail'] = [
                    'driver' => $settings->mail_driver,
                    'host' => $settings->mail_host,
                    'port' => $settings->mail_port,
                    'from' => [
                        'address' => $settings->mail_from,
                        'name' => $settings->site_name
                    ],
                    'encryption' => $settings->mail_encryption,
                    'username' => $settings->mail_username,
                    'password' => $settings->mail_password,
                ];

                Config::set('app.name', $settings->site_name);
                Config::set('app.url', $settings->site_url);

                //Force SSL
                if($settings->ssl == 1) {
                    \URL::forceScheme('https');
                }

                // Disable Debugegr
                if($settings->app_debug == 0) {
                    Config::set('app.debug', false);
                }
            }
        }
    }
}
