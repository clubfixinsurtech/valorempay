<?php

namespace ValoremPay\Entities;

use ValoremPay\Contracts\HasPayloadInterface;
use ValoremPay\Helpers\{PropertyValidator, RequiredFields};
use ValoremPay\Traits\{ConditionableTrait, HasPayload};

class AdditionalData implements HasPayloadInterface
{
    use HasPayload, ConditionableTrait;

    protected array $required = [];

    private ?array $subacquirer_merchant = null;

    public function __construct(
        private bool    $use_decision_manager = true,
        private bool    $postpone_confirmation = true,
        private ?string $status_notification_url = null,
        private ?string $mcc = null,
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

    public function isUseDecisionManager(): bool
    {
        return $this->use_decision_manager;
    }

    public function setUseDecisionManager(bool $use_decision_manager): self
    {
        $this->use_decision_manager = $use_decision_manager;
        $this->validate();
        return $this;
    }

    public function isPostponeConfirmation(): bool
    {
        return $this->postpone_confirmation;
    }

    public function setPostponeConfirmation(bool $postpone_confirmation): self
    {
        $this->postpone_confirmation = $postpone_confirmation;
        $this->validate();
        return $this;
    }

    public function getStatusNotificationUrl(): ?string
    {
        return $this->status_notification_url;
    }

    public function setStatusNotificationUrl(string $status_notification_url): self
    {
        $this->status_notification_url = $status_notification_url;
        $this->validate();
        return $this;
    }

    public function getMcc(): ?string
    {
        return $this->mcc;
    }

    public function setMcc(string $mcc): self
    {
        $this->mcc = $mcc;
        $this->validate();
        return $this;
    }

    public function getSubacquirerMerchant(): ?array
    {
        return $this->subacquirer_merchant;
    }

    public function setSubacquirerMerchant(SubacquirerMerchant $subacquirer_merchant): self
    {
        $this->subacquirer_merchant = $subacquirer_merchant->payload();
        $this->validate();
        return $this;
    }
}