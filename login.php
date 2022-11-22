<?php
require_once("includes/header.php");

if(isset($_SESSION['username'])&&$_SESSION['role']=='buyer'){
    header("Location: index.php");
}else if(isset($_SESSION['username'])&&$_SESSION['role']=='worker') {
    header("Location: orders_list.php");}

//$_SESSION['username_temp'] = $_SESSION['password_temp'] = "";
//print_r($_SESSION);
?>

<?php
require_once("includes/login_form.php");

?>


<?php

//unset($_SESSION['username']);
session_unset();
$user = new User($database);

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $user->login_user();

}


?>

<?php
require_once("includes/footer.php");
?>