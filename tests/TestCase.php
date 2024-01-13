<?php


namespace Vince\AcmeDoorPad\Tests;


use Vince\AcmeDoorPad\AcmeDoorPadBaseServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{


    protected function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__.'/../database/factories');
    }

    /**
     * Make sure we override getPackageProviders to use our packages service provider.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            AcmeDoorPadBaseServiceProvider::class
        ];
    }


    /**
     * Sets up our in memory connection for database testing.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
            'driver'=>'sqlite',
            'database'=>':memory:'
        ]);

    }
}