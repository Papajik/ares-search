<?php
require_once '../vendor/autoload.php';

use Tracy\Debugger;

Debugger::enable();

$request = $_SERVER['REQUEST_URI'];

switch (parse_url($request, PHP_URL_PATH)) {
    case '':
    case '/' :
        require __DIR__ . '/view/search.php';
        break;
    case '/history':
    case '/history.php':
        require __DIR__ . '/view/history.php';
        break;
    case '/rss':
    case '/rss.xml':
        require __DIR__ . '/calls/rss.php';
        break;
    case '/address':
    case '/address.php':
        require __DIR__ . '/calls/address.php';
        break;
    default:
        echo "<a href='//" . $_SERVER['SERVER_NAME'] . "/'>Návrat</br>";
        http_response_code(404);
        die();
}