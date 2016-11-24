<?php

namespace JimenezMaximiliano\LaravelPostman;

use Illuminate\Support\ServiceProvider;
use JimenezMaximiliano\LaravelPostman\Helper;

class LaravelPostmanServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('JimenezMaximiliano\LaravelPostman\Helper', function($app)
        {
            return new Helper();
        });
        
        $this->commands('JimenezMaximiliano\LaravelPostman\LaravelPostmanCommand');
        
        $configFilePath = __DIR__ . '/../config/laravelPostman.php';
        $this->publishes([
            $configFilePath => config_path('laravelPostman.php'),
        ]);
    }
}