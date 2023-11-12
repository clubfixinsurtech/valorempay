<?php

namespace ValoremPay\Entities;

use ValoremPay\Contracts\HasPayloadInterface;
use ValoremPay\Traits\{ConditionableTrait, HasPayload};
use ValoremPay\Helpers\{PropertyValidator, RequiredFields};

class DecisionManagerData implements HasPayloadInterface
{
    use HasPayload, ConditionableTrait;

    protected array $required = [];

    private ?array $merchantDefinedInformation = null;

    public function __construct(
        private ClientReferenceInformation $clientReferenceInformation,
        private BuyerInformation           $buyerInformation,
        private OrderInformation           $orderInformation,
        private DeviceInformation          $deviceInformation,
    )
    {
        $this->validate();
    }

    public function validate(): void
    {
        RequiredFields::check($this->required, $this);
        PropertyValidator::validate($this);
    }

    public function getRequired(): array
    {
        return $this->required;
    }

    public function setRequired(array $required): self
    {
        $this->required = $required;
        return $this;
    }

    public function getClientReferenceInformation(): ClientReferenceInformation
    {
        return $this->clientReferenceInformation;
    }

    public function setClientReferenceInformation(ClientReferenceInformation $clientReferenceInformation): self
    {
        $this->clientReferenceInformation = $clientReferenceInformation;
        $this->validate();
        return $this;
    }

    public function getBuyerInformation(): BuyerInformation
    {
        return $this->buyerInformation;
    }

    public function setBuyerInformation(BuyerInformation $buyerInformation): self
    {
        $this->buyerInformation = $buyerInformation;
        $this->validate();
        return $this;
    }

    public function getOrderInformation(): OrderInformation
    {
        return $this->orderInformation;
    }

    public function setOrderInformation(OrderInformation $orderInformation): self
    {
        $this->orderInformation = $orderInformation;
        $this->validate();
        return $this;
    }

    public function getDeviceInformation(): DeviceInformation
    {
        return $this->deviceInformation;
    }

    public function setDeviceInformation(DeviceInformation $deviceInformation): self
    {
        $this->deviceInformation = $deviceInformation;
        $this->validate();
        return $this;
    }

    public function getMerchantDefinedInformation(): ?array
    {
        return $this->merchantDefinedInformation;
    }

    public function setMerchantDefinedInformation(MerchantDefinedInformation $merchantDefinedInformation): self
    {
        $this->merchantDefinedInformation[] = $merchantDefinedInformation->payload();
        $this->validate();
        return $this;
    }
}