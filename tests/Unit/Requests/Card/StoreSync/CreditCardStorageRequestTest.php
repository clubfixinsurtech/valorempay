<?php

namespace Tests\Unit\Requests\Card\StoreSync;

use Saloon\Http\Request;
use Tests\Unit\RequestTestCase;

class CreditCardStorageRequestTest extends RequestTestCase
{
    protected function requestClass(): Request
    {
        return new \ValoremPay\Requests\Card\StoreSync\CreditCardStorageRequest('', '');
    }

    protected function expectedRequestMethod(): string
    {
        return 'POST';
    }

    protected function expectedEndpoint(): string
    {
        return '/gse-tef-v2/store-sync';
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
            'merchant_usn',
            'customer_id',
        ];
    }
}