<?php

declare(strict_types=1);

namespace Src\Domain\Model\User;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use IteratorAggregate;
use RuntimeException;
use Src\Domain\Model\User\Interface\GettableUserInterface;

/**
 * @phpstan-template T
 * @package Src\Domain\Model\User
 */
final class UserCollection implements Arrayable, IteratorAggregate
{
    /**
     * @phpstan-var Collection<T>
     * @var Collection<GettableUserInterface>
     */
    private Collection $items;

    /**
     * @phpstan-param array<T> $userList
     * @param array<GettableUserInterface> $userList
     */
    final public function __construct(array $userList)
    {
        $isInvalidList = collect($userList)->containsStrict(
            fn ($user) => $user instanceof GettableUserInterface === false
        );
        if ($isInvalidList) {
            throw new RuntimeException('User インスタンスではないオブジェクトが渡された');
        }
        $this->items = collect($userList);
    }

    /**
     * @phpstan-param array<T> $userList
     * @phpstan-return UserCollection<T>
     *
     * @param array<GettableUserInterface> $userList
     * @return UserCollection<GettableUserInterface>
     */
    final public static function fromArray(array $userList): self
    {
        return new self($userList);
    }

    /**
     * @return array<GettableUserInterface>
     */
    final public function toArray(): array
    {
        return $this->items->toArray();
    }

    /**
     * @return Collection<GettableUserInterface>
     */
    final public function getIterator(): Collection
    {
        return $this->items;
    }
}
