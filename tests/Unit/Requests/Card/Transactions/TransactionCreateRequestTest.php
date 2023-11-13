<?php

namespace Tests\Unit\Requests\Card\Transactions;

use Saloon\Http\Request;
use Tests\Unit\RequestTestCase;

class TransactionCreateRequestTest extends RequestTestCase
{
    protected function requestClass(): Request
    {
        return new \ValoremPay\Requests\Card\Transactions\TransactionCreateRequest(
            new \ValoremPay\Strategies\TransactionCreateStrategy(
                installments: 1,
                installment_type: \ValoremPay\Enums\InstallmentType::STORE_WITHOUT_INTEREST,
                amount: 1000,
            ),
        );
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
        ];
    }
}