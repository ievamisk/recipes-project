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
            <?php
                $recipe_id = $_GET["id"];

                $name_sql ="SELECT * FROM recipe
                            WHERE recipe_id = $recipe_id";
                $name_query = mysqli_query($connection, $name_sql);
                $name_result = mysqli_fetch_array($name_query);

                $type_sql ="SELECT type.name FROM type 
                            INNER JOIN recipe ON recipe.type_id = type.type_id and recipe.recipe_id = $recipe_id";
                $type_query = mysqli_query($connection, $type_sql);
                $type_result = mysqli_fetch_array($type_query);

                $rating_sql ="SELECT sum(rating) / count(*) AS rating FROM rate 
                              WHERE recipe_id = $recipe_id";
                $rating_query = mysqli_query($connection, $rating_sql);
                $rating_result = mysqli_fetch_array($rating_query);

                $ingredients_sql ="SELECT ingredients.name, recipe_ingredients.amount, recipe_ingredients.measurment_unit  FROM ingredients 
                                  INNER JOIN recipe_ingredients ON recipe_ingredients.ingredients_id = ingredients.ingredients_id 
                                  AND recipe_ingredients.recipe_id = $recipe_id";
                $ingredients_query = mysqli_query($connection, $ingredients_sql);
                $ingredients_result = mysqli_fetch_array($ingredients_query);

                $description_sql = "SELECT step.number, step.description FROM step
                                    INNER JOIN recipe ON recipe.recipe_id = step.recipe_id AND recipe.recipe_id = $recipe_id";
                $description_query = mysqli_query($connection, $description_sql);
                $description_result = mysqli_fetch_array($description_query);


            ?>
            <h3><?php echo $name_result["name"];?></h3>
            <div class="row center-align">
                <div class="col s12">
                <div id="<?php echo $recipe_id ?>" class="card">

                    <div class="card-image">
                        <img class="materialboxed" width="600" src="<?php echo $name_result["picture"]?>">

                        <?php
                        if($is_auth) {
                            $get_pinned_recipes_sql = "SELECT recipe_id, user_id FROM pinned_recipes
                                            WHERE user_id=" . $_SESSION['user'] . " AND recipe_id = " . $recipe_id;
                            $get_pinned_recipes_query = mysqli_query($connection, $get_pinned_recipes_sql);

                            if (mysqli_num_rows($get_pinned_recipes_query) != 0) { ?>
                                <a id="" class="btn-floating waves-effect halfway-fab waves-light red fav"><i
                                            class="material-icons">favorite</i></a>
                                <?php
                            }
                            else { ?>
                                <a id="" class="btn-floating waves-effect halfway-fab waves-light red fav"><i
                                            class="material-icons">favorite_border</i></a>
                                <?php
                            }
                        }
                        ?>

                    </div>
                    <div class="card-content">

                <div class="section">
                    <div class="center-align">
                        <div class="chip">
                            <i class="material-icons">timelapse</i>
                            <?php echo $name_result["cooking_time"]?> min.
                        </div>
                        <div class="chip">
                            <i class="material-icons">room_service</i>
                            <?php echo $name_result["portion"]?>
                        </div>
                        <div class="chip">
                            <i class="material-icons">grade</i>
                            <?php echo $rating_result["rating"]?>
                        </div>
                        <div class="chip">
                            <i class="material-icons">local_florist</i>
                            <?php echo ucfirst($type_result["name"])?>
                        </div>

<!--                        --><?php
//                        if($is_auth) {
//                            $get_pinned_recipes_sql = "SELECT recipe_id, user_id FROM pinned_recipes
//                                            WHERE user_id=" . $_SESSION['user'] . " AND recipe_id = " . $recipe_id;
//                            $get_pinned_recipes_query = mysqli_query($connection, $get_pinned_recipes_sql);
//
//                            if (mysqli_num_rows($get_pinned_recipes_query) != 0) { ?>
<!--                                <a id="" class="btn-floating waves-effect waves-light red fav"><i-->
<!--                                            class="material-icons">favorite</i></a>-->
<!--                                --><?php
//                            }
//                            else { ?>
<!--                                <a id="" class="btn-floating waves-effect waves-light red fav"><i-->
<!--                                            class="material-icons">favorite_border</i></a>-->
<!--                                --><?php
//                            }
//                        }
//                        ?>

                    </div>
                </div>
                </div>
                </div>
                </div>
            </div>

            <p><?php echo $name_result["description"]?></p>
            <?php $ingredients_size = mysqli_num_rows($ingredients_query); ?>
            <ul id="tabs-swipe" class="tabs">
                <li class="tab col s6 m6"><a class="active" href="#swipe-1">Ingriedientai</a></li>
                <li class="tab col s6 m6"><a href="#swipe-2">Gaminimo eiga</a></li>
            </ul>
            <div id="swipe-1" class="col s10">
                <div class="card">
                    <div class="card-content"
                        <ul id="<?php echo $i; ?>">
                            <?php
                            do {
                                ?>
                                <li class="left-align"><?php echo $ingredients_result["amount"] . $ingredients_result["measurment_unit"] . ". " . $ingredients_result["name"]; ?></li>
                                <div class="divider"></div>
                                <?php
                            }
                            while ($ingredients_result=mysqli_fetch_assoc($ingredients_query))
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="swipe-2" class="col s10">
                <div class="card">
                    <div class="card-content col m6">
                        <ul id="<?php echo $i; ?>">
                            <?php
                            do {
                                ?>
                                <li class="left-align"><?php echo $description_result["number"] . ". " . $description_result["description"]; ?></li>
                                <div class="divider"></div>
                                <?php
                            }
                            while ($description_result=mysqli_fetch_assoc($description_query))
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
<script>
    $(document).ready(function() {
        $(".fav").click(function(){
            var a_icon = $(this);
            recipeID = $(this).parent().parent().attr('id');
            $.get("/YayRecipes/add_remove_favorites.php?id=" + recipeID, function(data) {
                if (data == "insert") {
                    a_icon.html("<i class='material-icons'>favorite</i>");
                }
                else if (data == "delete") {
                    a_icon.html("<i class='material-icons'>favorite_border</i>");
                }
            });
        });
    });
</script>
    </body>
</html>
