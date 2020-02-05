<?php

namespace Api\Shopify;

use Api\VoyagerAPI;
use OhMyBrew\BasicShopifyAPI;
use Api\Interfaces\ApiConnector;

class ShopifyConnector implements ApiConnector
{
    private $api;

    public function __construct($store, $token, $version)
    {
        $this->api = new BasicShopifyAPI();
        $this->api->setVersion($version);
        $this->api->setShop($store);
        $this->api->setAccessToken($token);
    }

    public function get(): void
    {
        echo "Shopify__get\n\n";
        $rs = $this->api->rest('GET', '/admin/products.json');
    }

    public function post(array $data): void
    {
        echo "Shopify__post\n\n";
        $rs = $this->api->rest('POST', '/admin/products.json', $data);
    }
}

class ShopifyApi extends VoyagerApi
{
    private $store, $token, $version;

    public function __construct(string $store, string $token, string $version)
    {
        $this->store = $store;
        $this->token = $token;
        $this->version = $version;
    }

    public function api(): ApiConnector
    {
        return new ShopifyConnector($this->store, $this->token, $this->version);
    }
}
