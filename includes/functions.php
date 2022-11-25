<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//function text_input_field_check($data,$regex_pattern,$message){
//
//    global ${$data.'Err'};
//    global ${$data.'C'};
//    if (empty($_POST[$data])) {
//        ${$data.'Err'}= "This field is required";
//        $$data = "";
//        ${$data.'C'} = 0;
//    } else {
//        $$data = test_input($_POST[$data]);
//        // check if name only contains letters and whitespace
//        if (!preg_match($regex_pattern, $$data)) {
//            ${$data.'Err'} = $message;
//            ${$data.'C'} = 0;
//        }
//    }
//    $_SESSION[$data] = $$data;
//
//}


function text_input_field_check($data,$regex_pattern,$message){

    if (empty($_POST[$data])) {
        global ${$data.'Err'}; // makes name for error variable, ex. if $input is first_name, it is first_nameErr
        ${$data.'Err'} = "Field is required";
        ${$data.'C'} = 0;
    }  // check regular expression for input
    elseif (!preg_match($regex_pattern, $_POST[$data])) {
        global ${$data.'Err'};
        ${$data.'Err'} = $message;
        ${$data.'C'} = 0;
        $_SESSION[$data] = $_POST[$data]; // makes session for form output when input is wrong
    }
    else {
        global $$data; // // makes name for variable
        $$data = test_input($_POST[$data]);
        $_SESSION[$data] = $$data;
    }
}

function zip_check(){

    global $zipErr;
    global $zipC;
    if (empty($_POST['zip'])) {
        $zipErr = "This field is required";
        $zip = "";
        $zipC= 0;
    } else {
        $zip = test_input($_POST['zip']);
        if((strlen($zip)!=5)){
            $zipErr = "Zip code must be 5 digits long";
            $zipC= 0;
        }else if(is_numeric($zip)!=1){
            $zipErr = "All 5 digits must be numbers";
            $zipC= 0;
        }else if(substr($zip,0,2)!='11'){
            $zipErr = "First 2 digits must be 11";
            $zipC= 0;
        }

    }
    $_SESSION['zip'] = $zip;
}

function size_check(){
    global $sizeErr;
    global $sizeC;
    if (empty($_POST['size'])) {
        $sizeErr = "Choose one size";
        $sizeC= 0;
    } else  $_SESSION['size'] = $_POST['size'];

}

function sumPrice(){
    $size = $_SESSION['size'];
    $priceExtrasArr = ['nutella' => '0.4', 'cherry' => '0.4', 'plazma' => '0.3', 'twix' => '0.3', 'coconut' => '0.3', 'crumbs' => '0.3'];
    $priceSizeArr = ['small' => '1', 'medium' => '1.5', 'large' => '2'];
    $sizePrice = $priceSizeArr[$size];
    $extrasPrice = 0;

    if (is_array($_SESSION['extras'])) {
        $extrasArr = $_SESSION['extras'];
        foreach ($extrasArr as $value) {
            if (array_key_exists($value, $priceExtrasArr)) {
                $extrasPrice += $priceExtrasArr[$value];
            }
        }
    } else $extrasPrice = 0;

    $sum = $sizePrice + $extrasPrice;
    return $sum;
}

function printAllExtras(){
    $allExtras = "";
    if(is_array($_SESSION['extras'])) {
//        $extrasArr = $_SESSION['extras'];
        foreach ($_SESSION['extras'] as $index => $extras) {
            if(count($_SESSION['extras'])==1){
                $allExtras .= $extras;
            }
            else if ($index == count($_SESSION['extras']) - 1) {
                $allExtras .=  " and ".$extras . "";
            } else if($index == count($_SESSION['extras']) - 2) {
                $allExtras .= $extras;
            }
            else {
                $allExtras .= $extras . ", ";
            }
        }
    }
    else $allExtras = "nothing";
    return $allExtras;
}

function set_message($msg){
    if(!empty($msg)){
        $_SESSION['message'] = $msg;
    }else {
        $msg = "";
    }
}


function display_message(){
    if(isset ($_SESSION['message'])){
        echo  $_SESSION['message'];
        unset($_SESSION['message']);
    }
}





?>