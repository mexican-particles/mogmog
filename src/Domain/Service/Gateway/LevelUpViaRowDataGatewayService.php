<?php

declare(strict_types=1);

namespace Src\Domain\Service\Gateway;

use Src\Domain\DataResource\Interface\LevelDataResourceInterface;
use Src\Domain\DataResource\User\UserRowDataGateway;
use Src\Domain\Model\Level\Interface\LevelInterface;
use Src\Domain\Model\User\Interface\SettableUserInterface;
use Src\Domain\Model\User\UserCollection;
use Src\Domain\Service\Interface\LevelUpServiceInterface;

/**
 * @package Src\Domain\Service\Gateway
 */
final class LevelUpViaRowDataGatewayService implements LevelUpServiceInterface
{
    /**
     * @var LevelDataResourceInterface
     */
    private LevelDataResourceInterface $levelGateway;

    /**
     * @param LevelDataResourceInterface $levelGateway
     */
    final public function __construct(
        LevelDataResourceInterface $levelGateway
    ) {
        $this->levelGateway = $levelGateway;
    }

    /**
     * {@inheritDoc}
     */
    final public function __invoke(int $userId, int $expGained): void
    {
        $user = UserRowDataGateway::findByUserId($userId);
        $mstLevel = $this->levelGateway->findByExp($user->getExp() + $expGained);

        $this->reflect($mstLevel, $expGained, $user);
        UserRowDataGateway::update(UserCollection::fromArray([$user]));
    }

    /**
     * @param LevelInterface $mstLevel
     * @param int $expGained
     * @param SettableUserInterface $user
     */
    private function reflect(LevelInterface $mstLevel, int $expGained, SettableUserInterface $user): void
    {
        $this->setLevel($mstLevel->getLevel(), $user);
        $this->addExp($expGained, $user);
    }

    /**
     * @param int $level
     * @param SettableUserInterface $user
     */
    private function setLevel(int $level, SettableUserInterface $user): void
    {
        assert($user->getLevel() <= $level, '現在のレベルは、経験値獲得後のレベルより大きくならない');
        $user->setLevel($level);
    }

    /**
     * @param int $exp
     * @param SettableUserInterface $user
     */
    private function addExp(int $exp, SettableUserInterface $user): void
    {
        assert($exp >= 0, '経験値はマイナスすることができない');
        $user->setExp($user->getExp() + $exp);
    }
}
