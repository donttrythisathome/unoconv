<?php

namespace Dtth\Unoconv;

use Illuminate\Support\ServiceProvider;

class UnoconvServiceProvider extends ServiceProvider
{
    /**
     * Boot the Unoconv service.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('unoconv.php'),
        ]);
    }

    /**
     * Register the Unoconv service.
     */
    public function register()
    {
        $this->app->singleton('unoconv',function ($app){
            return new UnoconvManager($app);
        });
    }
}