<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use Api;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('platform', function() {
            return new \Platform(Api\VoyagerApi::SHOPIFY_PLATFORM);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
