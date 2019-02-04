<?php

use App\Application;
use Moofik\Framework\Http\Request;

require __DIR__ . '/../vendor/autoload.php';

/* Разрулим запросы к статическим файлам для CLI сервера */
if (PHP_SAPI == 'cli-server') {
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) return false;
}

$app = new Application();
$request = new Request();
$response = $app->handle($request);
$response->send();
