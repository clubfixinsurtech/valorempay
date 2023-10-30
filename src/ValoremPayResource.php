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

class ValoremPayResource extends BaseResource
{
    public function createTransaction(array $options): Response
    {
        return $this->connector->send(new CreateTransactionRequest($options));
    }

    public function getTransaction(string $nit): Response
    {
        return $this->connector->send(new GetTransactionRequest($nit));
    }

    public function processPayment(string $nit, array $options): Response
    {
        return $this->connector->send(new ProcessPaymentRequest(nit: $nit, options: $options));
    }

    public function processPaymentLater(string $nit, bool $confirm = true): Response
    {
        return $this->connector->send(new ProcessPaymentLaterRequest(nit: $nit, confirm: $confirm));
    }

    public function createCancellation(string $nit): Response
    {
        return $this->connector->send(new CreateCancellationRequest(nit: $nit));
    }

    public function processCancellation(string $nit): Response
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