<?php

namespace Papajik\AresSearch\Repository;

use DateTime;
use Dibi\DriverException;
use Dibi\Exception;
use Exception as DateException;
use Papajik\AresSearch\Classes\RssDetailItem;
use Papajik\AresSearch\Classes\RssItem;
use Papajik\AresSearch\Service\Database;

class RssRepository
{

    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getItems(): array
    {
        try {
            $items = [];
            $this->database->getConnection()->connect();

            $rows = $this->database->getConnection()
                ->select('address_id')
                ->select('address')
                ->select('last_update')
                ->from('address')
                ->orderBy('last_update')
                ->desc()
                ->limit(10)->fetchAll();

            foreach ($rows as $item) {
                $items[] = new RssItem(
                    $item->address_id,
                    $item->address,
                    new DateTime($item->last_update)
                );
            }
            return $items;
        } catch (DriverException|Exception|DateException $e) {
            echo $e;
        }
        return [];
    }

    public function getItem(int $id): ?RssDetailItem
    {
        try {
            $this->database->getConnection()->connect();
            $item = $this->database->getConnection()
                ->select('address.*')
                ->select('city')
                ->select('city.last_update as city_update')
                ->select('country')
                ->select('country.last_update as country_update')
                ->from('address')
                ->innerJoin('city')->using('(city_id)')
                ->innerJoin('country')->using('(country_id)')
                ->where('address_id = ?', $id)
                ->fetch();

            if (isset($item)) {
                return new RssDetailItem($item->address,
                    $item->district,
                    $item->postal_code,
                    $item->phone,
                    $item->city,
                    $item->country,
                    new DateTime($item->last_update),
                    new DateTime($item->city_update),
                    new DateTime($item->country_update));
            }
            return null;
        } catch (DateException $e) {
            echo $e->getMessage();
            return null;
        }

    }

}