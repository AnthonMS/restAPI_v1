<?php
/**
 * Created by PhpStorm.
 * User: Anthon
 * Date: 28-10-2017
 * Time: 00:08
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/country.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$country = new Country($db);

// set ID property of product to be read
$country->name = isset($_GET['name']) ? $_GET['name'] : die();

// read the details of the product
$country->readCountryName();

// create array
$country_arr = array(
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

// Make it json format
print_r(json_encode($product_arr));


?>