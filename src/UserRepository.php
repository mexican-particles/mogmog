<?php

declare(strict_types=1);

namespace Src;

class UserRepository
{
    public function findAll()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM user_table');
        $stmt->execute();
        $hoge = User::Factory($stmt->fetch());
        return $hoge;
    }
}
