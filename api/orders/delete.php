<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization,X-Requested-With');

require_once ("../../includes/init.php");

$order = new Order($database);

$data = json_decode(file_get_contents("php://input"));

$order->id = $data->id;

if($order->delete_order($order->id)){
    echo json_encode(
        array('message'=>'Order Deleted')
    );
} else {
    echo json_encode(
        array('message'=>'Order Not Deleted')
    );
}



?>