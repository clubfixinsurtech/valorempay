<?php

namespace Tests\Unit\Requests\Card\Payments;

use Saloon\Http\Request;
use Tests\Unit\RequestTestCase;

class ProcessPaymentLaterRequestTest extends RequestTestCase
{
    protected function requestClass(): Request
    {
        return new \ValoremPay\Requests\Card\Payments\ProcessPaymentLaterRequest(
            nit: new \ValoremPay\Entities\Nit('8a910e3e524986e0f121231bb0dcfc420996be66481819b075a568f87f7550b1'),
            confirm: false,
        );
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