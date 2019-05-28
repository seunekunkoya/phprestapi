<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';

//get database connection
$database = new Database();
$db = $database->getConnection();

//prepare product object
$product = new Product($db);

//set id of product to read from
$product->id = isset($_GET['id'])? $_GET['id'] : die();

//read details of product to be edited
$product->readOne();

if($product->name!=null){
	//create array
	$product_arr = array(
		"id" => $product->id,
		"name" => $product->name,
		"description" => $product->description,
		"price" => $product->price,
		"category_id" => $product->category_id,
		"category_name" => $product->category_name
	);

	//set response code
	http_response_code(200);

	//make it json format
	echo json_encode($product_arr);
}
else{
	//set response code 404 not found
	http_response_code(404);

	//tell the user product not found or existx
	echo json_encode(array("message" => "product does not exist."));
}