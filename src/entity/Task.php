<?php
declare(strict_types=1);

namespace OP\Tasks\Entity;

use PDO;
use PDOException;
use OP\Tasks\Entity\ADBTable;
use OP\Tasks\Entity\User;

class Task extends ADBTable
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllItems($sort)
    {
        $tasks = array();
        $sortElems = explode('_', $sort);
        $sql  = "SELECT tasks.*, users.name AS name, users.email AS email, users.role AS role
            FROM tasks.tasks
            INNER JOIN tasks.users
            ON tasks.id_user = users.user_id
            ORDER BY ";
        if (!strcmp($sortElems[0], 'name')) {
          $sql .= " name";
        } elseif (!strcmp($sortElems[0], 'email')) {
          $sql .= " email";
        } elseif (!strcmp($sortElems[0], 'done')) {
          $sql .= " done";
        }
        $sql = strcmp($sortElems[1], 'desc') ? $sql." ASC;" : $sql." DESC;";
        // формирование sql-запроса
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute()) {
            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $tasks;
        }
        return $tasks;
    }

    public function getAllItems3($sort)
    {
        $tasks = $this->getAllItems($sort);
        $i = 0;
        $j = 0;
        $blocksOfTasks = array();
        foreach ($tasks as $task) {
            $blocksOfTasks[$i][$j] = $task;
            $j += 1;
            if ($j == 3) {
                $i += 1;
                $j = 0;
            }
        }
        return $blocksOfTasks;
    }

    public function addItem($params)
    {
        $t_user = new User();
        extract($params);
        $user_id = (int)$t_user->getIdItem(['name' => $name, 'email' => $email]);
        if ($user_id == false){
            $user_id = (int)$t_user->addItem(['name' => $name, 'email' => $email]);
        }
        $sql = "INSERT INTO tasks.tasks
            (text,id_user)
            VALUE
            (:text, :id_user);";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':text' => strip_tags($text, '<i><strong><strike><code><a>'),
            ':id_user' => $user_id
        ]);
        return $this->db->lastInsertId() ? 'сообщение добавлено' : 'сообщение не добавлено';
    }
}
