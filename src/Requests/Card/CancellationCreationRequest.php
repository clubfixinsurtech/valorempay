<?php

namespace ValoremPay\Requests\Card;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CancellationCreationRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $nit,
    )
    {
        //
    }

    public function resolveEndpoint(): string
    {
        return '/gse-tef-v2/cancellations';
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
            'original_nit' => $this->nit,
        ];
    }
}