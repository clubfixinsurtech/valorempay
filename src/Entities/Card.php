<?php

namespace ValoremPay\Entities;

final class Card
{
    public function __construct(
        private readonly ?string $number = null,
        private readonly ?string $expiryDate = null,
        private readonly ?string $securityCode = null,
        private readonly ?string $token = null,
    )
    {
        $this->validateCard();
    }

    public function toArray(): array
    {
        if ($this->token) {
            return [
                'security_code' => $this->securityCode,
                'token' => $this->token,
            ];
        }

        return [
            'number' => $this->number,
            'expiry_date' => $this->expiryDate,
            'security_code' => $this->securityCode,
        ];
    }

    private function validateCard(): void
    {
        if (!$this->securityCode) {
            throw new \InvalidArgumentException('The security code is required');
        }

        if (!$this->token) {
            if (!$this->number) {
                throw new \InvalidArgumentException('The card number is required');
            }

            if (!$this->expiryDate) {
                throw new \InvalidArgumentException('The expiry date is required');
            }
        }

        $this->validateNumber();
        $this->validateExpiryDate();
        $this->validateSecurityCode();
    }

    private function validateNumber(): void
    {
        if ($this->number) {
            if (strlen($this->number) !== 16) {
                throw new \InvalidArgumentException('The card number must be 16 digits long');
            }

            if (!is_numeric($this->number)) {
                throw new \InvalidArgumentException('The card number must be numeric');
            }
        }
    }

    private function validateExpiryDate(): void
    {
        if ($this->expiryDate) {
            if (strlen($this->expiryDate) !== 4) {
                throw new \InvalidArgumentException('The expiry date must be 4 digits long');
            }

            if (!is_numeric($this->expiryDate)) {
                throw new \InvalidArgumentException('The expiry date must be numeric');
            }
        }
    }

    private function validateSecurityCode(): void
    {
        if (strlen($this->securityCode) !== 3) {
            throw new \InvalidArgumentException('The security code must be 3 digits long');
        }

        if (!is_numeric($this->securityCode)) {
            throw new \InvalidArgumentException('The security code must be numeric');
        }
    }
}