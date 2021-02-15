<?php

declare(strict_types=1);

namespace Src\DataResource\Mapper;

use Illuminate\Database\Capsule\Manager as Capsule;
use RuntimeException;
use Src\Domain\DataResource\Interface\UserMapperInterface;
use Src\Domain\Model\User\Interface\UserDomainModelInterface;
use Src\Domain\Model\User\UserCollection;
use Src\Domain\Model\User\UserDomainModel;

/**
 * @package Src\DataResource\Mapper
 */
final class UserDataMapper implements UserMapperInterface
{
    /**
     * @var string
     */
    private string $table = 'tbl_user';

    /**
     * {@inheritDoc}
     */
    final public function findAll(): UserCollection
    {
        $resultSet = Capsule::table($this->table)->get();
        $userList = [];
        foreach ($resultSet as $user) {
            $userList[] = new UserDomainModel($user->user_id, $user->level, $user->exp);
        }
        return UserCollection::fromArray($userList);
    }

    /**
     * {@inheritDoc}
     */
    final public function findByUserId(int $userId): UserDomainModelInterface
    {
        $user = Capsule::table($this->table)->where('user_id', $userId)->get();
        if (count($user) === 0) {
            throw new RuntimeException("user not found: {$userId}");
        }
        return new UserDomainModel($user->get('userId'), $user->get('level'), $user->get('exp'));
    }

    /**
     * {@inheritDoc}
     */
    final public function create(UserCollection $userCollection): bool
    {
        return Capsule::table($this->table)->insert($userCollection->toArray());
    }

    /**
     * {@inheritDoc}
     */
    final public function update(UserCollection $userCollection): int
    {
        $result = 0;
        foreach ($userCollection as $user) {
            $result += Capsule::table($this->table)
                ->where('user_id', $user->getUserId())
                ->update($user->toArray());
        }
        return $result;
    }

    /**
     * {@inheritDoc}
     */
    final public function delete(array $userIdList): int
    {
        return Capsule::table($this->table)->whereIn('user_id', $userIdList)->delete();
    }
}
