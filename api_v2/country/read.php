<?php
/**
 * Created by PhpStorm.
 * User: Anthon
 * Date: 27-10-2017
 * Time: 23:40
 */

// requires headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include database and object files
include_once '../config/database.php';
include_once '../objects/country.php';

// Instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// Initialize object
$country = new Country($db);

// query countries
$stmt = $country->read();
$num = $stmt->rowCount();

// check if more than 0 record are found
if ($num > 0)
{
    // Country array
    $country_arr = array();
    $country_arr["countries"] = array();

    // Retrieve table
    // fetch() is faster than fetch_all()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $country_item = array(
            "code" => $Code,
            "name" => $Name,
            "continent" => $Continent,
            "region" => $Region,
            "surfaceArea" => $SurfaceArea,
            "indepYear" => $IndepYear,
            "population" => $Population,
            "lifeExpectancy" => $LifeExpectancy,
            "gnp" => $GNP,
            "gnpOld" => $GNPOld,
            "localName" => $LocalName,
            "governmentForm" => $GovernmentForm,
            "headOfState" => $HeadOfState,
            "capital" => $CapitalName,
            "code2" => $Code2
        );

        array_push($country_arr["countries"], $country_item);
    }
    echo json_encode($country_arr);
}
else {
    echo json_encode(
        array("message" => "No countries found.")
    );
}







?>
