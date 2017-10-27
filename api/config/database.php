<?php
/**
 * Created in PhpStorm.
 * User: Anthon
 * Date: 27-10-2017
 * Time: 16:24
 */

class Database {

    // Specify database credentials
    private $host = "localhost";
    private $db_name = "api_db";
    private $username = "root";
    private $password = "root";
    public $conn;

    // get database connection
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(  "mysql:host=" . $this->host .
                ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception)
        {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

?>