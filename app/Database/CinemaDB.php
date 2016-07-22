<?php
namespace Kourtis\Database;

use PDO;
use PDOException;

class CinemaDB extends DB implements PostDbInterface
{
    public function getPostFromUrlName($urlName)
    {
        $stmt = $this->conn->prepare("SELECT * FROM kourtis.cinemaPosts WHERE urlName LIKE :urlName");
        $stmt->bindParam(':urlName', $urlName);
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function getPostFromID($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM kourtis.cinemaPosts WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();

        return $result;
    }

    public function getAllPosts()
    {
        $stmt = $this->conn->prepare("SELECT * FROM kourtis.cinemaPosts");
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function addPost($data, $imageName)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO kourtis.cinemaPosts (`title`, `summary`, `urlName`, `body`, `nameOfPhoto`)
    VALUES (:title, :summary, :urlName, :body, :nameOfPhoto)");
            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':summary', $data['summary']);
            $stmt->bindParam(':urlName', $data['title']);
            $stmt->bindParam(':body', $data['body']);
            $stmt->bindParam(':nameOfPhoto', $imageName);
            $result = $stmt->execute();

            if ($result == true)
                $result = "";
            else
                $result = "Error inserting into database.";

            return $result;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}