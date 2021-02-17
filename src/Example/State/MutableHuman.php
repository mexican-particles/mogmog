<?php

declare(strict_types=1);

namespace Src\Example\State;

/**
 * @package Src\Example\State
 */
final class MutableHuman
{
    public string $name = 'Kono';
}

// phpcs:disable PSR1.Files.SideEffects
$human = new MutableHuman();
var_dump($human->name); // Kono

$human->name = 'Sato';
var_dump($human->name); // Sato
