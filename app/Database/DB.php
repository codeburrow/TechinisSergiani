<?php
namespace Kourtis\Database;

use PDO;
use PDOException;

abstract class DB
{
    protected $servername;
    protected $port;
    protected $dbname;
    protected $username;
    protected $password;
    protected $conn;

    /**
     * DB constructor. By default connect to Homestead virtual DB server and to the 'kourtis' database schema.
     * @param string $servername
     * @param string $port
     * @param string $dbname
     * @param string $username
     * @param string $password
     */
    public function __construct($servername = "127.0.0.1", $port = "33060", $dbname = "kourtis", $username = "homestead", $password = "secret")
    {
        $this->servername = $servername;
        $this->port = $port;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;

        $this->connect();
    }

    public function connect()
    {
        try {
            $conn = new PDO("mysql:host=$this->servername;port:$this->port;dbname=$this->servername", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $conn;
//            echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public abstract function getPost($urlName);

    public abstract function getAllPosts();

    public abstract function getPostFromID($id);



    //ToDo: Implement in Child Classes
    public function editItems($data)
    {
        if( isset($data['items']) ) {

            foreach ($data['items'] as $itemID) {

                $query_selectItems = "SELECT * FROM fab.items WHERE id=:id;";

                try {
                    $db = $this->conn;
                    $stmt_editItems= $db->prepare($query_selectItems);
                    $stmt_editItems->bindParam(':id', $itemID);
                    $result_items = $stmt_editItems->execute();
                } catch (PDOException $ex) {
                    // For testing, you could use a die and message.
                    //die("Failed to run query: " . $ex->getMessage());

                    //or just use this use this one to product JSON data:
                    $response["success"] = 0;
                    $response["message"] = "Database Error. Please Try Again!";

                    return $response;
                }

                //fetching all the rows from the query
                $dbItems = $stmt_editItems->fetch();

                if (!empty($dbItems)) {

                    $urlName = $data['urlName'][$itemID];
                    $title = $data['title'][$itemID];
                    $subtitle = $data['subtitle'][$itemID];
                    $tags = $data['tags'][$itemID];
                    $description = $data['description'][$itemID];

                    try {
                        $update_item = $this->conn->prepare( "UPDATE fab.items SET urlName=:urlName, title=:title, subtitle=:subtitle, tags=:tags, description=:description WHERE id=:id;" );
                        $update_item->bindParam(':id', $itemID);
                        $update_item->bindParam(':urlName', $urlName);
                        $update_item->bindParam(':title', $title);
                        $update_item->bindParam(':subtitle', $subtitle);
                        $update_item->bindParam(':tags', $tags);
                        $update_item->bindParam(':description', $description);
                        $result_editItem = $update_item->execute();
                    } catch (PDOException $ex) {
                        // For testing, you could use a die and message.
                        //die("Failed to run query: " . $ex->getMessage());

                        //or just use this use this one to product JSON data:
                        $response["success"] = 0;
                        $response["message"] = "Database Error 2. Please Try Again!";

                        return $response;
                    }

                    if ($result_editItem) {
                        $response["success"] = 1;
                        $response["message"] = "Item(s) Successfully Edited ";
                    } else {
                        $response["success"] = 0;
                        $response["message"] = "Item(s) Could Not Be Edited ";
                    }

                } else {
                    // no routes found
                    $response["success"] = 0;
                    $response["message"] = "Error. No item with ID $itemID was found.";

                    return $response;
                }
            }

            return $response;
        } else {
            $response["success"] = 2;
            $response["message"] = "Error. You did NOT select any items!";

            return $response;
        }
    }

    public function getCarouselPosts()
    {
        $stmt = $this->conn->prepare("SELECT * FROM kourtis.posts WHERE kourtis.posts.inCarousel = 1");
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