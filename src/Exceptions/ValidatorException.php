<?php

namespace ValoremPay\Exceptions;

class ValidatorException extends \Exception
{
    private array $fields = [];
    protected $message = 'Invalid data. Check all the parameters provided!';

    public function addField(string $field, ?string $message = null): static
    {
        $this->fields[$field] = $message;
        return $this;
    }
}
