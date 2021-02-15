<?php

declare(strict_types=1);

namespace Src\Domain\DataResource\Interface;

use Src\Domain\Model\User\Interface\SettableUserInterface;
use Src\Domain\Model\User\UserCollection;

/**
 * @package Src\Domain\Model\DataResourceInterface
 */
interface UserGatewayInterface
{
    /**
     * @return UserCollection<SettableUserInterface>
     */
    public function findAll(): UserCollection;

    /**
     * Gateway は TransactionScript にドメインロジックを記述することを考慮しているので、
     * 任意にプロパティを変更できるオブジェクトであることを保証している
     *
     * @param int $userId
     * @return SettableUserInterface
     */
    public function findByUserId(int $userId): SettableUserInterface;

    /**
     * @param UserCollection<SettableUserInterface> $userCollection
     * @return bool
     */
    public function create(UserCollection $userCollection): bool;

    /**
     * @param UserCollection<SettableUserInterface> $userCollection
     * @return int
     */
    public function update(UserCollection $userCollection): int;

    /**
     * @param array<int> $userIdList
     * @return int
     */
    public function delete(array $userIdList): int;
}
