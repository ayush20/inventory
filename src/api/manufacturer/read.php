<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/manufacturer.php';
 
// instantiate database and manufacturer object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$manufacturer = new Manufacturer($db);
 
// query products
$stmt = $manufacturer->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $manufacturer_arr=array();
    $manufacturer_arr["records"]=array();
 
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $manufacturer_item=array(
            "id" => $id,
            "name" => $name,
        );
 
        array_push($manufacturer_arr["records"], $manufacturer_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($manufacturer_arr);
} else{

    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>