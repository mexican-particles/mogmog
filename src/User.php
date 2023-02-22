<?php
declare(strict_types=1);

namespace Src;

class User extends Model
{
    protected static $keys = ['id', 'username'];
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $username;
}
