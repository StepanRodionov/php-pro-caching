<?php

declare(strict_types=1);

namespace App\Cache;

use App\Contract\CacheInterface;

class Cache implements CacheInterface
{
    private static ?\Memcached $memcached = null;

    public function __construct()
    {
        if (self::$memcached === null) {
            self::$memcached = new \Memcached();
            self::$memcached->addServer(
                $_ENV['MEMCACHED_HOST'],
                (int) $_ENV['MEMCACHED_PORT']
            );
        }
    }

    public static function set($key, $value, int $ttl = 0)
    {
        return self::$memcached->set($key, $value, $ttl);
    }

    public static function get($key)
    {
        return self::$memcached->get($key);
    }

    public static function delete($key)
    {
        return self::$memcached->delete($key);
    }
}