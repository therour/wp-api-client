<?php

namespace Therour\WpApiClientTests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Therour\WpApiClient\Providers\WpApiClientProvider;

abstract class TestCase extends BaseTestCase
{
    /**
     * Set the environment config.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        # Setup default database to use sqlite :memory:
        $app['config']->set('wordpress.base_url', 'https://www.angrybirds.com/wp-json');
    }

    /**
     * Register third party package providers.
     *
     * @param [type] $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            WpApiClientProvider::class,
        ];
    }
}
