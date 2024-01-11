<?php


namespace Vince\AcmeDoorPad;


use Illuminate\Support\ServiceProvider;

class AcmeDoorPadBaseServiceProvider extends ServiceProvider
{
    public function boot(){
        $this->registerResources();
    }

    public function register(){

    }

    private function registerResources(){
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
    }
}