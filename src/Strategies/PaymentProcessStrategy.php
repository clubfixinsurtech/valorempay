<?php

namespace ValoremPay\Strategies;

use ValoremPay\Contracts\PaymentInterface;
use ValoremPay\Helpers\{PropertyValidator, RequiredFields};
use ValoremPay\Traits\{ConditionableTrait, HasPayload};
use ValoremPay\Entities\{Card, DecisionManagerData, SplitPaymentData};

class PaymentProcessStrategy implements PaymentInterface
{
    use HasPayload, ConditionableTrait;

    protected array $required = [];

    private ?array $card = null;
    private ?array $split_payment_data = null;
    private ?string $dynamic_data = null;
    private ?array $decision_manager_data = null;

    public function __construct()
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

    public function getCard(): ?array
    {
        return $this->card;
    }

    public function setCard(Card $card): self
    {
        $this->card = $card->payload();
        $this->validate();
        return $this;
    }

    public function getSplitPaymentData(): ?array
    {
        return $this->split_payment_data;
    }

    public function setSplitPaymentData(SplitPaymentData $split_payment_data): self
    {
        $this->split_payment_data[] = $split_payment_data->payload();
        $this->validate();
        return $this;
    }

    public function getDynamicData(): ?string
    {
        return $this->dynamic_data;
    }

    public function setDynamicData(string $dynamic_data): self
    {
        $this->dynamic_data = $dynamic_data;
        $this->validate();
        return $this;
    }

    public function getDecisionManagerData(): ?array
    {
        return $this->decision_manager_data;
    }

    public function setDecisionManagerData(DecisionManagerData $decision_manager_data): self
    {
        $this->decision_manager_data = $decision_manager_data->payload();
        $this->validate();
        return $this;
    }
}