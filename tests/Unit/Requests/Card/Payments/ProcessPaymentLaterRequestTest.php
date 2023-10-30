<?php

namespace Tests\Unit\Requests\Card\Payments;

use Saloon\Http\Request;
use Tests\Unit\RequestTestCase;

class ProcessPaymentLaterRequestTest extends RequestTestCase
{
    protected function requestClass(): Request
    {
        return new \ValoremPay\Requests\Card\Payments\ProcessPaymentLaterRequest('', '');
    }

    protected function expectedRequestMethod(): string
    {
        return 'PUT';
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

    protected function expectedDefaultQuery(): array
    {
        return [
            'confirm',
        ];
    }
}