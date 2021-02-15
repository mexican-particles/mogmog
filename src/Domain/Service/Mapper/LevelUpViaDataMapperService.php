<?php

declare(strict_types=1);

namespace Src\Domain\Service\Mapper;

use Src\Domain\DataResource\Interface\LevelDataResourceInterface;
use Src\Domain\DataResource\Interface\UserMapperInterface;
use Src\Domain\Model\User\UserCollection;
use Src\Domain\Service\Interface\LevelUpServiceInterface;

/**
 * @package Src\Domain\Service\Mapper
 */
final class LevelUpViaDataMapperService implements LevelUpServiceInterface
{
    /**
     * @var LevelDataResourceInterface
     */
    private LevelDataResourceInterface $levelMapper;

    /**
     * @var UserMapperInterface
     */
    private UserMapperInterface $userMapper;

    /**
     * @param LevelDataResourceInterface $levelMapper
     * @param UserMapperInterface $userMapper
     */
    final public function __construct(
        LevelDataResourceInterface $levelMapper,
        UserMapperInterface $userMapper
    ) {
        $this->levelMapper = $levelMapper;
        $this->userMapper = $userMapper;
    }

    /**
     * {@inheritDoc}
     */
    final public function __invoke(int $userId, int $expGained): void
    {
        $user = $this->userMapper->findByUserId($userId);
        $mstLevel = $this->levelMapper->findByExp($user->getExp() + $expGained);

        $user->reflect($mstLevel, $expGained);
        $this->userMapper->update(UserCollection::fromArray([$user]));
    }
}
