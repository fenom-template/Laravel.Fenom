<?php

namespace Pafnuty\Fenom;

use Fenom;
use Illuminate\Support\ServiceProvider;

class FenomViewServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLoader();
        $this->registerFenom();

        $this->app->bind('view', function ($app) {
            return new FenomFactory($app);
        });
    }

    public function registerLoader()
    {

        $this->app->singleton('fenom.loader', function ($app) {
            $view_paths = $app['config']['view']['paths'];
            return $view_paths[0];
        });

    }

    public function registerFenom()
    {
        $this->app->singleton('fenom', function ($app) {
            $options = [];

            $fenom = Fenom::factory($app['fenom.loader'],storage_path() . '/fenom/cache', $options);

            // register globals
            //$fenom->addGlobal('app', $app);

            return $fenom;
        });
    }

}