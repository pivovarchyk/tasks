<?php
declare(strict_types=1);

namespace OP\Tasks\Entity;

use PDO;
use PDOException;
use OP\Tasks\Config\Config;

abstract class ADBTable
{
    protected $db;

    public function __construct()
    {
        try {
            $dns = Config::DB_DRIVER.":host=".Config::DB_HOST.";port=".Config::DB_PORT.";dbname=".Config::DB_NAME;
            $user = Config::DB_USER;
            $password = Config::DB_PASSWORD;
            $this->db = new PDO($dns, $user, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Error!: ".$e->getMessage(). "</br>";
        }
    }

    abstract public function addItem($params);
}
