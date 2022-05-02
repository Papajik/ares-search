<?php

namespace Papajik\AresSearch\Service;

use Papajik\AresSearch\Classes\RssDetailItem;
use Papajik\AresSearch\Classes\RssItem;

class Rss
{
    public function createHtmlDetail(RSSDetailItem $item): string
    {
        $info = array(
            "Adresa" => $item->getAddress(),
            "Město" => $item->getCity(),
            "PSČ" => $item->getPostalCode(),
            "Země" => $item->getCountry(),
            "Tel. číslo" => $item->getPhone(),
            'Aktualizace:' => max([$item->getAddressUpdate(), $item->getCountryUpdate(), $item->getCityUpdate()])->format('d. m. Y H:i:s')
        );

        $res = "<div>";
        $res .= "<h2>Detail adresy</h2>";
        $res .= "<table>";
        foreach ($info as $key => $value) {
            $res .= "<tr><th style='text-align: left'>" . $key . "</th><td>" . $value . "</td>";
        }
        $res .= "</table>";
        return $res;
    }

    public function createXml(array $items): string
    {
        $rss = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" ></rss>');
        $channel = $rss->addChild('channel');
        $channel->addChild('title', 'Addresses');
        $channel->addChild('description', 'Addresses');

        $channel->addChild('link', $this->isSecure() ? "https" : "http" . '://www.' . $_SERVER['SERVER_NAME'] . '/rss');


        /** @var RssItem $address */
        foreach ($items as $address) {
            $item = $channel->addChild('item');
            $item->addChild('title', $address->getTitle());
            $item->addChild('link', $this->isSecure() ? "https" : "http" . '://www.' . $_SERVER['SERVER_NAME'] . '/address?id=' . $address->getId());
            //var_dump($address->getPubDate());
            $item->addChild('pubDate', $address->getPubDate()->format(DATE_ATOM));
        }

        return $rss->asXML();
    }


    /**
     * Private method to determine links protocol
     * @return bool
     */
    private function isSecure(): bool
    {
        return
            (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || $_SERVER['SERVER_PORT'] == 443;
    }
}