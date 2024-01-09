# PHP cache Mecanism

## Install Dependencies:
    composer require ftuzlu/redis-cache

## Establish Redis Connection:

- First step is connect to Redis with Connect class

```php
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

$redisCache->delete('example_key'); //delete redis

```

## Cache Mecanism

- If you want you can use cache mecanism

## Cache Create Usage
- Create function is create cache

```php 
<?php

require_once('vendor/autoload.php');

$cacheInstance = new Symfony\Component\Cache\Simple\FilesystemCache();

$myCache = new Fatihtuzlu\CacheMecanism\Cache($cacheInstance);

$result = $myCache->create('new_key', 'New value', 3600);

```

## Remember Cache and Retrieve Data:

```php 
<?php

require_once('vendor/autoload.php');

$cacheInstance = new Symfony\Component\Cache\Simple\FilesystemCache();

$myCache = new Fatihtuzlu\CacheMecanism\Cache($cacheInstance);

$result = $myCache->remember('example_key', function () {
    echo 'Calculating result...' . PHP_EOL;
    return 42;
}, 60);

echo 'Result: ' . $result . PHP_EOL;


```

## Remember Cache Forever and Retrieve Data:

```php 
<?php

require_once('vendor/autoload.php');

$cacheInstance = new Symfony\Component\Cache\Simple\FilesystemCache();

$myCache = new Fatihtuzlu\CacheMecanism\Cache($cacheInstance);

$result = $myCache->rememberForever('example_key', function () {
    echo 'Calculating result...' . PHP_EOL;
    return 42;
});

echo 'Result: ' . $result . PHP_EOL;

```

## Forget Cache Data:

```php 
<?php

require_once('vendor/autoload.php');

$cacheInstance = new Symfony\Component\Cache\Simple\FilesystemCache();

$myCache = new Fatihtuzlu\CacheMecanism\Cache($cacheInstance);

$result = $myCache->forget('new_key');

```