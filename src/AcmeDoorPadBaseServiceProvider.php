<?php


namespace Vince\AcmeDoorPad;


use Illuminate\Support\ServiceProvider;
use Vince\AcmeDoorPad\Console\SecurityKeyCommand;

class AcmeDoorPadBaseServiceProvider extends ServiceProvider
{
    public function boot(){
        $this->registerResources();

    }

    public function register(){
        $this->commands([
            SecurityKeyCommand::class,
        ]);
    }

    private function registerResources(){
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}