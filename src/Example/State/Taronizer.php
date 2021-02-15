<?php

declare(strict_types=1);

namespace Src\Example\State;

/**
 * @package Src\Example\State
 */
final class Taronizer
{
    private HumanStruct $human;

    public function __construct(HumanStruct $human)
    {
        $this->human = $human;
    }

    public function getUserName(): string
    {
        return "{$this->human->name} Taro";
    }
}

// phpcs:disable PSR1.Files.SideEffects
$human = new HumanStruct();
$taronized = new Taronizer($human);
var_dump($taronized->getUserName()); // Kono Taro

$human->name = 'Sato';
var_dump($taronized->getUserName()); // Sato Taro
