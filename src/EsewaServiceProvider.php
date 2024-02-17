<?php
namespace Prabin\Esewa;
use Illuminate\Support\ServiceProvider;

class EsewaServiceProvider extends ServiceProvider{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/esewa.php' => config_path('esewa.php'),
        ]);
    }

    public function register()
    {
        $this->app->bind('esewaPrabin', function ($app) {
            return new EsewaPayment();
        });

    }
}