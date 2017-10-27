<?php
/**
 * Created by PhpStorm.
 * User: Anthon
 * Date: 27-10-2017
 * Time: 23:13
 */

class country
{
    // Database connection and table name
    private $conn;
    private $table_name = "country";

    // object properties
    public $code; // country code
    public $name; // country name
    public $continent;
    public $region;
    public $surfaceArea;
    public $indepYear;
    public $population;
    public $lifeExpectancy;
    public $gnp;
    public $gnpOld;
    public $localName;
    public $governmentForm;
    public $headOfState;
    public $capital; // id of city
    public $code2;

    // constructor with $db as database conn
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read all the countries in the database
    function read()
    {
        // query all data in country and get the appropriate city for the Capital with the ID
        $query = "SELECT ci.Name as CapitalName, 
                    co.Code, co.Name, co.Continent, co.Region, co.SurfaceArea, co.IndepYear, co.Population, co.LifeExpectancy, co.GNP,  co.GNPOld, co.LocalName, co.GovernmentForm, co.HeadOfState, co.Capital, co.Code2 
            FROM
                " . $this->table_name . " co
                LEFT JOIN
                    city ci
                        ON co.Capital = ci.ID
            ORDER BY
                co.Name";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // function for getting specific country
    function readCountryName()
    {
        // query to read single record
        $query = "SELECT ci.Name as CapitalName, 
                    co.Code, co.Name, co.Continent, co.Region, co.SurfaceArea, co.IndepYear, co.Population, co.LifeExpectancy, co.GNP,  co.GNPOld, co.LocalName, co.GovernmentForm, co.HeadOfState, co.Capital, co.Code2 
            FROM
                " . $this->table_name . " co
                LEFT JOIN
                    city ci
                        ON co.Capital = ci.ID
            WHERE
                co.Name = ?
            LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be read
        $stmt->bindParam(1, $this->name);

        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->code = $row['Code'];
        $this->name = $row['Name'];
        $this->continent = $row['Continent'];
        $this->region = $row['Region'];
        $this->surfaceArea = $row['SurfaceArea'];
        $this->indepYear = $row['IndepYear'];
        $this->population = $row['Population'];
        $this->lifeExpectancy = $row['LifeExpectancy'];
        $this->gnp = $row['GNP'];
        $this->gnpOld = $row['GNPOld'];
        $this->localName = $row['LocalName'];
        $this->governmentForm = $row['GovernmentForm'];
        $this->headOfState = $row['HeadOfState'];
        $this->capital = $row['Capital'];
        $this->code2 = $row['Code2'];
    }

    function searchCountry($keywords)
    {
        // query to read single record
        $query = "SELECT ci.Name as CapitalName, 
                    co.Code, co.Name, co.Continent, co.Region, co.SurfaceArea, co.IndepYear, co.Population, co.LifeExpectancy, co.GNP,  co.GNPOld, co.LocalName, co.GovernmentForm, co.HeadOfState, co.Capital, co.Code2 
            FROM
                " . $this->table_name . " co
                LEFT JOIN
                    city ci
                        ON co.Capital = ci.ID
            WHERE
                co.Name LIKE ? OR co.Code LIKE ? OR co.Continent LIKE ? OR co.LocalName LIKE ? OR co.Code2 LIKE ? 
            ORDER BY
                co.Name";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
        $stmt->bindParam(4, $keywords);
        $stmt->bindParam(5, $keywords);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}

?>