<?php
        $cat_sql="SELECT * FROM category";
        $cat_query = mysqli_query($connection, $cat_sql);
        $cat_rs=mysqli_fetch_assoc($cat_query);
    ?>
<nav>
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo">Yay Recipes</a>
        <ul class="right hide-on-med-and-down">
            <?php
            do {
                ?>
                <li><a class="dropdown-button" href="#!" data-activates="dropdown" data-beloworigin="true"><?php echo ucfirst($cat_rs["name"]); ?></a></li>
                <?php
            }
            while ($cat_rs=mysqli_fetch_assoc($cat_query))
            ?>
        </ul>
    </div>
</nav>