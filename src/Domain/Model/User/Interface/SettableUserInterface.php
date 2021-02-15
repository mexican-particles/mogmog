<?php

declare(strict_types=1);

namespace Src\Domain\Model\User\Interface;

/**
 * @package Src\Domain\Model\User
 */
interface SettableUserInterface extends GettableUserInterface
{
    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void;

    /**
     * @param int $level
     */
    public function setLevel(int $level): void;

    /**
     * @param int $exp
     */
    public function setExp(int $exp): void;
}
