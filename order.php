<?php
require_once ('includes/header.php');

print_r($_SESSION);

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
                    <td><?php echo $_SESSION['size'].' with '.printAllExtras(); ?></td>
                    <td><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?></td>
                    <td><?php echo $_SESSION['zip'].' '.$_SESSION['address']; ?></td>
                    <td><?php echo $_SESSION['paymentMethod']; ?></td>
                    <td><?php echo "$".sumPrice() ?></td>
                </tr>
                </tbody>
            </table>

            <br>

            <a class="btn btn-primary btn-lg" href="#" role="button">Confirm</a>
        </div>

        <br>


    </div>
    <!-- ./container -->

<?php require_once ('includes/footer.php');?>