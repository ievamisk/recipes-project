<!DOCTYPE html>
  <html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"/>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <?php include(dirname(__FILE__)."/navbar.php"); ?>
        <div class="container center-align">
            <div class="row">
                <h3>Prisijungti</h3>
            </div>
            <div class="row">
                <form class="col s12 center-align" action="login.php" method="post">
                    <div class="row">
                        <div class="input-field">
                            <input id="login_email" type="email" name="email" class="validate">
                            <label for="email">El. paštas</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <input id="login_password" type="password" name="pass" class="validate">
                            <label for="""password">Slaptažodis</label>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn waves-effect waves-light" type="submit" name="btn_login">Prisijungti
                        </button>
                    </div>
                </form>
                <div class="col s12">
                    <p>Nesate prisiregistravę?</p>
                    <a href="register.php" class="waves-effect waves-light btn">Registruotis</a>
                </div>
            </div>
        </div>
    </body>
  </html>