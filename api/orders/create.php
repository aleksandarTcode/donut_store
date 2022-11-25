<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization,X-Requested-With');

require_once ("../../includes/init.php");

$order = new Order($database);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$order->idB = $data->idB;
$order->item = $data->item;
$order->address = $data->address;
$order->paymentMethod = $data->paymentMethod;
$order->price = $data->price;
$order->status = $data->status;

// Create order
if($order->create_order_forApi()){
    echo json_encode(
        array('message'=>'Order Created')
    );
} else {
    echo json_encode(
        array('message'=>'Order Not Created')
    );
}

?>