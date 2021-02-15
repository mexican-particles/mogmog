<?php

declare(strict_types=1);

namespace Src\Example\State;

/**
 * @package Src\Example\State
 */
final class MathUtil
{
    public static function sum(int $a, int $b): int
    {
        return $a + $b;
    }

    public static function mul(int $a, int $b): int
    {
        return $a * $b;
    }
}
