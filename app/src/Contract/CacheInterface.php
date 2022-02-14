<?php

declare(strict_types=1);

namespace App\Contract;

interface CacheInterface
{
    public static function set($key, $value, int $ttl = 0);
    public static function get($key);
    public static function delete($key);
}