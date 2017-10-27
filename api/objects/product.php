<?php
/**
 * Created in PhpStorm.
 * User: Anthon
 * Date: 27-10-2017
 * Time: 16:29
 */

class Product {
    // Database connection and table name
    private $conn;
    private $table_name = "products";

    // object properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;

    // constructor with $db as database conn
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function newRead() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    function readOne() {
        // query to read single record
        $query = "SELECT
                c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            WHERE
                p.id = ?
            LIMIT
                0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be read
        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->name = $row['name'];
        $this->price = $row['price'];
        $this->description = $row['description'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
        $this->created = $row['created'];
    }

    /*    function newReadOne($issetVal) {
        $query = "SELECT * FROM " . $this->table_name . " p
                  LEFT JOIN categories c
                  ON p.category_id = c.id
                  WHERE p.id='$issetVal'
                  LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be read
        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->price = $row['price'];
        $this->description = $row['description'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
        $this->created = $row['created'];
    }*/
}

?>







































