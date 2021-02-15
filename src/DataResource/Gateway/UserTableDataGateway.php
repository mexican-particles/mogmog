<?php

declare(strict_types=1);

namespace Src\DataResource\Gateway;

use Illuminate\Database\Capsule\Manager as Capsule;
use RuntimeException;
use Src\Domain\DataResource\Interface\UserGatewayInterface;
use Src\Domain\Model\User\Interface\SettableUserInterface;
use Src\Domain\Model\User\SettableUser;
use Src\Domain\Model\User\UserCollection;

/**
 * @package Src\DataResource\Gateway
 */
final class UserTableDataGateway implements UserGatewayInterface
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
            $userList[] = new SettableUser($user->user_id, $user->level, $user->exp);
        }
        return UserCollection::fromArray($userList);
    }

    /**
     * {@inheritDoc}
     */
    final public function findByUserId(int $userId): SettableUserInterface
    {
        $user = Capsule::table($this->table)->where('user_id', $userId)->get();
        if (count($user) === 0) {
            throw new RuntimeException("user not found: {$userId}");
        }
        return new SettableUser($user->get('userId'), $user->get('level'), $user->get('exp'));
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
