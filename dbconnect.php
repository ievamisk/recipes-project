<?php


$connection = mysqli_connect('localhost','root','','recipesdb') or die (mysqli_error($connection));

mysqli_set_charset($connection, "utf8");