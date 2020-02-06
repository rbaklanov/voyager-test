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
            return new \Platform(Api\VoyagerApi::BIGCOMMERCE_PLATFORM);
        });

        $this->app->bind('ShopifyApi', function() {
            return new \Api\Shopify\ShopifyApi(
                config('api.shopify.store'),
                config('api.shopify.token'),
                config('api.shopify.version'));
        });

        $this->app->bind('BigcommerceApi', function() {
            return new \Api\Bigcommerce\BigcommerceApi(
                config('api.bigcommerce.user'),
                config('api.bigcommerce.api_key'));
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
