<?php

namespace ValoremPay\Helpers;

class PropertyValidator
{
    public static function validate(object $class): void
    {
        $reflection = new \ReflectionClass($class);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE);

        foreach ($properties as $property) {
            $methodName = 'validate' . ucfirst($property->getName());
            if (method_exists($class, $methodName)) {
                $method = $reflection->getMethod($methodName);
                $method->invoke($class);
            }
        }
    }
}