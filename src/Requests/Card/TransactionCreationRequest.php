<?php

namespace ValoremPay\Requests\Card;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class TransactionCreationRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

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
        return [
            'installments' => 1,
            'installment_type' => 4,
            'amount' => 1000,
            'soft_descriptor' => 'Lorem ipsum dolor.',
            'additional_data' => [
                'status_notification_url' => 'https://example.com', // TODO: Change this URL
                'use_decision_manager' => false,
                'postpone_confirmation' => true,
            ],
        ];
    }
}