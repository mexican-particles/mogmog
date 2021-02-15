<?php

declare(strict_types=1);

namespace Src\Domain\DataResource\Interface;

use Src\Domain\Model\User\Interface\UserDomainModelInterface;
use Src\Domain\Model\User\UserCollection;

/**
 * @package Src\Domain\Model\DataResourceInterface
 */
interface UserMapperInterface
{
    /**
     * @return UserCollection<UserDomainModelInterface>
     */
    public function findAll(): UserCollection;

    /**
     * Mapper は DomainModel にドメインロジックを記述することを考慮しているので、
     * ドメインロジックが含まれているオブジェクトであることを保証している
     *
     * @param int $userId
     * @return UserDomainModelInterface
     */
    public function findByUserId(int $userId): UserDomainModelInterface;

    /**
     * @param UserCollection<UserDomainModelInterface> $userCollection
     * @return bool
     */
    public function create(UserCollection $userCollection): bool;

    /**
     * @param UserCollection<UserDomainModelInterface> $userCollection
     * @return int
     */
    public function update(UserCollection $userCollection): int;

    /**
     * @param array<int> $userIdList
     * @return int
     */
    public function delete(array $userIdList): int;
}
