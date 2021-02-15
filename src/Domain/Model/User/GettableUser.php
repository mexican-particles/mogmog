<?php

declare(strict_types=1);

namespace Src\Domain\Model\User;

use Src\Domain\Model\User\Interface\GettableUserInterface;

/**
 * 振る舞いを持たない、型付けされたイミュータブルなオブジェクト
 *
 * @package Src\Domain\Model
 */
class GettableUser implements GettableUserInterface
{
    /**
     * @var int
     */
    protected int $userId;

    /**
     * @var int
     */
    protected int $level;

    /**
     * @var int
     */
    protected int $exp;

    /**
     * @param int $userId
     * @param int $level
     * @param int $exp
     */
    final public function __construct(int $userId, int $level, int $exp)
    {
        $this->userId = $userId;
        $this->level = $level;
        $this->exp = $exp;
    }

    /**
     * {@inheritDoc}
     */
    final public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * {@inheritDoc}
     */
    final public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * {@inheritDoc}
     */
    final public function getExp(): int
    {
        return $this->exp;
    }

    /**
     * {@inheritDoc}
     */
    final public function toArray(): array
    {
        return [
            'userId' => $this->userId,
            'level' => $this->level,
            'exp' => $this->exp,
        ];
    }
}
