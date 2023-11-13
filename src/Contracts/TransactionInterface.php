<?php

namespace ValoremPay\Contracts;

interface TransactionInterface extends HasPayloadInterface
{
    public function validate(): void;

    public function getRequired(): array;

    public function setRequired(array $required): self;
}