<?php 
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//include database and object files
include_once '../config/databse.php';
include_once '../objects/product.php';

//instantiate database and product object
$database = new Database();
$db = $database->getConnection();

//initialise object
$product = new Product($db);

//query products from product table
$stmt = $product->read();
$num = $stmt->rowCount();

//check if more than one records are found
if($num > 0){

	//products array
	$products_arr =  array();
	$products_arr["records"] = array();

	//retrieve table contents
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		//extract row
		extract($row);

		$product_item = array(
			"id" => $id,
			"name" => $name,
			"description" => html_entity_decode($description),
			"price" => $price,
			"category_id" => $category_id,
			"category_name" => $category_name
		);

		array_push($products_arr['records'], $product_item);
	}//end of while

	// set response code - 200 OK
	http_response_code(200);

	//show products data in json format
	echo json_encode($products_arr);
}

//no products will be here
?>