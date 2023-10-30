<?php

namespace Tests\Unit\Requests\Card\Payments;

use Saloon\Http\Request;
use Tests\Unit\RequestTestCase;

class ProcessPaymentRequestTest extends RequestTestCase
{
    protected function requestClass(): Request
    {
        return new \ValoremPay\Requests\Card\Payments\ProcessPaymentRequest(
            '',
            [
                'card' => [],
            ],
        );
    }

    protected function expectedRequestMethod(): string
    {
        return 'POST';
    }

    protected function expectedEndpoint(): string
    {
        return '/gse-tef-v2/payments/';
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
            'card',
        ];
    }
}