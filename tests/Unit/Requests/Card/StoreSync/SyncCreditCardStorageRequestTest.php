<?php

namespace Tests\Unit\Requests\Card\StoreSync;

use Saloon\Http\Request;
use Tests\Unit\RequestTestCase;

class SyncCreditCardStorageRequestTest extends RequestTestCase
{
    protected function requestClass(): Request
    {
        return new \ValoremPay\Requests\Card\StoreSync\SyncCreditCardStorageRequest(
            '',
            '',
            new \ValoremPay\Entities\Card('9999999999999999', '1324', '123')
        );
    }

    protected function expectedRequestMethod(): string
    {
        return 'PUT';
    }

    protected function expectedEndpoint(): string
    {
        return '/gse-tef-v2/store-sync/';
    }

    protected function expectedDefaultHeaders(): array
    {
        return [
            'Accept',
            'Content-Type',
            'store_token',
        ];
    }

    protected function expectedDefaultBody(): array
    {
        return [
            'card',
        ];
    }
}