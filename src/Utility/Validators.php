<?php

declare(strict_types=1);

namespace Src\Utility;

final class Validators
{
    function getEnumValue($value, $enumClass) {
        $cases = $enumClass::cases();
        $index = array_search($value, array_column($cases, "name"));
        if ($index !== false) {
            return $cases[$index];
        }

        return null;
    }
}
