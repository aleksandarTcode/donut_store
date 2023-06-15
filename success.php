<?php
require_once ('includes/header.php');
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

if(isset($_GET['session_id'])){

//    var_dump($_SESSION);

    $stripe_order = new Order($database);

    $stripe_order->change_order_status('unprocessed and paid',$_SESSION['checkout_session_id'],'stripe_session_id');

    unset($_SESSION['checkout_session_id']);

    try {

        $stripe = new \Stripe\StripeClient($_ENV['STRIPE_SK_KEY']);
//        var_dump($_GET['session_id']);
        $stripe_order = $stripe->checkout->sessions->retrieve($_GET['session_id'], []);

    }catch(Exception $e){
        echo $e->getMessage();
    }
}
?>

<div class="container">
    <!--#####################START HERE######################-->

    <!-- JUMBOTRON -->
    <div class="jumbotron text-center">

<!--        --><?php
//            $customer = $stripe->customers->retrieve($stripe_order->customer, []);
//        ?>
        <h1 class="display-4">Thanks for your Order!</h1>
        <h3 class="text-center"><?= $stripe_order->customer_details->name ?></h3>
        <p class="text-center">We will send confirmation to <mark><?=$stripe_order->customer_details->email?></mark></p>
        <hr>

        <br>

        <a href="index.php" class="btn btn-outline-success btn-lg">Back to Order Page</a>
        <a href="logout.php" class="btn btn-outline-danger btn-lg" onclick="return confirm('Are you sure you want to log out?');">LogOut</a>
    </div>

    <br>


</div>






<?php require_once ('includes/footer.php'); ?>
