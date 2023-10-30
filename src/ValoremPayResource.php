<?php

namespace ValoremPay;

use Saloon\Http\{BaseResource, Response};
use ValoremPay\Entities\Card;
use ValoremPay\Requests\Card\{
    Cancellations\ProcessCancellationRequest,
    Cancellations\CreateCancellationRequest,
    Payments\ProcessPaymentLaterRequest,
    Payments\ProcessPaymentRequest,
    StoreSync\SyncCreditCardStorageRequest,
    StoreSync\CreditCardStorageRequest,
    Transactions\CreateTransactionRequest,
    Transactions\GetTransactionRequest
};
use ValoremPay\Entities\Nit;

class ValoremPayResource extends BaseResource
{
    public function createTransaction(array $options): Response
    {
        return $this->connector->send(new CreateTransactionRequest($options));
    }

    public function getTransaction(Nit $nit): Response
    {
        return $this->connector->send(new GetTransactionRequest($nit));
    }

    public function processPayment(Nit $nit, array $options): Response
    {
        return $this->connector->send(new ProcessPaymentRequest(nit: $nit, options: $options));
    }

    public function processPaymentLater(Nit $nit, bool $confirm = true): Response
    {
        return $this->connector->send(new ProcessPaymentLaterRequest(nit: $nit, confirm: $confirm));
    }

    public function createCancellation(Nit $nit): Response
    {
        return $this->connector->send(new CreateCancellationRequest(nit: $nit));
    }

    public function processCancellation(Nit $nit): Response
    {
        return $this->connector->send(new ProcessCancellationRequest(nit: $nit));
    }

    public function creditCardStorage(string $merchantUsn, string $customerId): Response
    {
        return $this->connector->send(new CreditCardStorageRequest(merchantUsn: $merchantUsn, customerId: $customerId));
    }

    public function syncCreditCardStorage(string $nita, string $storeToken, Card $card): Response
    {
        return $this->connector->send(new SyncCreditCardStorageRequest(nita: $nita, storeToken: $storeToken, card: $card));
    }
}