<?php

declare(strict_types=1);

namespace Src\Example\State;

/**
 * @package Src\Example\State
 */
final class HumanDto
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

// phpcs:disable PSR1.Files.SideEffects
$human = new HumanDto('Sato');
var_dump($human->getName()); // Sato
