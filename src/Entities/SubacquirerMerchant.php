<?php

namespace ValoremPay\Entities;

use ValoremPay\Contracts\{HasPayloadInterface, SubacquirerMerchantInterface};
use ValoremPay\Helpers\RequiredFields;
use ValoremPay\Traits\{ConditionableTrait, HasPayload};

class SubacquirerMerchant implements HasPayloadInterface, SubacquirerMerchantInterface
{
    use HasPayload, ConditionableTrait;

    protected array $required = [
        'state',
        'country',
        'zip_code',
    ];

    public function __construct(
        private string  $state,
        private string  $country,
        private string  $zip_code,
        private ?string $city = null,
        private ?string $address = null,
    )
    {
        $this->validate();
    }

    public function validate(): void
    {
        RequiredFields::check($this->required, $this);
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

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function getZipCode(): string
    {
        return $this->zip_code;
    }

    public function setZipCode(string $zip_code): self
    {
        $this->zip_code = $zip_code;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;
        return $this;
    }
}