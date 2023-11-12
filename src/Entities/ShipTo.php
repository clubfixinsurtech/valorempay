<?php

namespace ValoremPay\Entities;

use ValoremPay\Contracts\HasPayloadInterface;
use ValoremPay\Traits\{ConditionableTrait, HasPayload};
use ValoremPay\Helpers\{PropertyValidator, RequiredFields};

class ShipTo implements HasPayloadInterface
{
    use HasPayload, ConditionableTrait;

    protected array $required = [];

    public function __construct(
        private ?string $address1 = null,
        private ?string $address2 = null,
        private ?string $administrativeArea = null,
        private ?string $country = null,
        private ?string $destinationTypes = null,
        private ?string $locality = null,
        private ?string $firstName = null,
        private ?string $lastName = null,
        private ?string $phoneNumber = null,
        private ?string $postalCode = null,
        private ?string $destinationCode = null,
        private ?string $method = null,
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

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(string $address1): self
    {
        $this->address1 = $address1;
        $this->validate();
        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(string $address2): self
    {
        $this->address2 = $address2;
        $this->validate();
        return $this;
    }

    public function getAdministrativeArea(): ?string
    {
        return $this->administrativeArea;
    }

    public function setAdministrativeArea(string $administrativeArea): self
    {
        $this->administrativeArea = $administrativeArea;
        $this->validate();
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;
        $this->validate();
        return $this;
    }

    public function getDestinationTypes(): ?string
    {
        return $this->destinationTypes;
    }

    public function setDestinationTypes(string $destinationTypes): self
    {
        $this->destinationTypes = $destinationTypes;
        $this->validate();
        return $this;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
    }

    public function setLocality(string $locality): self
    {
        $this->locality = $locality;
        $this->validate();
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        $this->validate();
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        $this->validate();
        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;
        $this->validate();
        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;
        $this->validate();
        return $this;
    }

    public function getDestinationCode(): ?string
    {
        return $this->destinationCode;
    }

    public function setDestinationCode(string $destinationCode): self
    {
        $this->destinationCode = $destinationCode;
        $this->validate();
        return $this;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;
        $this->validate();
        return $this;
    }
}