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
            function (\ReflectionProperty $property) use ($class) {
                if (!empty($value = $class->{$property->name})) {
                    return $value;
                }
                return null;
            }
        );

        $filledProperties = [];

        foreach ($filledReflectionalProperties as $propertyWithValue) {
            $filledProperties[$propertyWithValue->name] = $class->{$propertyWithValue->name};
        }

        return $filledProperties;
    }
}
