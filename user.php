<?php

include_once __DIR__."/dbconnect.php";

session_start();

$is_auth = false;
$user = null;

if (isset($_SESSION["user"])) {
    $query = "SELECT * FROM user WHERE `user_id` = ".$_SESSION['user'];
    $result = mysqli_query($connection, $query);
    $result = mysqli_fetch_array($result);

    if (!is_null($result)) {
        $is_auth = true;
        $user = $result;
    }
}
else {
    echo "Nope";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"/>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include(dirname(__FILE__)."/navbar.php"); ?>
<div class="row">
    <?php
        if ($is_auth) {
    ?>
        <div class="row">
            <h1>Vartotojas, <?php echo ucfirst($user["first_name"]) . " " . ucfirst($user["last_name"]); ?></h1>
        </div>
    <?php
        }
    ?>
    <form class="col s12" action="search.php" method="post">
        <!-- ???? -->
    </form>
</div>
<div class="row">
    <div class="col s6">
        <form action="logout.php">
            <button class="btn waves-effect waves-light" type="submit" name="btn_login">Atsijungti
            </button>
        </form>
    </div>
</div>
<!--<div class="row">-->
<!--    <div class="col s6">-->
<!--        <form action="product.php">-->
<!--            <button class="btn waves-effect waves-light" type="submit" name="btn_login">Add product-->
<!--            </button>-->
<!--        </form>-->
<!--    </div>-->
<!--</div>-->


</body>
</html>