<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate model object
include_once '../objects/model.php';
 
$database = new Database();
$db = $database->getConnection();
 
$model = new Model($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->name) && 
    !empty($data->manufacturer_id)
){
 
    // set model property values
    $model->model_name = $data->name;
    $model->manufacturer_id = $data->manufacturer_id;
    $model->color = null;
    $model->manufacturing_year = null;
    $model->registration_number = null;
    $model->note = null;
    $model->image_1 = null;
    $model->image_2 = null;

    if(!empty($data->color)){
        $model->color = $data->color;
    }
    if(!empty($data->manufacturing_year)){
        $model->manufacturing_year = $data->manufacturing_year;
    }
    if(!empty($data->registration_number)){
        $model->registration_number = $data->registration_number;
    }
    if(!empty($data->note)){
        $model->note = $data->note;
    }
    if(!empty($data->image_1)){
        $model->image_1 = $data->image_1;
    }
    if(!empty($data->image_2)){
        $model->image_2 = $data->image_2;
    }
    
    // create the model
    if($model->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "model was created."));
    }
 
    // if unable to create the manufacturer, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create model."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create model. Data is incomplete."));
}
?>