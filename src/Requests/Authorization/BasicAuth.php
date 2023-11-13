<?php

namespace ValoremPay\Requests\Authorization;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class BasicAuth extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $clientId,
        private readonly string $clientSecret,
    )
    {
        //
    }

    public function resolveEndpoint(): string
    {
        return '/gmac-v1/oauth2/token';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
        ];
    }
}