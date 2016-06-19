<?php
namespace Kourtis\Database;

use PDO;
use PDOException;

class DB
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

    public function getAllPosts()
    {
        $stmt = $this->conn->prepare("SELECT * FROM kourtis.posts");
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getThreeNewestPosts()
    {
        $stmt = $this->conn->prepare("SELECT * 
      FROM kourtis.posts 
      ORDER BY kourtis.posts.id DESC
      LIMIT 3");
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result;
    }

}