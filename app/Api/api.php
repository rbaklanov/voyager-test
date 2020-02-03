<?php

namespace Api;

use Api\Interfaces\ApiConnector;

abstract class VoyagerApi
{
    const SHOPIFY_PLATFORM = 'SHOPIFY_PLATFORM';
    const BIGCOMMERCE_PLATFORM = 'BIGCOMMERCE_PLATFORM';

    abstract public function api(): ApiConnector;

    public function get(): void
    {
        $api = $this->api();

        $api->get();
    }

    public function post(array $data): void
    {
        $api = $this->api();

        $api->post($data);
    }
}
