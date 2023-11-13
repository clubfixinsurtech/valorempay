<?php

namespace ValoremPay;

use Saloon\Http\{BaseResource, Response};
use ValoremPay\Contracts\{PaymentInterface, TransactionInterface};
use ValoremPay\Entities\{Card, Nit};
use ValoremPay\Requests\Card\{
    Cancellations\CancellationCreateRequest,
    Cancellations\CancellationProcessRequest,
    Payments\PaymentProcessLaterRequest,
    Payments\PaymentProcessRequest,
    StoreSync\CardStorageRequest,
    StoreSync\CardSyncRequest,
    Transactions\TransactionCreateRequest,
    Transactions\TransactionDetailRequest
};

class ValoremPayResource extends BaseResource
{
    public function transactionCreate(TransactionInterface $transaction): Response
    {
        return $this->connector->send(new TransactionCreateRequest($transaction));
    }

    public function transactionDetail(Nit $nit): Response
    {
        return $this->connector->send(new TransactionDetailRequest($nit));
    }

    public function paymentProcess(Nit $nit, PaymentInterface $payment): Response
    {
        return $this->connector->send(new PaymentProcessRequest($nit, $payment));
    }

    public function paymentProcessLater(Nit $nit, bool $confirm = true): Response
    {
        return $this->connector->send(new PaymentProcessLaterRequest($nit, $confirm));
    }

    public function cancellationCreate(Nit $nit): Response
    {
        return $this->connector->send(new CancellationCreateRequest($nit));
    }

    public function cancellationProcess(Nit $nit): Response
    {
        return $this->connector->send(new CancellationProcessRequest($nit));
    }

    public function cardStorage(string $merchantUsn, string $customerId): Response
    {
        return $this->connector->send(new CardStorageRequest($merchantUsn, $customerId));
    }

    public function cardSync(string $nita, string $storeToken, Card $card,): Response
    {
        return $this->connector->send(new CardSyncRequest($nita, $storeToken, $card));
    }
}