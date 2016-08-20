<?php
namespace Kourtis\Database;

use PDO;
use PDOException;

class TheatreDB extends DB implements PostDbInterface
{
    public function getPostFromUrlName($urlName)
    {
        $stmt = $this->conn->prepare("SELECT * FROM kourtis.theatrePosts WHERE urlName LIKE :urlName");
        $stmt->bindParam(':urlName', $urlName);
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();

        return $result;
    }

    public function getPostFromID($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM kourtis.theatrePosts WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();

        return $result;
    }

    public function getAllPosts()
    {
        $stmt = $this->conn->prepare("SELECT * FROM kourtis.theatrePosts ORDER BY showDate DESC;");
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function getNewestPosts($numberOfPosts = 3)
    {
        $stmt = $this->conn->prepare("SELECT * 
      FROM kourtis.theatrePosts 
      ORDER BY kourtis.theatrePosts.showDate DESC
      LIMIT $numberOfPosts");
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function getAllCompetitions()
    {
        $stmt = $this->conn->prepare("
      SELECT * 
      FROM kourtis.theatrePosts 
      WHERE theatreType = 4
      ORDER BY showDate DESC;");
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function getAllCritics()
    {
        $stmt = $this->conn->prepare("
      SELECT * 
      FROM kourtis.theatrePosts 
      WHERE theatreType = 1
      ORDER BY showDate DESC;");
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function getAllHearings()
    {
        $stmt = $this->conn->prepare("
      SELECT * 
      FROM kourtis.theatrePosts 
      WHERE theatreType = 6
      ORDER BY showDate DESC;");
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function getAllNews()
    {
        $stmt = $this->conn->prepare("
      SELECT * 
      FROM kourtis.theatrePosts 
      WHERE theatreType = 5
      ORDER BY showDate DESC;");
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function getAllPlays()
    {
        $stmt = $this->conn->prepare("
      SELECT * 
      FROM kourtis.theatrePosts 
      WHERE theatreType = 3
      ORDER BY showDate DESC;");
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function getAllInterviews()
    {
        $stmt = $this->conn->prepare("
      SELECT * 
      FROM kourtis.theatrePosts 
      WHERE theatreType = 2
      ORDER BY showDate DESC;");
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function addPost($data, $imageName)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO kourtis.theatrePosts (`title`, `summary`, `urlName`, `body`, `nameOfPhoto`, `theatreType`, `showDate`)
    VALUES (:title, :summary, :urlName, :body, :nameOfPhoto, :theatreType, :showDate)");
            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':summary', $data['summary']);
            $stmt->bindParam(':urlName', $data['title']);
            $stmt->bindParam(':body', $data['body']);
            $stmt->bindParam(':nameOfPhoto', $imageName);
            $stmt->bindParam(':theatreType', $data['theatreType']);
            $stmt->bindParam(':showDate', $data['showDate']);
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

    public function getTheatreTypes()
    {
        $stmt = $this->conn->prepare("
      SELECT * 
      FROM kourtis.theatreTypes;");
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }
    
}