<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->overrideConfigValues();
    }

    protected function overrideConfigValues(){
        $config = [];
        if (config('settings.skin')) {
            $config['backpack.base.skin'] = config('settings.skin');
        }
        if (config('settings.show_powered_by')) {
            $config['backpack.base.show_powered_by'] = config('settings.show_powered_by') == '1';
        }
        if (config('settings.app_name')) {
            $config['app.name'] = config('settings.app_name');
        }
        config($config);
    }
}
