<?php

declare(strict_types=1);

namespace Src\Domain\DataResource\User;

use Illuminate\Database\Capsule\Manager as Capsule;
use RuntimeException;
use Src\Domain\Model\User\Interface\SettableUserInterface;
use Src\Domain\Model\User\SettableUser;
use Src\Domain\Model\User\UserCollection;

/**
 * @package Src\Domain\DataResource\User
 */
final class UserRowDataGateway extends SettableUser implements SettableUserInterface
{
    /**
     * @var string
     */
    private static string $table = 'tbl_user';

    /**
     * @return UserCollection<SettableUserInterface>
     */
    final public static function findAll(): UserCollection
    {
        $resultSet = Capsule::table(self::$table)->get();
        $userList = [];
        foreach ($resultSet as $user) {
            $userList[] = new self($user->user_id, $user->level, $user->exp);
        }
        return UserCollection::fromArray($userList);
    }

    /**
     * Gateway は TransactionScript にドメインロジックを記述することを考慮しているので、
     * 任意にプロパティを変更できるオブジェクトであることを保証している
     *
     * @param int $userId
     * @return SettableUserInterface
     */
    final public static function findByUserId(int $userId): SettableUserInterface
    {
        $user = Capsule::table(self::$table)->where('user_id', $userId)->get();
        if (count($user) === 0) {
            throw new RuntimeException("user not found: {$userId}");
        }
        return new self($user->get('userId'), $user->get('level'), $user->get('exp'));
    }

    /**
     * @param UserCollection<SettableUserInterface> $userCollection
     * @return bool
     */
    final public static function create(UserCollection $userCollection): bool
    {
        return Capsule::table(self::$table)->insert($userCollection->toArray());
    }

    /**
     * @param UserCollection<SettableUserInterface> $userCollection
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
