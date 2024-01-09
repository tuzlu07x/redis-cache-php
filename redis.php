<?php
require_once('vendor/autoload.php');

use Fatihtuzlu\RedisCachePhp\Connection;
use Fatihtuzlu\RedisCachePhp\RedisCache;
use Predis\Client;

$connection = new Connection('tcp', '127.0.0.1', '6379');

$client = new Client();
$redisCache = new RedisCache($connection, $client);

$redisCache->set('example_key', 'Hello, Redis Cache!');

$val = $redisCache->getAllCachedData();
var_dump($val);

$value = $redisCache->get('example_key');
echo $value; // Output: Hello, Redis Cache!

$redisCache->delete('example_key');
