<?php

namespace Tests\Unit\Requests\Card\Transactions;

use Saloon\Http\Request;
use Tests\Unit\RequestTestCase;

class CreateTransactionRequestTest extends RequestTestCase
{
    protected function requestClass(): Request
    {
        return new \ValoremPay\Requests\Card\Transactions\CreateTransactionRequest([
            'installments' => 1,
            'installment_type' => 4,
            'amount' => 1000,
            'soft_descriptor' => 'Lorem ipsum dolor.',
            'additional_data' => [
                'status_notification_url' => 'https://example.com',
                'use_decision_manager' => false,
                'postpone_confirmation' => false,
            ],
        ]);
    }

    protected function expectedRequestMethod(): string
    {
        return 'POST';
    }

    protected function expectedEndpoint(): string
    {
        return '/gse-tef-v2/transactions';
    }

    protected function expectedDefaultHeaders(): array
    {
        return [
            'Accept',
            'Content-Type',
        ];
    }

    protected function expectedDefaultBody(): array
    {
        return [
            'installments',
            'installment_type',
            'amount',
            'soft_descriptor',
            'additional_data',
        ];
    }
}