<?php


namespace Vince\AcmeDoorPad\Tests;


use Vince\AcmeDoorPad\AcmeDoorPadBaseServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

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

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
            'driver'=>'sqlite',
            'database'=>':memory:'
        ]);

    }
}