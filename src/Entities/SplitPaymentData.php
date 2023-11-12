<?php

namespace ValoremPay\Entities;

use ValoremPay\Contracts\HasPayloadInterface;
use ValoremPay\Traits\{ConditionableTrait, HasPayload};
use ValoremPay\Helpers\{PropertyValidator, RequiredFields};

class SplitPaymentData implements HasPayloadInterface
{
    use HasPayload, ConditionableTrait;

    protected array $required = [
        'customer_id',
        'amount',
    ];

    public function __construct(
        private string $customer_id,
        private int    $amount,
        private ?int   $fee_division = null,
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

    public function getCustomerId(): string
    {
        return $this->customer_id;
    }

    public function setCustomerId(string $customer_id): self
    {
        $this->customer_id = $customer_id;
        $this->validate();
        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;
        $this->validate();
        return $this;
    }

    public function getFeeDivision(): ?int
    {
        return $this->fee_division;
    }

    public function setFeeDivision(int $fee_division): self
    {
        $this->fee_division = $fee_division;
        $this->validate();
        return $this;
    }
}