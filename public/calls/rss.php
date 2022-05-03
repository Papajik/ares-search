<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Papajik\AresSearch\Repository\RssRepository;
use Papajik\AresSearch\Service\Database;
use Papajik\AresSearch\Service\Rss;




$rssRepository = new RssRepository(Database::getInstance());
$rssService = new Rss();
$items = $rssRepository->getItems();

if (isset($_POST['read']) && $_POST['read'] == 1) {
    echo $rssService->createHtml($items);
} else {
    header("Content-type: text/xml;charset=utf-8");
    echo $rssService->createXml($items);
}