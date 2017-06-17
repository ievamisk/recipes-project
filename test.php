<?php

//include_once(dirname(__FILE__)."/dbconnect.php");
//session_start();
//
//$query= "SELECT `first_name` FROM user WHERE `user_id` = '".$_SESSION['user']."' "or die(mysqli_error());
//$result = mysqli_query($connection, $query);
//$result = mysqli_fetch_array($result);
//
//if (isset($_SESSION["user"])) {
//    echo "You're certified! User ID : ".$result["first_name"];
//}
//else { echo "Please login!";
//}

print_r($_GET);

echo $_GET["id"] . "<br>";

echo $_SERVER["QUERY_STRING"] . "<br>";
echo urldecode($_SERVER["QUERY_STRING"]) . "<br>";



?>
