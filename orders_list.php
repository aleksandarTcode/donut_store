<?php
require_once ('includes/header.php');
if($_SESSION['role']!=='worker'){
    header("Location: logout.php");
}

$orders = new Order($database);

if(isset($_GET['page'])){
    $_SESSION['page'] = $_GET['page'];
}

// to stay on the same page when change order status
if(isset($_GET['approve_id'])){
    $orders->change_order_status('approved',$_GET['approve_id']);
    header("Location: orders_list.php?page={$_SESSION['page']}");
}else if(isset($_GET['deny_id'])){
    $orders->change_order_status('denied',$_GET['deny_id']);
    header("Location: orders_list.php?page={$_SESSION['page']}");
}else if(isset($_GET['delete_id'])){
    $orders->delete_order($_GET['delete_id']);
    header("Location: orders_list.php?page={$_SESSION['page']}");
}
?>
<div class="container">
    <!--#####################START HERE######################-->

    <!-- JUMBOTRON -->
    <div class="jumbotron text-center">
        <h1 class="display-4">All Orders!</h1>
        <hr>
        <br>

        <table class="table">
            <thead>
            <tr>
                <th>Item</th>
                <th>Name</th>
                <th>Address</th>
                <th>Payment Method</th>
                <th>Date</th>
                <th>Price($)</th>
                <th>Status</th>
                <th>Change Status</th>
            </tr>
            </thead>
            <tbody>

                    <tr>
                        <?php $orders->get_all_with_pagination(); ?>

                    </tr>

            </tbody>
        </table>

        <br>

        <a href="logout.php" class="btn btn-outline-danger btn-lg" onclick="return confirm('Are you sure you want to log out?');">LogOut</a>
    </div>

    <br>


</div>
<!-- ./container -->

<?php require_once ('includes/footer.php');?>

