<?php
declare(strict_types=1);

namespace OP\Tasks\Entity;

use PDO;
use PDOException;
use OP\Tasks\Entity\ADBTable;

class User extends ADBTable
{
    public function __construct()
    {
        parent::__construct();
    }

    public function authorization($name, $password)
    {
        $role = 'admin';
        $sql = "SELECT * FROM tasks.users WHERE name=:name AND password=:password AND role=:role ";
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute(array(':name'=>$name, ':password'=>$password, ':role'=>$role))) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['user_id'];
        } else {
            return false;
        }
    }

    public function getIdItem($params)
    {
        extract($params);
        $role = 'guest';
        $sql = "SELECT * FROM tasks.users WHERE name=:name AND email=:email AND role=:role ";
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute(array(':name'=>$name, ':email'=>$email, ':role'=>$role))) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['user_id'];
        } else {
            return false;
        }
    }

    public function addItem($params)
    {
        extract($params);
        $role = 'guest';
        $sql = "INSERT INTO tasks.users (name, email, role) VALUE (:name, :email, :role);";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':name'=>$name, ':email'=>$email, ':role'=>$role]);
        return  $this->db->lastInsertId();
    }
}
