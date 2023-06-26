<?php


// webhook.php
//
// Use this sample code to handle webhook events in your integration.
//
// 1) Paste this code into a new file (webhook.php)
//
// 2) Install dependencies
//   composer require stripe/stripe-php
//
// 3) Run the server on http://localhost:4242
//   php -S localhost:4242

if($_SESSION['REQUEST_METHOD']==="POST") {

    require_once("includes/init.php");


    // The library needs to be configured with your account's secret key.
    // Ensure the key is kept out of any version control system you might be using.
    $stripe = new \Stripe\StripeClient('sk_test_...');

    // This is your Stripe CLI webhook secret for testing your endpoint locally.
    $endpoint_secret = $_ENV['ENDPOINT_SECRET'];

    $payload = @file_get_contents('php://input');
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
    $event = null;

    try {
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
        );
    } catch (\UnexpectedValueException $e) {
        // Invalid payload
        http_response_code(400);
        exit();
    } catch (\Stripe\Exception\SignatureVerificationException $e) {
        // Invalid signature
        http_response_code(400);
        exit();
    }

    // Handle the event
    switch ($event->type) {
        case 'payment_intent.succeeded':
//            $paymentIntent = $event->data->object;
        // ... handle other event types
        break;


        case 'charge.succeeded':

            $order_amount = $event->data->object->amount;
            $order_currency = $event->data->object->currency;
            $order_transaction = $event->data->object->balance_transaction;
            $order_status = $event->data->object->status;
            $event_stripe_session_id= $event->id;


            try {

                $stmt = $database->conn->prepare("INSERT INTO orders(order_amount,order_currency,order_transaction,order_status,event_stripe_session_id) VALUES(:order_amount,:order_currency,:order_transaction,:order_status,:event_stripe_session_id)");

                $stmt->bindParam(':order_amount', $order_amount);
                $stmt->bindParam(':order_currency', $order_currency);
                $stmt->bindParam(':order_transaction', $order_transaction);
                $stmt->bindParam(':order_status', $order_status);
                $stmt->bindParam(':event_stripe_session_id', $event_stripe_session_id);

                $stmt->execute();

            }catch (Exception $e) {
                echo $e->getMessage();
            }


//            ob_flush();
//            ob_start();
//            var_dump($event->data);
//            file_put_contents('event.txt', ob_get_flush());

            break;

        default:
            echo 'Received unknown event type ' . $event->type;
    }

    http_response_code(200);


}



?>