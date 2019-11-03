<?php

namespace Therour\WpApiClient\Providers;

use Illuminate\Support\ServiceProvider;
use Therour\WpApiClient\Executor\GuzzleExecutor;
use Therour\WpApiClient\Executor\WpApiExecutor;

class WpApiClientProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../configs/wordpress.php', 'wordpress');

        $this->app->singleton(WpApiExecutor::class, function ($app) {
            $config = $app['config']['wordpress'];
            return new GuzzleExecutor($config['base_url'], $config['namespace'], $config['version']);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../configs/wordpress.php' => config_path('wordpress.php'),
        ]);
    }
}
