<?php


namespace Vince\AcmeDoorPad;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Config;
use Vince\AcmeDoorPad\Console\SecurityKeyCommand;

class AcmeDoorPadBaseServiceProvider extends ServiceProvider
{
    public function boot(){
        if($this->app->runningInConsole()){
            $this->registerPublishing();
        }

        $this->registerResources();
        $this->registerRoutes();

    }

    public function register(){
        $this->commands([
            SecurityKeyCommand::class,
        ]);
    }

    private function registerResources(){
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }


    protected function registerRoutes(){
        Route::group($this->routeConfiguration(), function(){
           $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    private function routeConfiguration()
    {
        return [
            'prefix' => config('acme_access.acme_access')==null ? 'acme_access' : config('acme_access.acme_access'),
        ];
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/acme_access.php' => config_path('acme_access.php')
        ], 'acme-config');
    }
}