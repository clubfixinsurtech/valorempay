<?php

namespace ValoremPay\Requests\Card;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use ValoremPay\Entities\Card;

class PaymentCreationRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $nit,
        protected Card   $card,
    )
    {
        //
    }

    public function resolveEndpoint(): string
    {
        return '/gse-tef-v2/payments/' . $this->nit;
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    protected function defaultBody(): array
    {
        return [
            'card' => $this->card->toArray(),
        ];
    }
}