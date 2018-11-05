<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/model.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare model object
$model = new Model($db);
 
// get id of model to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of model to be edited
$model->id = $data->id;
 
// set model property values
$model->is_sold = $data->is_sold;
 
// update the model
if($model->sell()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "model was updated."));
}
 
// if unable to update the model, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update model."));
}
?>