<?php

declare(strict_types=1);

namespace Src\Domain\DataResource\Interface;

use Src\Domain\Model\Level\Interface\LevelInterface;

/**
 * @package Src\Domain\Model\DataResourceInterface
 */
interface LevelDataResourceInterface
{
    /**
     * @param int $exp
     * @return LevelInterface
     */
    public function findByExp(int $exp): LevelInterface;
}
