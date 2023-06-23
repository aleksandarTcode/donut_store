<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization,X-Requested-With');

require_once ("../../includes/init.php");

$order = new Order($database);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

if(isset($_GET['id'])) {

    $order->id = $_GET['id'];

    $order->idB = $data->idB;
    $order->item = $data->item;
    $order->address = $data->address;
    $order->paymentMethod = $data->paymentMethod;
    $order->price = $data->price;
    $order->status = $data->status;

// Create order
    if ($order->update_order_forApi()) {
        echo json_encode(
            array('message' => 'Order Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Order Not Updated')
        );
    }

} else echo json_encode(
    array('message' => 'id in url is not set')
);

?>