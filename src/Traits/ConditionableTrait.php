<?php

namespace ValoremPay\Traits;

trait ConditionableTrait
{
    public function when(bool $condition, callable $callable, ?callable $default = null)
    {
        if ($condition) {
            call_user_func($callable, $this);
        }

        if ($default && !$condition) {
            call_user_func($default, $this);
        }

        return $this;
    }
}
