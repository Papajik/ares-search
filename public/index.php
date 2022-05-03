<?php
require_once '../vendor/autoload.php';

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
        $query = parse_url($request, PHP_URL_QUERY);
        parse_str($query, $output);
        if (!empty($output) && $output['read'] == 1) {
            require __DIR__ . '/view/rss.php';
        } else {
            require __DIR__ . '/calls/rss.php';
        }
        break;
    case '/address':
    case '/address.php':
        require __DIR__ . '/calls/address.php';
        break;
    default:
        echo "Obsah nedostupný<br><a href='//" . $_SERVER['SERVER_NAME'] . "/'>Návrat na hlavní stránku</br>";
        http_response_code(404);
        die();
}
