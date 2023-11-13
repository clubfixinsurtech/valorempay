<?php

namespace ValoremPay\Entities;

class CreateTransaction
{
    public function __construct(
        private readonly array $options
    )
    {
        $this->validate($options);
    }

    public function toArray(): array
    {
        return $this->options;
    }

    private function validate(array $options): void
    {
        $this->validateInstallments($options);
        $this->validateInstallmentType($options);
        $this->validateAmount($options);
        $this->validateStatusNotificationUrl($options);
        $this->validateUseDecisionManager($options);
    }

    private function validateInstallments(array $options): void
    {
        if (!isset($options['installments'])) {
            throw new \InvalidArgumentException('Installments is required');
        }

        if (!is_int($options['installments'])) {
            throw new \InvalidArgumentException('Installments must be an integer');
        }

        if ($options['installments'] < 1) {
            throw new \InvalidArgumentException('Installments must be greater than 0');
        }
    }

    private function validateInstallmentType(array $options): void
    {
        if (!isset($options['installment_type'])) {
            throw new \InvalidArgumentException('Installments type is required');
        }

        if (!is_int($options['installment_type'])) {
            throw new \InvalidArgumentException('Installments type must be an integer');
        }

        $allowedTypes = [3, 4, 6, 7];
        if (!in_array($options['installment_type'], $allowedTypes)) {
            throw new \InvalidArgumentException('Installments type must be one of the following: ' . implode(', ', $allowedTypes));
        }
    }

    private function validateAmount(array $options): void
    {
        if (!isset($options['amount'])) {
            throw new \InvalidArgumentException('Amount is required');
        }

        if (!is_int($options['amount'])) {
            throw new \InvalidArgumentException('Amount must be an integer');
        }

        if ($options['amount'] < 1) {
            throw new \InvalidArgumentException('Amount must be greater than 0');
        }
    }

    private function validateStatusNotificationUrl(array $options): void
    {
        if (!isset($options['additional_data']['status_notification_url'])) {
            throw new \InvalidArgumentException('Status notification url is required');
        }

        if (!is_string($options['additional_data']['status_notification_url'])) {
            throw new \InvalidArgumentException('Status notification url must be a string');
        }

        if (empty($options['additional_data']['status_notification_url'])) {
            throw new \InvalidArgumentException('Status notification url must not be empty');
        }

        if (!filter_var($options['additional_data']['status_notification_url'], FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Status notification url must be a valid url');
        }
    }

    private function validateUseDecisionManager(array $options): void
    {
        if (!isset($options['additional_data']['use_decision_manager'])) {
            throw new \InvalidArgumentException('Use decision manager is required');
        }

        if (!is_bool($options['additional_data']['use_decision_manager'])) {
            throw new \InvalidArgumentException('Use decision manager must be a boolean');
        }
    }
}