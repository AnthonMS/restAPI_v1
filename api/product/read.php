<?php
/**
 * Created in PhpStorm.
 * User: Anthon
 * Date: 27-10-2017
 * Time: 16:31
 */

// requires headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';

// Instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// Initialize object
$product = new Product($db);

// query products
$stmt = $product->newRead();
$num = $stmt->rowCount();

// check if more than 0 record are found
if ($num > 0)
{
    // Product array
    $product_arr = array();
    $product_arr["records"] = array();

    // Retrieve table
    // fetch() is faster than fetch_all()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $product_item = array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            "price" => $price,
            "category_id" => $category_id,
            "category_name" => $category_name,
            "created" => $created
        );

        array_push($product_arr["records"], $product_item);
    }

    echo json_encode($product_arr);
}
else {
    echo json_encode(
        array("message" => "No products found.")
    );
}

?>