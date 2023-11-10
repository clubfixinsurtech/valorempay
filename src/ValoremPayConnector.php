<?php

namespace ValoremPay;

use Saloon\Http\Connector;
use ValoremPay\Requests\Authorization\BasicAuth;

class ValoremPayConnector extends Connector
{
    public function __construct(
        private readonly string $clientId,
        private readonly string $clientSecret,
        private readonly bool   $isSandbox = true,
    )
    {
        $this->requestAndSetAuthToken();
    }

    public function resolveBaseUrl(): string
    {
        if ($this->isSandbox === true) {
            return 'https://api-hml.gsurfnet.com';
        }

        return 'https://api.gsurfnet.com';
    }

    public function valoremPay(): ValoremPayResource
    {
        return new ValoremPayResource($this);
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    private function requestAndSetAuthToken(): void
    {
        $response = $this->send(new BasicAuth($this->clientId, $this->clientSecret));

        if ($response->failed()) {
            throw new \Exception('Failed to get token');
        }

        $this->withTokenAuth($response->json('access_token'));
    }
}
