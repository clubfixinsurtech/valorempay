<?php

namespace ValoremPay\Entities;

use ValoremPay\Contracts\HasPayloadInterface;
use ValoremPay\Traits\{ConditionableTrait, HasPayload};
use ValoremPay\Helpers\{PropertyValidator, RequiredFields};

class DeviceInformation implements HasPayloadInterface
{
    use HasPayload, ConditionableTrait;

    protected array $required = [];

    public function __construct(
        private ?string $fingerprintSessionId = null,
        private ?string $ipAddress = null,
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

    public function getFingerprintSessionId(): ?string
    {
        return $this->fingerprintSessionId;
    }

    public function setFingerprintSessionId(string $fingerprintSessionId): self
    {
        $this->fingerprintSessionId = $fingerprintSessionId;
        $this->validate();
        return $this;
    }

    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }

    public function setIpAddress(string $ipAddress): self
    {
        $this->ipAddress = $ipAddress;
        $this->validate();
        return $this;
    }
}