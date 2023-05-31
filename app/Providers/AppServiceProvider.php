<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

//    /**
//     * Bootstrap any application services.
//     */
//    public function boot(): void
//    {
////        $registrar = new \App\MyCustom\Routing\ResourceRegistrar($this->app['router']);
////
////        $this->app->bind('Illuminate\Routing\ResourceRegistrar', function () use ($registrar) {
////            return $registrar;
////        });
//    }


    public function boot()
    {
        Model::preventLazyLoading(! $this->app->isProduction());
    }
}
