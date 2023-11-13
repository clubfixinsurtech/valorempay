<?php

namespace ValoremPay\Entities;

use ValoremPay\Contracts\HasPayloadInterface;
use ValoremPay\Traits\{ConditionableTrait, HasPayload};
use ValoremPay\Helpers\{PropertyValidator, RequiredFields};

class MerchantDefinedInformation implements HasPayloadInterface
{
    use HasPayload, ConditionableTrait;

    protected array $required = [];
    private static int $instanceCount = 0;

    public function __construct(
        private readonly string $key,
        private readonly string $value,
    )
    {
        self::$instanceCount++;

//        $this->{'key' . self::$instanceCount} = $this->key;
//        $this->{'value' . self::$instanceCount} = $this->value;

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
}