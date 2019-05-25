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
?>