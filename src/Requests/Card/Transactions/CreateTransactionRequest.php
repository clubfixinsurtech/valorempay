<?php

namespace ValoremPay\Requests\Card\Transactions;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use ValoremPay\Entities\CreateTransaction;

class CreateTransactionRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected array $options,
    )
    {
        //
    }

    public function resolveEndpoint(): string
    {
        return '/gse-tef-v2/transactions';
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
        return (new CreateTransaction($this->options))->toArray();
    }
}