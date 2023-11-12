<?php

namespace ValoremPay\Requests\Card\Transactions;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use ValoremPay\Entities\Nit;

class TransactionDetailRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected Nit $nit,
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