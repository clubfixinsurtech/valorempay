<?php

namespace ValoremPay\Contracts;

interface HasPayloadInterface extends \JsonSerializable
{
    public function payload(): array;
}