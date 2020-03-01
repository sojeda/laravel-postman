<?php

namespace Phpsa\LaravelPostman;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Phpsa\LaravelPostman\Helper;

class ServiceProvider extends LaravelServiceProvider
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
        $this->app->singleton('Phpsa\LaravelPostman\Helper', function($app)
        {
            return new Helper();
        });
        
        $this->commands('Phpsa\LaravelPostman\LaravelPostmanCommand');
        
        $configFilePath = __DIR__ . '/../config/laravelPostman.php';
        $this->publishes([
            $configFilePath => config_path('laravelPostman.php'),
        ]);
    }
}
