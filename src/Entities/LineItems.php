<?php

namespace ValoremPay\Entities;

use ValoremPay\Contracts\HasPayloadInterface;
use ValoremPay\Traits\{ConditionableTrait, HasPayload};
use ValoremPay\Helpers\{PropertyValidator, RequiredFields};

class LineItems implements HasPayloadInterface
{
    use HasPayload, ConditionableTrait;

    protected array $required = [];

    public function __construct(
        private ?int    $unitPrice = null,
        private ?int    $quantity = null,
        private ?string $productSKU = null,
        private ?string $productName = null,
        private ?string $productCode = null,
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

    public function getUnitPrice(): ?int
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(int $unitPrice): self
    {
        $this->unitPrice = $unitPrice;
        $this->validate();
        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        $this->validate();
        return $this;
    }

    public function getProductSKU(): ?string
    {
        return $this->productSKU;
    }

    public function setProductSKU(string $productSKU): self
    {
        $this->productSKU = $productSKU;
        $this->validate();
        return $this;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(?string $productName): self
    {
        $this->productName = $productName;
        $this->validate();
        return $this;
    }

    public function getProductCode(): ?string
    {
        return $this->productCode;
    }

    public function setProductCode(string $productCode): self
    {
        $this->productCode = $productCode;
        $this->validate();
        return $this;
    }
}