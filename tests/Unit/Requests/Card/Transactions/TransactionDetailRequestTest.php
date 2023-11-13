<?php

namespace Tests\Unit\Requests\Card\Transactions;

use Saloon\Http\Request;
use Tests\Unit\RequestTestCase;

class TransactionDetailRequestTest extends RequestTestCase
{
    protected function requestClass(): Request
    {
        return new \ValoremPay\Requests\Card\Transactions\TransactionDetailRequest(
            nit: new \ValoremPay\Entities\Nit('8a910e3e524986e0f121231bb0dcfc420996be66481819b075a568f87f7550b1'),
        );
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