<?php

declare(strict_types=1);

namespace Src\Domain\Model\User;

use Src\Domain\Model\User\Interface\SettableUserInterface;

/**
 * 振る舞いを持たない、型付けされたミュータブルなオブジェクト
 * 呼び出し元が任意にプロパティを変更することができる
 *
 * @package Src\Domain\Model\User
 */
class SettableUser extends GettableUser implements SettableUserInterface
{
    /**
     * {@inheritDoc}
     */
    final public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * {@inheritDoc}
     */
    final public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    /**
     * {@inheritDoc}
     */
    final public function setExp(int $exp): void
    {
        $this->exp = $exp;
    }
}
