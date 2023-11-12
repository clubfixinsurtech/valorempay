<?php

namespace ValoremPay\Helpers;

class ReflectionalProperties
{
    public static function filledProperties($class): array
    {
        $reflection = new \ReflectionClass($class);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE);

        $filledReflectionalProperties = array_filter(
            $properties,
            fn(\ReflectionProperty $property) => $property->getValue($class) !== null
        );

        $filledProperties = [];

        foreach ($filledReflectionalProperties as $propertyWithValue) {
            $value = $propertyWithValue->getValue($class);
            if (Validator::isEnum($value)) {
                $value = $value->value;
            } elseif (is_object($value) && method_exists($value, 'payload')) {
                $value = $value->payload();
            }
            $filledProperties[$propertyWithValue->getName()] = $value;
        }

        return $filledProperties;
    }
}
