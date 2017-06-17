<?php
session_start();
include_once(dirname(__FILE__)."/dbconnect.php");

$user_id = $_SESSION['user'];
$recipe_id = $_GET["id"];

$check_favorites_sql = "SELECT pinned_recipes_id FROM pinned_recipes
                        WHERE user_id=" . $user_id . " AND recipe_id=" . $recipe_id;

$check_favorites_query = mysqli_query($connection, $check_favorites_sql);

$count = mysqli_num_rows($check_favorites_query);

if ($count == 0) {
    $insert_favorite_sql = "INSERT INTO pinned_recipes (recipe_id, user_id)
                            VALUES (".$recipe_id . "," . $user_id. ")";
    $exec = mysqli_query($connection, $insert_favorite_sql);

    echo "insert";
}
else {
    $delete_favorite_sql = "DELETE FROM pinned_recipes
                            WHERE user_id=" . $user_id . " AND recipe_id=" . $recipe_id;

    $exec = mysqli_query($connection, $delete_favorite_sql);

    echo "delete";
}

?>