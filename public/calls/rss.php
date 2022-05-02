<?php


use Papajik\AresSearch\Repository\RssRepository;
use Papajik\AresSearch\Service\Database;
use Papajik\AresSearch\Service\Rss;


 $rssRepository = new RssRepository(Database::getInstance());
 $rssService = new Rss();
 header("Content-type: text/xml;charset=utf-8");
 $rss = $rssService->createXml($rssRepository->getItems());
 echo $rss;