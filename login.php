<?php
include "dbconnect.php";
session_start();

$email = $_POST['email'];
$pass = $_POST['pass'];

if(!isset($_SESSION["user"])) {
    $sql = "SELECT * FROM user WHERE email ='".$email."' AND password='".$pass."'";
    $result =  mysqli_query($connection,$sql);
    $result = mysqli_fetch_array($result);

    if (!is_null($result["user_id"])) {
        $_SESSION["user"] = $result["user_id"];
        header("Location: user.php");
    }
    else {
//        header("Location: index.php");
        echo "Bad credentials!";
    }
}
else{
    header("location: user.php");
    //echo "Already logged inn!";
}

