<?php

namespace ValoremPay\Entities;

final class Nit
{
    private string $nit;

    public function __construct(string $nit)
    {
        if (strlen($nit) > 64) {
            throw new \InvalidArgumentException('Invalid NIT');
        }

        $this->nit = $nit;
    }

    public function __toString(): string
    {
        return $this->nit;
    }
}