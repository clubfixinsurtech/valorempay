<?php

namespace Tests\Unit\Requests\Card\Cancellations;

use Saloon\Http\Request;
use Tests\Unit\RequestTestCase;

class ProcessCancellationRequestTest extends RequestTestCase
{
    protected function requestClass(): Request
    {
        return new \ValoremPay\Requests\Card\Cancellations\ProcessCancellationRequest('');
    }

    protected function expectedRequestMethod(): string
    {
        return 'PUT';
    }

    protected function expectedEndpoint(): string
    {
        return '/gse-tef-v2/cancellations/';
    }

    protected function expectedDefaultHeaders(): array
    {
        return [
            'Accept',
            'Content-Type',
        ];
    }
}