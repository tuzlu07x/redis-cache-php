<?php

require_once('vendor/autoload.php');

$cacheInstance = new Symfony\Component\Cache\Simple\FilesystemCache();

$myCache = new Fatihtuzlu\CacheMecanism\Cache($cacheInstance);

$result = $myCache->forget('new_key');
