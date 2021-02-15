<?php

declare(strict_types=1);

namespace Src\Domain\Model\User;

use Src\Domain\DataResource\User\AbstractUserActiveRecord;
use Src\Domain\Model\Level\Interface\LevelInterface;
use Src\Domain\Model\User\Interface\UserDomainModelInterface;

/**
 * ドメインロジックを持つミュータブルなアクティブレコード
 *
 * @package Src\Domain\Model\User
 */
final class UserActiveRecord extends AbstractUserActiveRecord implements UserDomainModelInterface
{
    /**
     * {@inheritDoc}
     */
    final public function reflect(LevelInterface $mstLevel, int $expGained): void
    {
        $this->setLevel($mstLevel->getLevel());
        $this->addExp($expGained);
    }

    /**
     * @param int $level
     */
    private function setLevel(int $level): void
    {
        assert($this->level <= $level, '現在のレベルは、経験値獲得後のレベルより大きくならない');
        $this->level = $level;
    }

    /**
     * @param int $exp
     */
    private function addExp(int $exp): void
    {
        assert($exp >= 0, '経験値はマイナスすることができない');
        $this->exp += $exp;
    }
}
