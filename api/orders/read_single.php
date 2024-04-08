<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once ("../../includes/init.php");

$order = new Order($database);

$order->id = isset($_GET['id']) ? $_GET['id'] : die();

$order->get_single_order();

// Check if the order was successfully fetched
if ($order->item === null) {
    exit(); // Exit the script if the order is not found
}

$order_arr = array(
    'id'=>$order->id,
    'item'=>$order->item,
    'address'=>$order->address,
    'payment_method'=>$order->paymentMethod,
    'status'=>$order->status,
    'price'=>$order->price,
    'date'=>$order->date,
    'name'=>$order->name
);

// Make JSON
echo(json_encode($order_arr));
?>