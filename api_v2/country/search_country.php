<?php
/**
 * Created by PhpStorm.
 * User: Anthon
 * Date: 28-10-2017
 * Time: 00:14
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/country.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$country = new Country($db);

// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

// query products
$stmt = $country->searchCountry($keywords);
$num = $stmt->rowCount();


// check if more than 0 record found
if($num>0){

    // products array
    $products_arr=array();
    $products_arr["countries"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $product_item=array(
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

        array_push($products_arr["countries"], $product_item);
    }

    echo json_encode($products_arr);
}
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
















?>