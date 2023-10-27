<?php

namespace ValoremPay;

use Saloon\Http\{BaseResource, Response};
use ValoremPay\Entities\Card;
use ValoremPay\Requests\Card\{CancellationConfirmationRequest,
    CancellationCreationRequest,
    PaymentConfirmationRequest,
    PaymentCreationRequest,
    StoreSyncPUTRequest,
    StoreSyncRequest,
    TransactionCreationRequest,
    TransactionViewerRequest};

class ValoremPayResource extends BaseResource
{
    public function createTransaction(): Response
    {
        return $this->connector->send(new TransactionCreationRequest());
    }

    public function getTransaction(string $nit): Response
    {
        return $this->connector->send(new TransactionViewerRequest($nit));
    }

    public function createPayment(string $nit, Card $card): Response
    {
        return $this->connector->send(new PaymentCreationRequest(nit: $nit, card: $card));
    }

    public function confirmPayment(string $nit, bool $confirm = true): Response
    {
        return $this->connector->send(new PaymentConfirmationRequest(nit: $nit, confirm: $confirm));
    }

    public function createCancellation(string $nit): Response
    {
        return $this->connector->send(new CancellationCreationRequest(nit: $nit));
    }

    public function confirmCancellation(string $nit): Response
    {
        return $this->connector->send(new CancellationConfirmationRequest(nit: $nit));
    }

    public function storeSync(string $merchantUsn, string $customerId): Response
    {
        return $this->connector->send(new StoreSyncRequest(merchantUsn: $merchantUsn, customerId: $customerId));
    }

    public function storeSyncPut(string $nita, string $storeToken): Response
    {
        return $this->connector->send(new StoreSyncPUTRequest(nita: $nita, storeToken: $storeToken));
    }
}