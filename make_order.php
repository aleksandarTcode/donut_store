<?php
require_once ('includes/header.php');
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

//unset visits so buyer can make order again after previous order
unset($_SESSION["visits"]);

$item = $_SESSION['item'] = $_SESSION['size'].' with '.printAllExtras();
$buyer = $_SESSION['firstname'].' '.$_SESSION['lastname'];
$address = $_SESSION['zip'].' '.$_SESSION['address'];
$payment_method = $_SESSION['paymentMethod'];
$price = $_SESSION['price'] = sumPrice();




//print_r($_SESSION);


?>

    <div class="container">
        <!--#####################START HERE######################-->

        <!-- JUMBOTRON -->
        <div class="jumbotron text-center">
            <h1 class="display-4">Your Order!</h1>
            <hr>

            <!-- TABLE -->
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Buyer</th>
                    <th>Address</th>
                    <th>Payment Method</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td><?php echo $item; ?></td>
                    <td><?php echo $buyer; ?></td>
                    <td><?php echo $address; ?></td>
                    <td><?php echo $payment_method; ?></td>
                    <td><?php echo "$".$price ?></td>
                </tr>
                </tbody>
            </table>

            <br>



            <a class="btn btn-primary btn-lg" href="confirm.php" role="button">Confirm</a>

            <a href="logout.php" class="btn btn-outline-danger btn-lg" onclick="return confirm('Are you sure you want to log out?');">LogOut</a>
        </div>

        <br>


    </div>
    <!-- ./container -->

<?php require_once ('includes/footer.php'); ?>

