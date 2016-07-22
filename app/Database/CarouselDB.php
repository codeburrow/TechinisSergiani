<?php
namespace Kourtis\Database;

use PDO;
use PDOException;

class CarouselDB extends DB
{
    public function getCarouselGallery()
    {
        $stmt = $this->conn->prepare("SELECT * FROM kourtis.carouselPosts WHERE included = 0");
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function getCarouselImages()
    {
        $stmt = $this->conn->prepare("SELECT * FROM kourtis.carouselPosts WHERE included = 1 ORDER BY POSITION ASC ");
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function includeInCarousel($id, $position)
    {
        $stmt = $this->conn->prepare("update kourtis.carouselPosts set included = ?, POSITION = ? WHERE id = ? ");

        try {
            $stmt->bindValue(1, "1");
            $stmt->bindValue(2, $position);
            $stmt->bindValue(3, $id);
            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function notIncludeInCarousel($id)
    {
        $stmt = $this->conn->prepare("update kourtis.carouselPosts set included = ?, POSITION = ? WHERE id = ? ");

        try {
            $stmt->bindValue(1, "0");
            $stmt->bindValue(2, null);
            $stmt->bindValue(3, $id);
            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function addCarouselImage($data, $imageName)
    {
        if (isset($data['include'])) {
            $included = $data['include'];
        } else {
            $included = 0;
        }

        if (isset($data['description']) && !empty($data['description'])) {
            $description = $data['description'];
        } else {
            $description = null;
        }

        if (isset($data['url']) && !empty($data['url'])) {
            $url = $data['url'];
        } else {
            $url = null;
        }

        try {
            $stmt = $this->conn->prepare("INSERT INTO kourtis.carouselPosts (`name`, `included`, `position`,  `description`, `url`)
    VALUES (:name, :included, :position, :description, :url)");
            $stmt->bindValue(':name', $imageName);
            $stmt->bindValue(':included', $included);
            $stmt->bindValue(':position', null);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':url', $url);
            $result = $stmt->execute();

            if ($result == true) {
                $result = "";
            } else {
                $result = "Error inserting image into carousel database.";
            }
            
            return $result;
            
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function deleteFromCarousel($id)
    {
        $stmt = $this->conn->prepare("delete from kourtis.carouselPosts WHERE id = ? ");

        try {
            $stmt->bindValue(1, $id);
            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
        }
    }

}