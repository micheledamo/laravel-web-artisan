<?php

namespace Micheledamo\LaravelWebArtisan;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Micheledamo\LaravelWebArtisan\Middleware\WebArtisanEnabled;

class LaravelWebArtisanServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('webartisan.php'),
        ], 'config');

        $routeConfig = [
            'namespace' => 'Micheledamo\LaravelWebArtisan\Controllers',
            'prefix' => $this->app['config']->get('webartisan.route_prefix'),
            'domain' => $this->app['config']->get('webartisan.route_domain'),
        ];

        $this->getRouter()->group($routeConfig, function($router) {
            $router->post('run', [
                'uses' => 'WebArtisanCommandController@run',
                'as' => 'webartisan.run',
            ]);
        });

        $this->loadViewsFrom(__DIR__.'/Resources/Views', 'webartisan');

        $this->registerMiddleware(WebArtisanEnabled::class);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'webartisan');
    }

    /**
     * Register the Web Artisan Middleware
     *
     * @param  string $middleware
     */
    protected function registerMiddleware($middleware)
    {
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware($middleware);
    }

    /**
     * Get the active router.
     *
     * @return Router
     */
    protected function getRouter()
    {
        return $this->app['router'];
    }
}