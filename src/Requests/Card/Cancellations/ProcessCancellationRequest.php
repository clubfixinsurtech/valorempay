<?php

namespace ValoremPay\Requests\Card\Cancellations;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ProcessCancellationRequest extends Request
{
    protected Method $method = Method::PUT;

    public function __construct(
        protected string $nit,
    )
    {
        //
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/gse-tef-v2/cancellations/' . $this->nit;
    }
}