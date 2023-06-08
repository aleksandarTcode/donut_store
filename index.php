<?php
require_once ('includes/header.php');
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

?>


<?php
$firstname = $lastname = $address = $zip = $payment = "";
$firstnameErr = $lastnameErr = $addressErr = $zipErr = $sizeErr = "";
$firstnameC = $lastnameC = $addressC = $zipC = $sizeC = 1;
$_SESSION['address'] = $_SESSION['zip'] = $_SESSION['paymentMethod'] = $_SESSION['size'] = $_SESSION['extras'] = '';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    text_input_field_check("firstname","/^[a-zA-Z-' ]*$/","Only letters and white space allowed");
    text_input_field_check("lastname","/^[a-zA-Z-' ]*$/","Only letters and white space allowed");
    text_input_field_check("address","/^[a-zA-Z0-9 ]*$/","Only letters, numbers and white space allowed");
    zip_check();
    size_check();

    $_SESSION['paymentMethod'] = $_POST['paymentMethod'];

    if(isset($_POST['extras'])){
        $_SESSION['extras'] = $_POST['extras'];
    }


    if($firstnameC && $lastnameC && $addressC && $zipC ==1){
            header("Location: make_order.php");
    }


}


?>
<div class="container w-50" id="container">
<!--    --><?php //  print_r($_SESSION); ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">


        <div class="row">

            <h1 class="display-4 text-center mb-3 mt-1 col-12">Order Now!</h1>


            <div class="col-3 offset-3">
                <p class="text-center">Size</p>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="size" id="small" value="small" <?php if($_SESSION['size']=='small'){echo "checked";} ?>>
                    <label class="form-check-label" for="small">
                        Small ($1)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="size" id="medium" value="medium" <?php if($_SESSION['size']=='medium'){echo "checked";} ?>>
                    <label class="form-check-label" for="medium">
                        Medium ($1.5)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="size" id="large" value="large" <?php if($_SESSION['size']=='large'){echo "checked";} ?>>
                    <label class="form-check-label" for="large">
                        Large ($1.8)
                    </label>
                </div>

                <div class="alert alert-danger mt-1 p-1" id="alert1" <?php if(empty($sizeErr)){echo "hidden";} ?> >
                    <?php echo $sizeErr;?>
                </div>

            </div>

            <div class="col-3">
                <p class="text-center">Extras</p>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="extras[]" value="nutella" id="nutella" disabled>
                    <label class="form-check-label" for=nutella>
                        Nutella ($0.4)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="extras[]" value="cherry" id="cherry" disabled>
                    <label class="form-check-label" for="cherry">
                        Cherry ($0.4)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="extras[]" value="plazma" id="plazma" disabled>
                    <label class="form-check-label" for="plazma">
                        Plazma ($0.3)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="extras[]" value="coconut" id="coconut" disabled>
                    <label class="form-check-label" for="coconut">
                        Coconut ($0.3)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="extras[]" value="crumbs" id="crumbs" disabled>
                    <label class="form-check-label" for="crumbs">
                        Chocolate Crumbs ($0.3)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="extras[]" value="twix" id="twix" disabled>
                    <label class="form-check-label" for="twix">
                        Twix ($0.3)
                    </label>
                </div>

            </div>

            <hr class="col-12" />


            <div class="col-6">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input class="form-control" type="text" name="firstname" id="firstname" placeholder="Enter first name" value="<?php echo $_SESSION['firstname'] ?>">
                    <div class="alert alert-danger mt-1 p-1" id="alert1" <?php if(empty($firstnameErr)){echo "hidden";} ?> >
                        <?php echo $firstnameErr;?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input class="form-control" type="text" name="address" id="address" placeholder="Enter address" value="<?php echo $_SESSION['address'] ?>">
                    <div class="alert alert-danger mt-1 p-1" id="alert1" <?php if(empty($addressErr)){echo "hidden";} ?> >
                        <?php echo $addressErr;?>
                    </div>
                </div>
            </div>


            <div class="col-6">
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Enter last name" value="<?php echo $_SESSION['lastname'] ?>">
                    <div class="alert alert-danger mt-1 p-1" id="alert1" <?php if(empty($lastnameErr)){echo "hidden";} ?> >
                        <?php echo $lastnameErr;?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="zip">ZipCode</label>
                    <input class="form-control" type="text" name="zip" id="zip" placeholder="Enter Zip" value="<?php echo $_SESSION['zip'] ?>">
                    <div class="alert alert-danger mt-1 p-1" id="alert1" <?php if(empty($zipErr)){echo "hidden";} ?> >
                        <?php echo $zipErr;?>
                    </div>
                </div>

            </div>

                <div class="form-group col-4 offset-md-4">
                    <label for="paymentMethod">Payment method</label>
                    <select class="form-control" name="paymentMethod" id="payment">
                        <option value="cache">Cache</option>
                        <option value="stripe">Stripe</option>
                    </select>
                </div>



            <button class="btn btn-primary mb-4 col-9" id="submit" name="submit" type="submit" onclick="return confirm('Have you finished with your order?');">Submit</button>
            <a href="logout.php" class="btn btn-outline-danger mb-4 col-3" name="register" onclick="return confirm('Are you sure you want to log out?');">LogOut</a>



        </div>

    </form>

    </div>


<?php require_once ("includes/footer.php"); ?>



