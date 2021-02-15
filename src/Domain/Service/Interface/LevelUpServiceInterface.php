<?php

declare(strict_types=1);

namespace Src\Domain\Service\Interface;

/**
 * @package Src\Domain\Service\Interface
 */
interface LevelUpServiceInterface
{
    /**
     * $userId に一致するユーザに $expGained を付与する
     * @param int $userId
     * @param int $expGained
     */
    public function __invoke(int $userId, int $expGained): void;
}
