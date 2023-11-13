<?php

namespace ValoremPay\Entities;

use ValoremPay\Contracts\HasPayloadInterface;
use ValoremPay\Traits\{ConditionableTrait, HasPayload};
use ValoremPay\Helpers\{PropertyValidator, RequiredFields};

class OrderInformation implements HasPayloadInterface
{
    use HasPayload, ConditionableTrait;

    protected array $required = [];

    private ?array $lineItems = null;

    public function __construct(
        private ?BillTo $billTo = null,
        private ?ShipTo $shipTo = null,
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

    public function getBillTo(): ?BillTo
    {
        return $this->billTo;
    }

    public function setBillTo(BillTo $billTo): self
    {
        $this->billTo = $billTo;
        $this->validate();
        return $this;
    }

    public function getShipTo(): ?ShipTo
    {
        return $this->shipTo;
    }

    public function setShipTo(ShipTo $shipTo): self
    {
        $this->shipTo = $shipTo;
        $this->validate();
        return $this;
    }

    public function getLineItems(): ?array
    {
        return $this->lineItems;
    }

    public function setLineItems(LineItems $lineItems): self
    {
        $this->lineItems[] = $lineItems->payload();
        $this->validate();
        return $this;
    }
}