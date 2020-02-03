<?php

namespace Api\Interfaces;

interface ApiConnector
{
    public function get(): void;
    public function post(array $data): void;
}
