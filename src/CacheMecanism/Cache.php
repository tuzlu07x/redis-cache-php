<?php

namespace Fatihtuzlu\CacheMecanism;

use Psr\SimpleCache\CacheInterface;

class Cache
{
    public function __construct(private CacheInterface $cache)
    {
    }

    public function remember(string $key, callable $callback, int $ttl): mixed
    {
        $value = $this->cache->get($key);
        if ($value === null) {
            $value = $callback;
            $this->cache->set($key, $value, $ttl);
        }
        return $value;
    }

    public function rememberForever(string $key, callable $callback): mixed
    {
        $value = $this->cache->get($key);
        if ($value === null) {
            $value = $callback;
            $this->cache->set($key, $value);
        }
        return $value;
    }

    public function forget(string $key): void
    {
        $this->cache->delete($key);
    }

    public function create(string $key, $value, int $ttl): void
    {
        $this->cache->set($key, $value, $ttl);
    }
}
