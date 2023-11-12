<?php

namespace ValoremPay\Contracts;

use ValoremPay\Entities\SubacquirerMerchant;

interface SubacquirerMerchantInterface
{
    public function getState(): string;

    public function setState(string $state): SubacquirerMerchant;

    public function getCountry(): string;

    public function setCountry(string $country): SubacquirerMerchant;

    public function getZipCode(): string;

    public function setZipCode(string $zip_code): SubacquirerMerchant;

    public function getCity(): ?string;

    public function setCity(?string $city): SubacquirerMerchant;

    public function getAddress(): ?string;

    public function setAddress(?string $address): SubacquirerMerchant;
}