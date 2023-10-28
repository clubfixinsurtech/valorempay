<?php

namespace ValoremPay\Requests\Card\Payments;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ProcessPaymentLaterRequest extends Request
{
    protected Method $method = Method::PUT;

    public function __construct(
        protected string $nit,
        protected bool   $confirm = true,
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

    protected function defaultQuery(): array
    {
        return [
            'confirm' => $this->confirm,
        ];
    }
}