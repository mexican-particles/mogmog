<?php

declare(strict_types=1);

namespace Src\Domain\Model\User\Interface;

use Src\Domain\Model\Level\Interface\LevelInterface;

/**
 * @package Src\Domain\Model\User
 */
interface UserDomainModelInterface extends GettableUserInterface
{
    /**
     * 経験値の上昇をユーザに反映する
     * @param LevelInterface $mstLevel
     * @param int $expGained
     */
    public function reflect(LevelInterface $mstLevel, int $expGained): void;
}
