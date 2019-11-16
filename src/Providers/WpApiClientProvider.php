<?php

namespace Therour\WpApiClient\Providers;

use Illuminate\Support\ServiceProvider;
use Therour\WpApiClient\Params\ParamBuilder;
use Therour\WpApiClient\Contracts\WpApiExecutor;
use Therour\WpApiClient\Executor\GuzzleExecutor;

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

        $this->app->singleton(ParamBuilder::class, function ($app) {
            $mapClasses = $app['config']->get('wordpress.classes.params', []);
            return new ParamBuilder($mapClasses);
        });

        $this->app->singleton(WpApiExecutor::class, function ($app) {
            $config = $app['config']->get('wordpress');
            return new GuzzleExecutor($app->make(\GuzzleHttp\Client::class), $config);
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../configs/wordpress.php' => config_path('wordpress.php'),
            ]);
        }
    }
}
