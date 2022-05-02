<?php

namespace Papajik\AresSearch\Repository;

use Dibi\DriverException;
use Dibi\Exception;
use Dibi\Row;
use Papajik\AresSearch\Classes\DeliveryAddress;
use Papajik\AresSearch\Classes\Subject;
use Papajik\AresSearch\Service\Database;


class SubjectRepository
{


    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * Saves subject into database
     * @param Subject $subject Subject to save
     * @return void
     */
    public function saveSubject(Subject $subject): void
    {
        try {
            $this->database->getConnection()->connect();

            $arr = [
                'ico' => $subject->getIco(),
                'dic' => $subject->getDic(),
                'name' => $subject->getName(),
                'creation_date' => $subject->getCreationDate(),
                'street' => $subject->getDeliveryAddress()->getStreet(),
                'city' => $subject->getDeliveryAddress()->getCity(),
                'search_date' => $subject->getSearchDate()
            ];

            $this->database->getConnection()->query('INSERT INTO subjects', $arr);
        } catch (DriverException|Exception $e) {
            var_dump($e->getMessage());
        }
    }

    /**
     * @param int $id ID of subject
     * @return Subject|null Returns subject if row with given ID is found, null otherwise
     */
    public function loadSubject(int $id): ?Subject
    {
        try {
            $this->database->getConnection()->connect();

            $result = $this->database->getConnection()->query('SELECT * FROM subjects WHERE id = ?', $id);
            if ($result->getRowCount() == 1) {
                $row = $result->fetch();
                return $this->parseSubject($row);
            } else {
                return null;
            }
        } catch (DriverException|Exception $e) {
            echo $e;
        }
        return null;
    }


    /**
     * @param string $filter if $filter is used function only returns result with name containing its value
     * @return int number of subjects found in DB
     */
    public function getSubjectsCount(string $filter = ""): int
    {
        try {
            $this->database->getConnection()->connect();
            $result = $this->database->getConnection()->query('SELECT * FROM subjects WHERE name LIKE %~like~', $filter);
            return $result->getRowCount();
        } catch (DriverException|Exception $e) {
            echo $e->getMessage();
            return -1;
        }
    }

    /**
     * @param string $orderBy
     * @param bool $direction true = asc
     * @param int $offset skip first result
     * @param int $limit upper limit of results
     * @param string $filter if @$filter is used function only returns result with name containing its value
     * @return array array of Subjects
     */
    public function loadSubjects(string $orderBy, bool $direction, int $offset, int $limit, string $filter = ""): array
    {
        try {
            $arr = [];
            $this->database->getConnection()->connect();
            $result = $this->database->getConnection()->query('SELECT * FROM subjects WHERE name LIKE %~like~ ORDER BY %by %lmt %ofs', $filter, $this->translateOrder($orderBy, $direction), $limit, $offset);
            foreach ($result as $row) {
                $arr[$row->id] = $this->parseSubject($row);
            }
            return $arr;
        } catch (DriverException|Exception $e) {
            echo $e->getMessage();
            return [];
        }

    }

    private function translateOrder(string $name, bool $order): array
    {
        return match ($name) {
            'name' => ['name' => $order],
            'date' => ['search_date' => $order],
            'name_date' => ['name' => $order, 'search_date' => $order],
            default => [],
        };
    }


    /** @noinspection PhpUndefinedFieldInspection */
    private function parseSubject(Row $row): Subject
    {
        return new Subject(
            ico: $row->ico,
            dic: $row->dic,
            name: $row->name,
            creation_date: $row->creation_date,
            deliveryAddress: new DeliveryAddress(
                $row->street,
                $row->city,
            ),
            search_date: $row->search_date
        );
    }
}