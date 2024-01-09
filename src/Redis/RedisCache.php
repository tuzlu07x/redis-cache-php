<?php

namespace Fatihtuzlu\RedisCachePhp;

use Predis\Client;

class RedisCache
{

    public function __construct(private Connection $connection, private Client $redis)
    {
        $this->redis = $this->connection->connect();
    }

    public function set(string $key, mixed $value, int $expiration = 3600): void
    {
        $serializedValue = serialize($value);
        $this->redis->set($key, $serializedValue);
        $this->redis->expire($key, $expiration);
    }

    public function getAllKeys(string $cursor = '0', array $keys = []): array
    {
        do {
            $result = $this->redis->scan($cursor);
            $cursor = $result[0];
            $keys = array_merge($keys, $result[1]);
        } while ($cursor !== '0');

        return $keys;
    }

    public function get(string $key): mixed
    {
        $serializedValue = $this->redis->get($key);

        if ($serializedValue !== false) {
            return unserialize($serializedValue);
        }

        return null;
    }

    public function getAllCachedData(): array
    {
        $data = [];
        foreach ($this->getAllKeys() as $key) {
            $value = $this->redis->get($key);
            $data[] = [
                'key' => $key,
                'value' => $value,
            ];
        }
        return $data;
    }

    public function delete(string $key): void
    {
        $this->redis->del($key);
    }
}
