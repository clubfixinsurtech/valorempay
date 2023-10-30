<?php

namespace Tests\Unit\Requests\Card\Transactions;

use Saloon\Http\Request;
use Tests\Unit\RequestTestCase;

class GetTransactionRequestTest extends RequestTestCase
{
    protected function requestClass(): Request
    {
        return new \ValoremPay\Requests\Card\Transactions\GetTransactionRequest('');
    }

    protected function expectedRequestMethod(): string
    {
        return 'GET';
    }

    protected function expectedEndpoint(): string
    {
        return '/gse-tef-v2/transactions/';
    }

    protected function expectedDefaultHeaders(): array
    {
        return [
            'Accept',
            'Content-Type',
        ];
    }
}