<?php
require_once ('includes/header.php');
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

unset($_SESSION['visits']); //remove this after testing

unset($_SESSION['checkout_session_id']);

//unset($_SESSION["'checkout_session_id'"]);

$item = $_SESSION['item'] = $_SESSION['size'].' with '.printAllExtras();
$buyer = $_SESSION['firstname'].' '.$_SESSION['lastname'];
$address = $_SESSION['zip'].' '.$_SESSION['address'];
$payment_method = $_SESSION['paymentMethod'];
$price = $_SESSION['price'] = sumPrice();

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
    $order->new_order_form_stripe();
}

//echo $_SESSION['checkout_session_id'];
//var_dump($_SESSION);

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



        <a class="btn btn-primary btn-lg" href="#" id="btn" role="button">Checkout</a>

        <a href="logout.php" class="btn btn-outline-danger btn-lg" onclick="return confirm('Are you sure you want to log out?');">LogOut</a>
    </div>

    <br>


</div>
<!-- ./container -->

<?php require_once ('includes/footer.php'); ?>

<script src="https://js.stripe.com/v3"></script>
<script>
    let stripe = Stripe('<?= $_ENV['STRIPE_PUB_KEY'] ?>');

    $('#btn').on('click', function(e){
        e.preventDefault();

        // alert('hello from Stripe');
        stripe.redirectToCheckout({sessionId: `<?= isset($_SESSION['checkout_session_id']) ? $_SESSION['checkout_session_id'] : null ?>`
        })
    });

</script>


