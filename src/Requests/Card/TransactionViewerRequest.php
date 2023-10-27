<?php

namespace ValoremPay\Requests\Card;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class TransactionViewerRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $nit,
    )
    {
        //
    }

    public function resolveEndpoint(): string
    {
        return '/gse-tef-v2/transactions/' . $this->nit;
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }
}