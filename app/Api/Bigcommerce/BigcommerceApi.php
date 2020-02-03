<?php

namespace Api\Bigcommerce;

use Api\Interfaces\ApiConnector;
use Bigcommerce\Api\Client as Bigcommerce;
use Api\VoyagerApi;

class bigCommerceConnector implements ApiConnector
{
    public function __construct($user, $key)
    {
        Bigcommerce::configure(array(
            'store_url' => 'https://devstore228.mybigcommerce.com',
            'username' => $user,
            'api_key' => $key
        ));

        $ping = Bigcommerce::getTime();
        if ($ping) echo $ping->format('H:i:s');
    }

    public function get(): void
    {
        $count = Bigcommerce::getProductsCount();

        echo $count;

        echo "{$count}\n\n";

        echo "BigCommerce__get\n\n";
    }

    public function post(array $data): void
    {
        $count = Bigcommerce::getProductsCount();

        echo $count;

        echo "BigCommerce__post\n\n";
    }
}

class BigcommerceApi extends VoyagerApi
{
    private $name, $token;

    public function __construct(string $name, string $token)
    {
        $this->name = $name;
        $this->token = $token;
    }

    public function api(): ApiConnector
    {
        return new bigCommerceConnector($this->name, $this->token);
    }
}
