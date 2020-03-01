<?php

namespace Phpsa\LaravelPostman;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Phpsa\LaravelPostman\Helper;

class ServiceProvider extends LaravelServiceProvider
{

    protected const CONFIG_PATH = __DIR__ . '/../config/postman.php';

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('postman.php'),
        ], 'config');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {

        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'postman'
        );

        $this->app->singleton('Phpsa\LaravelPostman\Helper', static function ($app) {
            return new Helper();
        });

        $this->commands('Phpsa\LaravelPostman\LaravelPostmanCommand');
    }
}
