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
 
// query products
$stmt = $model->readAll();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $model_arr=array();
    $model_arr["records"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $model_item=array(
            "id" => $id,
            "model_name" => $model_name,
            "manufacturer_name" => $manufacturer_name
        );
 
        array_push($model_arr["records"], $model_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($model_arr);
} else{

    http_response_code(200);
 
    // tell the user no products found
    echo json_encode(
        array("records" => array())
    );
}
?>