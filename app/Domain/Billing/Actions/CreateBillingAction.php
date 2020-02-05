<?php

namespace App\Domain\Billing\Actions;

use Api\Shopify\ShopifyApi;
use App\Domain\Billing\Models\Billing;

class CreateBillingAction
{
    private $api;

    //public function __construct(ShopifyApi $api)
    //{
    //    $this->api = $api;
    //}

    public function execute(Billing $billing)
    {
        echo 'create billing action executed';
    }
}
