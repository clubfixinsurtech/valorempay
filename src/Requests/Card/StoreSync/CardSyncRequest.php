<?php

namespace ValoremPay\Requests\Card\StoreSync;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use ValoremPay\Entities\Card;

class CardSyncRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        protected string $nita,
        protected string $storeToken,
        protected Card   $card,
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
            'card' => $this->card->payload(),
        ];
    }
}