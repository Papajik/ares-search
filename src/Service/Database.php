<?php

namespace Papajik\AresSearch\Service;

use Dibi\Connection;
use Dibi\Exception;
use Papajik\Config\AppConfig;

class Database
{
    private static ?Database $instance = null;

    /**
     * @return Database
     */
    public static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    private Connection $connection;

    /**
     * @return Connection
     */
    public function getConnection(): Connection
    {
        return $this->connection;
    }


    /**
     * @throws Exception
     */
    private function __construct()
    {
        $this->connection = new Connection([
            'driver' => 'mysqli',
            'host' => AppConfig::DB_HOST,
            'username' => AppConfig::DB_USER,
            'password' => AppConfig::DB_PASS,
            'database' => AppConfig::DB_NAME,
        ]);
    }
}