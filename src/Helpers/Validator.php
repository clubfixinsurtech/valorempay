<?php

namespace ValoremPay\Helpers;

use ValoremPay\Exceptions\ValidatorException;

class Validator
{
    public static function email(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw (new ValidatorException('E-mail Inválido'))->addField('email');
        }
    }


    public static function ip(string $ip): void
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            throw (new ValidatorException('IP Inválido'))->addField('remoteIp');
        }
    }

    public static function isEnum($object): bool
    {
        return is_object($object) && (new \ReflectionClass($object))->isEnum();
    }

}
