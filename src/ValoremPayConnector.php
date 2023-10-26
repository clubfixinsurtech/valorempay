<?php

namespace ValoremPay;

use Saloon\Http\Connector;

class ValoremPayConnector extends Connector
{

    public function __construct(
        private string  $apiKey,
        private bool $production = true
    )
    {
    }

    public function resolveBaseUrl(): string
    {
        if ($this->production) {
            return 'https://api.asaas.com/v3';
        }

        return 'https://sandbox.asaas.com/api/v3';
    }

    protected function defaultHeaders(): array
    {
        return [

        ];
    }
}
