<?php

namespace ValoremPay\Entities;

use ValoremPay\Contracts\HasPayloadInterface;
use ValoremPay\Traits\{ConditionableTrait, HasPayload};
use ValoremPay\Helpers\{PropertyValidator, RequiredFields};

class BuyerInformation implements HasPayloadInterface
{
    use HasPayload, ConditionableTrait;

    protected array $required = [
        'merchantCustomerId',
    ];

    public function __construct(
        private string $merchantCustomerId,
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

    public function getMerchantCustomerId(): string
    {
        return $this->merchantCustomerId;
    }

    public function setMerchantCustomerId(string $merchantCustomerId): self
    {
        $this->merchantCustomerId = $merchantCustomerId;
        $this->validate();
        return $this;
    }
}