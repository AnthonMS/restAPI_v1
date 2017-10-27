<?php
/**
 * Created in PhpStorm.
 * User: Anthon
 * Date: 27-10-2017
 * Time: 17:03
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Product($db);

// set ID property of product to be read
$product->id = isset($_GET['id']) ? $_GET['id'] : die();
$testValue = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of the product
//$product->newReadOne($testValue);
$product->readID();

// create array
$product_arr = array(
    "id" => $product->id,
    "name" => $product->name,
    "description" => $product->description,
    "price" => $product->price,
    "category_id" => $product->category_id,
    "category_name" => $product->category_name,
    "created" => $product->created
);

// Make it json format
print_r(json_encode($product_arr));


?>