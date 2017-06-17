<?php
session_start();

include_once(dirname(__FILE__)."/dbconnect.php");

add_recipe();

function add_recipe(){
    if(isset($_SESSION['user'])){
        include_once __DIR__."/dbconnect.php";
        global $connection;

        $re_user = $_SESSION['user'];
        $re_name =trim($_POST['product_name']);
        $re_name=strip_tags($re_name);
        $re_name=htmlspecialchars($re_name);

        $check_name = mysqli_query($connection, "select name from recipe where name = '".$re_name."'");

        if(mysqli_num_rows($check_name)>=1){
            echo "Patiekalo vardas jau egzistuoja";
        }else{
            $re_portion=trim($_POST['portion']);
            $re_portion=strip_tags($re_portion);
            $re_portion=htmlspecialchars($re_portion);

            $re_cooking_time=trim($_POST['cooking_time']);
            $re_cooking_time=strip_tags($re_cooking_time);
            $re_cooking_time=htmlspecialchars($re_cooking_time);

            $re_description=trim($_POST['description']);
            $re_description=strip_tags($re_description);
            $re_description=htmlspecialchars($re_description);

            $re_type=trim($_POST['type']);
            $re_type=strip_tags($re_type);
            $re_type=htmlspecialchars($re_type);

            $re_sub_category=trim($_POST['category']);
            $re_sub_category=strip_tags($re_sub_category);
            $re_sub_category=htmlspecialchars($re_sub_category);

            $re_picture=trim($_POST['picture']);
            $re_picture=strip_tags($re_picture);
            $re_picture=htmlspecialchars($re_picture);

            $call_add_recipe="call add_recipe('".$re_name."','".$re_portion."','".$re_cooking_time."','".$re_description."','".$re_type."','".$re_sub_category."','".$re_user."','".$re_picture."')";
            $result =  mysqli_query($connection,$call_add_recipe);
            if($result){
                add_ingredient();
                add_step();
                $newroad = mysqli_query($connection,"select recipe_id from recipe where name ='".$re_name."'");
                $TEST = mysqli_fetch_assoc($newroad);
                if($TEST){
                    $id = intval($TEST['recipe_id']);
                    header("Location: recipe.php?id=".$id);
                }

            }else{
                echo "Error: ".$call_add_recipe."<br>" .mysqli_error($connection);
            }
        }
    }
    else{
        echo 'neprisijunges';
    }
}

function add_step(){
    include_once __DIR__."/dbconnect.php";
    global $connection;

    $name = trim($_POST['product_name']);
    $name=strip_tags($name);
    $name=htmlspecialchars($name);
    for ($i=1; $i<=10; $i++){
        if(isset($_POST['textarea'.$i])){
            $description = trim($_POST['textarea'.$i]);
            $description=strip_tags($description);
            $description=htmlspecialchars($description);

            $call_add_step="call add_step('".$i."','".$description."','".$name."')";
            $result = mysqli_query($connection,$call_add_step);
            if($result){
                echo "new record was added";
            }
            else{
                echo "Error: ".$call_add_step."<br>" .mysqli_error($connection);
            }
        }else{
            break;
        }

    }
}

function add_ingredient(){
    include "dbconnect.php";
    global $connection;
    for ($i=1; $i<=100; $i++){
        if(isset($_POST['ingredient'.$i])){

            $ingredient = trim($_POST['ingredient'.$i]);
            if($ingredient == "last"){
                if(empty($_POST['addingredient1']) Xor !isset($_POST['addingredient1'])){
                    echo "ingredietas nepasirinktas";
                    break;
                }else {

                    $addingredient = trim($_POST['addingredient'.$i]);
                    $addingredient=strip_tags($addingredient);
                    $addingredient=htmlspecialchars($addingredient);
                    $check_ingredient=mysqli_query($connection,"select name from ingredients where name='".$addingredient."'");
                    if(mysqli_num_rows($check_ingredient)>=1){
                        echo "'".$i."' Ingredintas jau egzistuoja";
                    }else{
                        $new_ingredient=mysqli_query($connection,"insert into ingredients(name) value('".$addingredient."')");
                        if($new_ingredient){

                            $re_name = trim($_POST['product_name']);
                            $re_name=strip_tags($re_name);
                            $re_name=htmlspecialchars($re_name);

                            $amount = trim($_POST['amount'.$i]);
                            $amount=strip_tags($amount);
                            $amount=htmlspecialchars($amount);

                            $measurment = trim($_POST['measurment_unit'.$i]);
                            $measurment=strip_tags($measurment);
                            $measurment=htmlspecialchars($measurment);

                            $call_add_ingredient=mysqli_query($connection,"call add_ingredient('".$addingredient."','".$re_name."','".$amount."','".$measurment."')");

                            if($call_add_ingredient){
                                echo "ingredientas pridetas i recepta     ";
                            }else{
                                echo "Error: ".$call_add_ingredient."<br>" .mysqli_error($connection);
                            }
                        }
                    }
                }

            }else
            {
                $ingre_name = trim($_POST['ingredient'.$i]);
                $ingre_name=strip_tags($ingre_name);
                $ingre_name=htmlspecialchars($ingre_name);

                $re_name = trim($_POST['product_name']);
                $re_name=strip_tags($re_name);
                $re_name=htmlspecialchars($re_name);

                if(empty($_POST['amount'.$i])){
                    $amount = trim($_POST['amount'.$i]);
                    $amount=strip_tags($amount);
                    $amount=htmlspecialchars($amount);
                } else{
                    $amount=0;
                }
                $measurment = trim($_POST['measurment_unit'.$i]);
                $measurment=strip_tags($measurment);
                $measurment=htmlspecialchars($measurment);

                $call_add_ingredient=mysqli_query($connection,"call add_ingredient('".$ingre_name."','".$re_name."','".$amount."','".$measurment."')");

                if($call_add_ingredient){
                    echo "ingredientas pridetas i recepta";
                }else{
                    echo "Error: ".$call_add_ingredient."<br>" .mysqli_error($connection);
                }
            }

        }else{
            break;
        }
    }

}
?>
