<?php

declare(strict_types=1);

namespace Src\Domain\Model\User\Interface;

use Illuminate\Contracts\Support\Arrayable;

/**
 * @package Src\Domain\Model\User
 */
interface GettableUserInterface extends Arrayable
{
    /**
     * @return int
     */
    public function getUserId(): int;

    /**
     * @return int
     */
    public function getLevel(): int;

    /**
     * @return int
     */
    public function getExp(): int;
}
