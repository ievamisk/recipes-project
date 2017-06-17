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
            <div class="row">
                <h3>Registruotis</h3>
            </div>
        <?php
            if(isset($_POST["submit"])) {

                $first_name = trim($_POST['first_name']);
                $first_name = strip_tags($first_name);

                $last_name = trim($_POST['last_name']);
                $last_name = strip_tags($last_name);

                $email = trim($_POST['email']);
                $email = strip_tags($email);
                $email = htmlspecialchars($email);

                $password = trim($_POST['password']);
                $password = strip_tags($password);
                $password = htmlspecialchars($password);

                $query = "INSERT INTO USER (first_name, last_name, role_id, email, password) 
                          VALUES ('$first_name', '$last_name', 1 , '$email', '$password')";
                $result = mysqli_query($connection, $query) or die (mysqli_error($connection));
                if ($result) {
                    //echo "<br/>Registration successful";
                    ?>
                    <script>
                        location.href="index.php";
                    </script>
                    <?php
                } else {
                    echo "<br/>Oops, something went wrong";
                }
            }
            else{
        ?>
            <div class="row center-align">
                    <form class="col s12" action="" method="post">
                        <div class="input-field col s12">
                          <input id="first_name" name="first_name" type="text" class="validate">
                          <label for="first_name" data-error="Please enter your full name">Vardas</label>
                        </div>
                        <div class="input-field col s12">
                          <input id="last_name" name="last_name" type="text" class="validate">
                          <label for="last_name" data-error="Please enter your full last name">Pavardė</label>
                        </div>

                        <div class="input-field col s12">
                          <input id="email" name="email" type="email" class="validate">
                          <label for="email" data-error="Please enter valid email address">El. paštas</label>
                        </div>
                        <div class="input-field col s12">
                          <input id="password" name="password" type="password" class="validate">
                          <label for="password" data-error="Password must have atleast 6 characters">Slaptažodis</label>
                        </div>
                        <!--<div class="input-field col s12">-->
                          <!--<input id="repeat_password" type="password" class="validate">-->
                          <!--<label for="repeat_password">Repeat password</label>-->
                        <!--</div>-->
                    <div class="row">
                        <input class="btn waves-effect waves-light" value="Registruotis" type="submit" name="submit">
                    </div>

                </form>
            </div>
        </div>
        <?php
        }
        ?>
	</body>
</html>