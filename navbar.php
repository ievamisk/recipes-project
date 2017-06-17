<?php include_once(dirname(__FILE__)."/dbconnect.php");

    $cat_sql="SELECT * FROM category";
    $cat_query = mysqli_query($connection, $cat_sql);
    $cat_rs=mysqli_fetch_assoc($cat_query);

?>
    <nav class="nav-extended">
        <div class="nav-wrapper">
            <ul class="left">
                <li><a href="" class="brand">Yay Recipes</a></li>
                <?php
                do {
                    ?>
                    <li class=""><a class="dropdown-button" href="" data-activates="<?php echo $cat_rs["category_id"]; ?>" data-beloworigin="true"><?php echo ucfirst($cat_rs["name"]); ?></a></li>
                    <?php
                }
                while ($cat_rs=mysqli_fetch_assoc($cat_query))
                ?>
            </ul>

            <ul class="right">
<!--                <li>-->
<!--                    <div class="nav-wrapper">-->
<!--                        <form>-->
<!--                            <div class="input-field">-->
<!--                                <input id="search" type="search" required>-->
<!--                                <label class="label-icon" for="search"><i class="material-icons">search</i></label>-->
<!--                                <i class="material-icons">close</i>-->
<!--                            </div>-->
<!--                        </form>-->
<!--                    </div>-->
<!---->
<!--                </li>-->
                    <?php
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }

                        if (isset($_SESSION["user"]))
                        {
                            ?>
                            <li class=""><a href="product.php"><i class="medium material-icons">add</i></a></li>
                            <li class=""><a href="favorites.php"><i class="material-icons">favorite_border</i></a></li>
                            <li class=""><a href="profile.php"><i class="medium material-icons">perm_identity</i></a></li>
                            <li class=""><a href="logout.php">Atsijungti</a></li>
                            <?php
                        }
                        else
                        {
                            ?>
                            <li class="pulse"><a href="index.php">Prisijungti</a></li>
                            <?php
                        }
                    ?>
            </ul>
        </div>
    </nav>
    <?php
        $cat_size = mysqli_num_rows($cat_query);

        for($i = 1; $i <= $cat_size; $i++) {
            $cat_sql = "SELECT * FROM category 
                      INNER JOIN subcategory ON subcategory.category_id = category.category_id AND category.category_id = ".$i;
            $cat_query = mysqli_query($connection, $cat_sql);
            $cat_rs=mysqli_fetch_assoc($cat_query);

            ?>
            <ul id="<?php echo $i; ?>" class="dropdown-content">
                <?php
                    do {
                        ?>
                        <li><a href="<?php echo "/YayRecipes/display_category.php?id=" . $cat_rs["subcategory_id"]; ?>"><?php echo ucfirst($cat_rs["name"]); ?></a></li>
                        <?php
                    }
                    while ($cat_rs=mysqli_fetch_assoc($cat_query))
                ?>
            </ul>
            <?php
        }
    ?>
<script>
    $('.dropdown-button').dropdown({
            inDuration: 300,
            outDuration: 225,
            constrainWidth: true, // Does not change width of dropdown to that of the activator
            hover: true, // Activate on hover
            gutter: 0, // Spacing from edge
            belowOrigin: false, // Displays dropdown below the button
            alignment: 'left', // Displays dropdown with edge aligned to the left of button
        }
    );
</script>