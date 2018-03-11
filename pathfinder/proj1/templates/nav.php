<nav class="navig container-fluid" style="background-color:#006598; position:fixed;">
    <div class="row h4" style="display:inline;">
        <div class="col-md-8 text-left" style="display:inline;">
            <a href="
                <?php
                if( !empty($_SESSION["username"]) ){
                    echo "posts.php";
                } else {
                    echo "index.php";
                }
                ?>
            " class="h1 text-white" style="padding:10px;">MetaBlog</a>

            <?php
            if( !empty($_SESSION["username"]) ){ ?>
            <a href="posts.php" class="text-white" style="padding:10px;">
                <span class="glyphicon glyphicon-home"></span>
                Posts
            </a>

            <a href="myposts.php" class="text-white" style="padding:10px;">
                <span class="glyphicon glyphicon-file"></span>
                My Posts
            </a>

            <a href="create.php" class="text-white" style="padding:10px;">
                <span class="glyphicon glyphicon-send"></span>
                Create Post
            </a>

            <?php } ?>

            <?php
            if( ($_SESSION["role"]) == "admin" ){ ?>
            <a href="users.php" class="text-white" style="padding:10px;">
                <span class="glyphicon glyphicon-user"></span>
                Users
            </a>
            <?php } ?>

        </div>
        <div class="col-md-4 text-right" style="display:inline;">

            <?php
            if( empty($_SESSION["username"]) ){ ?>
            <a href="login.php" class="text-white" style="padding:10px;">
                <span class="glyphicon glyphicon-log-out"></span>
                Login
            </a>
            <a href="register.php" class="text-white" style="padding:10px;">
                <span class="glyphicon glyphicon-log-out"></span>
                Register
            </a>
            <?php } else {?>

            <a class="text-white" style="padding:10px;">
                <?php echo $_SESSION["username"]; ?>
            </a>
            <a href="settings.php" class="text-white" style="padding:10px;">
                <span class="glyphicon glyphicon-cog"></span>
                Settings
            </a>
            <a href="logout.php" class="text-white" style="padding:10px;">
                <span class="glyphicon glyphicon-log-out"></span>
                Logout
            </a>
            <?php } ?>

        </div>
    </div>
</nav>
