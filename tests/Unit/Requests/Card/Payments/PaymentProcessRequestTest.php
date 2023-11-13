<?php

namespace Tests\Unit\Requests\Card\Payments;

use Saloon\Http\Request;
use Tests\Unit\RequestTestCase;

class PaymentProcessRequestTest extends RequestTestCase
{
    protected function requestClass(): Request
    {
        return new \ValoremPay\Requests\Card\Payments\PaymentProcessRequest(
            nit: new \ValoremPay\Entities\Nit('8a910e3e524986e0f121231bb0dcfc420996be66481819b075a568f87f7550b1'),
            payment: (new \ValoremPay\Strategies\PaymentProcessStrategy())->setCard(
                new \ValoremPay\Entities\Card(
                    number: '5448280000000007',
                    expiry_date: '0128',
                    security_code: '123',
                ),
            ),
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