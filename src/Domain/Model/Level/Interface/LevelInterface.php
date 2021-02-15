<?php

declare(strict_types=1);

namespace Src\Domain\Model\Level\Interface;

/**
 * @package Src\Domain\Model\Level
 */
interface LevelInterface
{
    /**
     * @return int
     */
    public function getLevel(): int;
}
