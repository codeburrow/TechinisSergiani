<?php
namespace Kourtis\Database;

use PDO;
use PDOException;

class UserDB extends DB
{
    public function getUser($username, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM kourtis.users WHERE username LIKE :username AND password LIKE :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }
}