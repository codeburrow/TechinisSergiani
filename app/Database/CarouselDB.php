<?php
namespace Kourtis\Database;

use PDO;
use PDOException;

class CarouselDB extends DB implements PostDbInterface
{
    public function getPost($urlName)
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

    public function getNewestPosts($numberOfPosts = 3)
    {
        $stmt = $this->conn->prepare("SELECT * 
      FROM kourtis.posts 
      ORDER BY kourtis.posts.id DESC
      LIMIT $numberOfPosts");
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }
}