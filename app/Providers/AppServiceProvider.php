<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
//use Laravel\Sanctum\Sanctum;

//use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Passport::ignoreRoutes();
//        Sanctum::ignoreMigrations();
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
//        Model::preventLazyLoading(! $this->app->isProduction());
    }
}
