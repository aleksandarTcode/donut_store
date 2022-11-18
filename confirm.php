<?php
require_once ('includes/header.php');
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}
//print_r($_SESSION);

$order = new Order($database);

//check is confirm page for order refreshed, if is, logout
if (!isset($_SESSION["visits"]))
    $_SESSION["visits"] = 0;
$_SESSION["visits"] = $_SESSION["visits"] + 1;

if ($_SESSION["visits"] > 1)
{
    header("Location: logout.php");
}
else
{
    $order->new_order();
}





?>

    <div class="container">
        <!--#####################START HERE######################-->

        <!-- JUMBOTRON -->
        <div class="jumbotron text-center">
            <h1 class="display-4">Thanks for your Order!</h1>
            <hr>



            <br>

            <a href="index.php" class="btn btn-outline-success btn-lg">Back to Order Page</a>
            <a href="logout.php" class="btn btn-outline-danger btn-lg" onclick="return confirm('Are you sure you want to log out?');">LogOut</a>
        </div>

        <br>


    </div>
    <!-- ./container -->

<?php require_once ('includes/footer.php');?>