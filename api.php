<?php

use JustinMueller\Flugplanung\Helper;

require_once __DIR__ . '/vendor/autoload.php';

Helper::checkLogin();

$action = ltrim(str_replace($_SERVER['SCRIPT_NAME'], '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)), '/');
$handlerClassName = 'JustinMueller\\Flugplanung\\Api\\' . ucfirst($action);

if (class_exists($handlerClassName)) {
    $handler = new $handlerClassName();
    $result = $handler->handle();
} else {
    $result = ['success' => false, 'error' => 'No handler found for ' . $action];
}

header('Content-Type: application/json');
echo json_encode($result ?: [], JSON_THROW_ON_ERROR);
