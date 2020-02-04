<?php

namespace App\Controllers;

use App\Domain\Billing\Models\Billing;
use App\Domain\Billing\States\Active;
use App\Domain\Billing\States\Pending;
use Illuminate\Http\Request;
use Api;

class Upsells extends Controller
{
    public function test(Request $request)
    {
        $platform = app('platform')->platform();

        $api = ($platform === Api\VoyagerAPI::SHOPIFY_PLATFORM) ?
            new Api\Shopify\ShopifyApi(
                config('api.shopify.store'),
                config('api.shopify.token'),
                config('api.shopify.version')) :
            new Api\Bigcommerce\BigcommerceApi(
                config('api.bigcommerce.user'),
                config('api.bigcommerce.api_key')
            );
        $api->post([]);
        $api->get();
    }
}
