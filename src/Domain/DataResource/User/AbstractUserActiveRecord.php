<?php

declare(strict_types=1);

namespace Src\Domain\DataResource\User;

use Illuminate\Database\Capsule\Manager as Capsule;
use RuntimeException;
use Src\Domain\Model\User\GettableUser;
use Src\Domain\Model\User\Interface\UserDomainModelInterface;
use Src\Domain\Model\User\UserCollection;

/**
 * @package Src\Domain\DataResource\User
 */
abstract class AbstractUserActiveRecord extends GettableUser implements UserDomainModelInterface
{
    /**
     * @var string
     */
    private static string $table = 'tbl_user';

    /**
     * @return UserCollection<UserDomainModelInterface>
     */
    final public static function findAll(): UserCollection
    {
        $resultSet = Capsule::table(self::$table)->get();
        $userList = [];
        foreach ($resultSet as $user) {
            $userList[] = new static($user->user_id, $user->level, $user->exp);
        }
        return UserCollection::fromArray($userList);
    }

    /**
     * ActiveRecord はこのオブジェクトにドメインロジックを記述することを考慮しているので、
     * ドメインロジックが含まれているオブジェクトであることを保証している
     *
     * @param int $userId
     * @return UserDomainModelInterface
     */
    final public static function findByUserId(int $userId): UserDomainModelInterface
    {
        $user = Capsule::table(self::$table)->where('user_id', $userId)->get();
        if (count($user) === 0) {
            throw new RuntimeException("user not found: {$userId}");
        }
        return new static($user->get('userId'), $user->get('level'), $user->get('exp'));
    }

    /**
     * @param UserCollection<UserDomainModelInterface> $userCollection
     * @return bool
     */
    final public static function create(UserCollection $userCollection): bool
    {
        return Capsule::table(self::$table)->insert($userCollection->toArray());
    }

    /**
     * @param UserCollection<UserDomainModelInterface> $userCollection
     * @return int
     */
    final public static function update(UserCollection $userCollection): int
    {
        $result = 0;
        foreach ($userCollection as $user) {
            $result += Capsule::table(self::$table)
                ->where('user_id', $user->getUserId())
                ->update($user->toArray());
        }
        return $result;
    }

    /**
     * @param array<int> $userIdList
     * @return int
     */
    final public static function delete(array $userIdList): int
    {
        return Capsule::table(self::$table)->whereIn('user_id', $userIdList)->delete();
    }
}
