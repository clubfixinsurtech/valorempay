<?php

namespace ValoremPay\Entities;

class ProcessPayment
{
    public function __construct(
        private readonly array $options
    )
    {
        $this->validate($this->options);
    }

    public function toArray(): array
    {
        return $this->options;
    }

    private function validate(array $options): void
    {
        //
    }
}