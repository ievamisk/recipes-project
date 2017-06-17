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
            $subcategory_id = $_GET["id"];
            $get_subcategory_sql = "SELECT name FROM subcategory
                                    WHERE subcategory_id =  $subcategory_id";
            $get_subcategory_query = mysqli_query($connection, $get_subcategory_sql);
            $get_subcategory_result = mysqli_fetch_array($get_subcategory_query);

            $get_recipe_sql = "SELECT * FROM recipe
                              WHERE subcategory_id= $subcategory_id";
            $get_recipe_query = mysqli_query($connection, $get_recipe_sql);


        ?>
        <h3><?php echo ucfirst($get_subcategory_result["name"]);?></h3>
        <div class="row">
        <?php
            while ($row = mysqli_fetch_array($get_recipe_query)){

                $type_sql ="SELECT type.name FROM type 
                            INNER JOIN recipe ON recipe.type_id = type.type_id and recipe.recipe_id = " .$row["recipe_id"];
                $type_query = mysqli_query($connection, $type_sql);
                $type_result = mysqli_fetch_array($type_query);

                $rating_sql ="SELECT sum(rating) / count(*) AS rating FROM rate 
                              WHERE recipe_id =". $row["recipe_id"];
                $rating_query = mysqli_query($connection, $rating_sql);
                $rating_result = mysqli_fetch_array($rating_query);
            ?>
            <div class="col s12 m4">
                <div id="<?php echo $row["recipe_id"];?>" class="card">
                    <div class="card-image">
                        <a href="<?php echo "/YayRecipes/recipe.php?id=" . $row["recipe_id"]; ?>"><img src="<?php echo $row["picture"];?>"></a>
                        <span class="card-title"><?php echo $row["name"];?></span>

                        <?php
                            if($is_auth) {
                                $get_pinned_recipes_sql = "SELECT recipe_id, user_id FROM pinned_recipes
                                        WHERE user_id=" . $_SESSION['user'] . " AND recipe_id = " . $row["recipe_id"];
                                $get_pinned_recipes_query = mysqli_query($connection, $get_pinned_recipes_sql);
                                //$get_pinned_recipes_result = mysqli_fetch_array($get_pinned_recipes_query);

                                if (mysqli_num_rows($get_pinned_recipes_query) != 0) { ?>
                                    <a id="" class="btn-floating halfway-fab waves-effect waves-light red fav"><i
                                            class="material-icons">favorite</i></a>
                                    <?php
                                }
                                else { ?>
                                    <a id="" class="btn-floating halfway-fab waves-effect waves-light red fav"><i
                                            class="material-icons">favorite_border</i></a>
                        <?php
                                }
                            }
                        ?>
                    </div>
                    <div class="card-content">
                        <div class="chip">
                            <i class="material-icons">timelapse</i>
                            <?php echo $row["cooking_time"];?> min.
                        </div>
                        <div class="chip">
                            <i class="material-icons">room_service</i>
                            <?php echo $row["portion"];?>
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