<?php

namespace Fatihtuzlu\RedisCachePhp;

use Predis\Client;

class Connection
{
    public function __construct(
        private string $schema,
        private string $host,
        private ?string $port = null,
        private ?Client $client = null
    ) {
    }

    public function connect(): Client
    {
        if ($this->client === null) {
            $this->client = new Client([
                'scheme' => $this->schema,
                'host'   => $this->host,
                'port'   => $this->port ?? 6379,
            ]);
            return $this->client;
        }
        return $this->client;
    }
}
