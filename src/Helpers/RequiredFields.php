<?php

namespace ValoremPay\Helpers;

use ValoremPay\Exceptions\ValidatorException;

class RequiredFields
{
    public function __construct(
        private readonly array  $required,
        private readonly object $class
    )
    {
        $this->validate();
    }

    public function validate(): void
    {
        if (!is_object($this->class)) {
            throw new \DomainException('Invalid class provided');
        }

        if (count($empties = array_filter($this->required, fn($field) => empty($field)))) {
            $exception = new ValidatorException();
            array_map(fn($field) => $exception->addField($field), array_keys($empties));
            throw $exception;
        }
    }

    public static function check(array $required, object $class): void
    {
        new self($required, $class);
    }
}
