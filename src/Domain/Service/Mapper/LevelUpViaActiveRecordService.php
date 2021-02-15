<?php

declare(strict_types=1);

namespace Src\Domain\Service\Mapper;

use Src\Domain\DataResource\Interface\LevelDataResourceInterface;
use Src\Domain\Model\User\UserActiveRecord;
use Src\Domain\Model\User\UserCollection;
use Src\Domain\Service\Interface\LevelUpServiceInterface;

/**
 * @package Src\Domain\Service\Mapper
 */
final class LevelUpViaActiveRecordService implements LevelUpServiceInterface
{
    /**
     * @var LevelDataResourceInterface
     */
    private LevelDataResourceInterface $levelMapper;

    /**
     * @param LevelDataResourceInterface $levelMapper
     */
    final public function __construct(
        LevelDataResourceInterface $levelMapper
    ) {
        $this->levelMapper = $levelMapper;
    }

    /**
     * {@inheritDoc}
     */
    final public function __invoke(int $userId, int $expGained): void
    {
        $user = UserActiveRecord::findByUserId($userId);
        $mstLevel = $this->levelMapper->findByExp($user->getExp() + $expGained);

        $user->reflect($mstLevel, $expGained);
        UserActiveRecord::update(UserCollection::fromArray([$user]));
    }
}
