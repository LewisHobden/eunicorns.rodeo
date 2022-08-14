<?php

namespace App\Enum;

trait ToFriendlyTrait
{
    public function toFriendly() : string
    {
        $string_components = [];

        foreach (explode("_",$this->name) as $word) {
            $string_components[] = ucfirst(strtolower($word));
        }

        return implode(" ",$string_components);
    }
}
