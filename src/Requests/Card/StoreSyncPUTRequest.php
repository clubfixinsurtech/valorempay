<?php

namespace ValoremPay\Requests\Card;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class StoreSyncPUTRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        protected string $nita,
        protected string $storeToken,
    )
    {
        //
    }

    public function resolveEndpoint(): string
    {
        return '/gse-tef-v2/store-sync/' . $this->nita;
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'store_token' => $this->storeToken,
        ];
    }

    protected function defaultBody(): array
    {
        return [
            'card' => [
                'number' => '5448280000000007',
                'expiry_date' => '0128',
            ],
        ];
    }
}