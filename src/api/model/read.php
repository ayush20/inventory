<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/model.php';
 
// instantiate database and model object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$model = new Model($db);

// set ID property of record to read
$model->id = isset($_GET['id']) ? $_GET['id'] : die();

// query products
$model->read();
if($model->model_name != null){
 
    $model_item=array(
        "id" => $model->id,
        "model_name" => $model->model_name,
        "manufacturer_name" => $model->manufacturer_name,
        "color" => $model->color,
        "manufacturing_year" => $model->manufacturing_year,
        "registration_number" => $model->registration_number,
        "note" => $model->note,
        "image_1" => $model->image_1,
        "image_2" => $model->image_2
    );

    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($model_item);
} else{

    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>