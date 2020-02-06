<?php

namespace App\Domain\Billing\Actions;

use App\Domain\Billing\Models\Billing;

class CreateBillingAction
{
    private $api;

    public function __construct()
    {
        $this->api = app('ShopifyApi');
    }

    public function execute(Billing $billing)
    {
        echo 'Create billing action executed';
    }
}
