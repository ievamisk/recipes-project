<?php

include_once(dirname(__FILE__)."/dbconnect.php");

$type = $_POST["type"];
$value = $_POST["value"];

$msg = "";
$error = false;

if ($type == "" || $value == "" || is_null($type) || is_null($value)) {
    echo "{error: 'true', msg: 'Not valid input!'}";
}

if ($type == "name") {
    if (empty($value)) {
        $error = true;
        $msg = "Please enter your full name.";
    } else if (strlen($value) < 3) {
        $error = true;
        $msg = "Name must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z ]+$/",$value)) {
        $error = true;
        $msg = "Name must contain alphabets and space.";
    }
}
elseif ($type=="email"){
    if ( !filter_var($value,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $msg = "Please enter valid email address.";
    } else {
        $query = "SELECT email FROM user WHERE email='$value'";
        $result = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result);
        if($count!=0){
            $error = true;
            $msg = "Provided Email is already in use.";
        }
    }
}
elseif ($type=="pass"){
    if (empty($value)){
        $error = true;
        $passwordError = "Please enter password.";
    } else if(strlen($value) < 6) {
        $error = true;
        $msg = "Password must have atleast 6 characters.";
    }
}
else {
    $error = true;
}

echo "{error: '".$error."', msg:'".$msg."'}";