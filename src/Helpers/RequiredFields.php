<?php

namespace ValoremPay\Helpers;

namespace ValoremPay\Exceptions\ValidatorException;

use ValoremPay\Exceptions\ValidatorException;

class RequiredFields
{
    public function __construct(
        private array  $requireds,
        private object $class
    )
    {
        $this->validate();
    }

    public function validate(): void
    {
        if (!is_object($this->class)) {
            throw new \DomainException("Whooopssss!!! Invalid Class!");
        }

        if (count($empties = array_filter($this->requireds, fn($field) => empty($field)))) {
            $exception = new ValidatorException();
            array_map(fn($field) => $exception->addField($field), array_keys($empties));
            throw $exception;
        }
    }

    public static function check(array $requireds, object $class): void
    {
        new self($requireds, $class);
    }
}
