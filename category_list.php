<?php

function category_list(){
    include_once(dirname(__FILE__)."/dbconnect.php");
    session_start();
    global $connection;


    $sql = "select category.name as c_name, subcategory.name from category inner JOIN subcategory on category.category_id=subcategory.category_id order by category.name,subcategory.name";
    $result = mysqli_query($connection, $sql);
    $group = array();

    while ($row = mysqli_fetch_assoc($result))
    {
        $group[$row['c_name']][] = $row;
    }
    foreach ($group as $key => $values)
    {
        echo '<optgroup label="'.$key.'">';
        foreach ($values as $value)
        {
            echo '<option value="'.$value['name'].'">'.$value['name'].'</option>';
        }
        echo '</optgroup>';
    }
    echo '<label>Kategorija</label>';

}

function ingredient_list(){
    global $connection;
    include_once __DIR__."/dbconnect.php";

    $sql = "select name from ingredients";
    $result = mysqli_query($connection,$sql);
    $group = array();
    while ($row = mysqli_fetch_assoc($result)){
        $group[$row['name']][] = $row;
    }
    echo '<option value="" disabled selected>Ingredientai</option>';
    foreach ($group as $key => $values){
        echo '<option value="'.$key.'">'.$key.'</option>';
    }
}

function type_list(){
    global $connection;

    include_once __DIR__."/dbconnect.php";
    $sql = "select name from type";
    $result= mysqli_query($connection,$sql);
    $group = array();
    while ($row = mysqli_fetch_assoc($result)){
        $group[$row['name']][]=$row;
    }
    echo '<option value="" disabled selected>Tipas</option>';
    foreach ($group as $key => $values){
        echo '<option value="'.$key.'">'.$key.'</option>';
    }
}
?>