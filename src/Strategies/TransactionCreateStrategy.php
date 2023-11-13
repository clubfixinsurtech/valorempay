<?php

namespace ValoremPay\Strategies;

use ValoremPay\Contracts\TransactionInterface;
use ValoremPay\Entities\AdditionalData;
use ValoremPay\Enums\InstallmentType;
use ValoremPay\Helpers\{PropertyValidator, RequiredFields};
use ValoremPay\Traits\{ConditionableTrait, HasPayload};

class TransactionCreateStrategy implements TransactionInterface
{
    use HasPayload, ConditionableTrait;

    protected array $required = [
        'installments',
        'installmentType',
        'amount',
    ];

    private ?string $customer_id = null;
    private ?string $merchant_usn = null;
    private ?string $order_id = null;
    private ?string $soft_descriptor = null;
    private ?array $additional_data = null;

    public function __construct(
        private int             $installments,
        private InstallmentType $installment_type,
        private int             $amount,
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

    public function getInstallments(): int
    {
        return $this->installments;
    }

    public function setInstallments(int $installments): self
    {
        $this->installments = $installments;
        $this->validate();
        return $this;
    }

    public function getInstallmentType(): InstallmentType
    {
        return $this->installment_type;
    }

    public function setInstallmentType(InstallmentType $installment_type): self
    {
        $this->installment_type = $installment_type;
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

    public function getCustomerId(): ?string
    {
        return $this->customer_id;
    }

    public function setCustomerId(string $customer_id): self
    {
        $this->customer_id = $customer_id;
        $this->validate();
        return $this;
    }

    public function getMerchantUsn(): ?string
    {
        return $this->merchant_usn;
    }

    public function setMerchantUsn(string $merchant_usn): self
    {
        $this->merchant_usn = $merchant_usn;
        $this->validate();
        return $this;
    }

    public function getOrderId(): ?string
    {
        return $this->order_id;
    }

    public function setOrderId(string $order_id): self
    {
        $this->order_id = $order_id;
        $this->validate();
        return $this;
    }

    public function getSoftDescriptor(): ?string
    {
        return $this->soft_descriptor;
    }

    public function setSoftDescriptor(string $soft_descriptor): self
    {
        $this->soft_descriptor = $soft_descriptor;
        $this->validate();
        return $this;
    }

    public function getAdditionalData(): ?array
    {
        return $this->additional_data;
    }

    public function setAdditionalData(AdditionalData $additional_data): self
    {
        $this->additional_data = $additional_data->payload();
        $this->validate();
        return $this;
    }
}