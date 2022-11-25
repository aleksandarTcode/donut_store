<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once ("../../includes/init.php");

// Instantiate order object
$order = new Order($database);

$row = $order->get_all_orders();

$num = count($row);

if($num>0){
    $orders_arr = array();
    $orders_arr['data'] = array();

  foreach ($row as $order){
      $order_item = array(
          'id'=>$order->id,
          'item'=>$order->item,
          'address'=>$order->address,
          'payment_method'=>$order->payment_method,
          'status'=>$order->status,
          'price'=>$order->price,
          'date'=>$order->date,
          'name'=>$order->name
      );
      array_push($orders_arr['data'],$order_item);
  }

    // Turn to JSON & output
    echo json_encode($orders_arr);
}else {
    // No Orders
    echo json_encode(
        array('messsage'=>'No Orders Found')
    );
}



//
//print_r($row);






?>