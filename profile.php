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

$get_recipe_sql = "SELECT recipe_id FROM recipe
                  WHERE user_id =" .$_SESSION['user'];
$get_recipe_query = mysqli_query($connection, $get_recipe_sql);
//$get_recipe_result = mysqli_fetch_array($get_recipe_query);
$recipe_size = mysqli_num_rows($get_recipe_query);

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
<?php include(dirname(__FILE__)."/navbar.php");?>
<div class="container center-align">
    <h3>Profilis: <?php echo ucfirst($user["first_name"]) . " " . ucfirst($user["last_name"]); ?></h3>
    <h5>Mano receptai</h5>
    <div class="row">
        <?php

        while($row = mysqli_fetch_array($get_recipe_query)) {
            $name_sql ="SELECT * FROM recipe
                        WHERE recipe_id =" . $row["recipe_id"];
            $name_query = mysqli_query($connection, $name_sql);
            $name_result = mysqli_fetch_array($name_query);

            $type_sql ="SELECT type.name FROM type
                        INNER JOIN recipe ON recipe.type_id = type.type_id and recipe.recipe_id =" . $row["recipe_id"];
            $type_query = mysqli_query($connection, $type_sql);
            $type_result = mysqli_fetch_array($type_query);

            $rating_sql ="SELECT sum(rating) / count(*) AS rating FROM rate
                          WHERE recipe_id =" . $row["recipe_id"];
            $rating_query = mysqli_query($connection, $rating_sql);
            $rating_result = mysqli_fetch_array($rating_query);

//            $pin_sql = "INSERT INTO pinned_recipes(user_id, recipe_id)
//            VALUES ('$user["user_id"]', $row["recipe_id"])";
            ?>
            <div class="col s12 m4">
                <div id="<?php echo $row["recipe_id"]; ?>" class="card">
                    <div class="card-image">
                        <a href="<?php echo "/YayRecipes/recipe.php?id=" . $row["recipe_id"]; ?>"><img src="<?php echo $name_result["picture"];?>"></a>
                        <span class="card-title"><?php echo $name_result["name"];?></span>
                    </div>
                    <div class="card-content">
                        <div class="chip">
                            <i class="material-icons">timelapse</i>
                            <?php echo $name_result["cooking_time"];?> min.
                        </div>
                        <div class="chip">
                            <i class="material-icons">room_service</i>
                            <?php echo $name_result["portion"];?>
                        </div>
                        <div class="chip">
                            <i class="material-icons">grade</i>
                            <?php echo $rating_result["rating"];?>
                        </div>
                        <div class="chip">
                            <i class="material-icons">local_florist</i>
                            <?php echo ucfirst($type_result["name"]);?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <a href="product.php"><input class="btn waves-effect waves-light" value="Pridėti receptą" type="submit" name="submit"></a>
</div>

<script>

</script>
</body>
</html>