<?php

namespace Tests\Unit\Requests\Card\Cancellations;

use Saloon\Http\Request;
use Tests\Unit\RequestTestCase;

class CreateCancellationRequestTest extends RequestTestCase
{
    protected function requestClass(): Request
    {
        return new \ValoremPay\Requests\Card\Cancellations\CreateCancellationRequest('');
    }

    protected function expectedRequestMethod(): string
    {
        return 'POST';
    }

    protected function expectedEndpoint(): string
    {
        return '/gse-tef-v2/cancellations';
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
            'original_nit',
        ];
    }
}