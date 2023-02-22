<?php

declare(strict_types=1);

namespace Src;

use Exception;

/**
 * @package Src
 */
class Model
{
    protected static $keys;

    /**
     * @param $array
     * @return Model
     */
    public static function factory($array): static
    {
        try {
            if (array_keys($array) === static::$keys) {
                return new static($array['id'], $array['username']); //ここをUserモデル以外でもインスタンス生成できるように引数を指定したい
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
