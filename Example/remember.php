<?php

require_once('vendor/autoload.php');

$cacheInstance = new Symfony\Component\Cache\Simple\FilesystemCache();

$myCache = new Fatihtuzlu\CacheMecanism\Cache($cacheInstance);

$result = $myCache->remember('example_key', function () {
    echo 'Calculating result...' . PHP_EOL;
    return 42;
}, 60);

echo 'Result: ' . $result . PHP_EOL;
