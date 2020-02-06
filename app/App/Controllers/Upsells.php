<?php

namespace App\Controllers;

use Api;
use Illuminate\Http\Request;

class Upsells extends Controller
{
    public function test(Request $request)
    {
        $platform = app('platform')->platform();

        $api = ($platform === Api\VoyagerAPI::SHOPIFY_PLATFORM) ?
            app('ShopifyApi') :
            app('BigcommerceApi');
        $api->post([]);
        $api->get();
    }
}
