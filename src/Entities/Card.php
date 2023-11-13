<?php

namespace ValoremPay\Entities;

use ValoremPay\Contracts\HasPayloadInterface;
use ValoremPay\Traits\{ConditionableTrait, HasPayload};
use ValoremPay\Helpers\{PropertyValidator, RequiredFields};

class Card implements HasPayloadInterface
{
    use HasPayload, ConditionableTrait;

    protected array $required = [];

    public function __construct(
        private ?string $number = null,
        private ?string $expiry_date = null,
        private ?string $security_code = null,
        private ?string $token = null,
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

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;
        $this->validate();
        return $this;
    }

    public function getExpiryDate(): ?string
    {
        return $this->expiry_date;
    }

    public function setExpiryDate(string $expiry_date): self
    {
        $this->expiry_date = $expiry_date;
        $this->validate();
        return $this;
    }

    public function getSecurityCode(): ?string
    {
        return $this->security_code;
    }

    public function setSecurityCode(string $security_code): self
    {
        $this->security_code = $security_code;
        $this->validate();
        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;
        $this->validate();
        return $this;
    }
}