<?php

session_start();

if( !empty($_POST) ) {
    $conn = "mysql:host=127.0.0.1;dbname=metablog";

    if( isset($_POST["username"]) ){
        if( $_POST["username"] != $_SESSION["username"] ){
            // connect to db
            try {
                $db = new PDO($conn, "root", "", [
                    PDO::ATTR_PERSISTENT => true
                ]);
                
                // retrieve records from users table
                $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
                if($stmt->execute([$_POST["username"]])) {
                    $result = $stmt->fetchAll();
                    
                    // check if username is taken
                    if( (count($result) == 0) ) {
                        $stmt1 = $db->prepare("UPDATE users SET username = ? WHERE user_id = ?");
                        
                        // change username
                        if($stmt1->execute([$_POST["username"], $_SESSION["user_id"]])) {
                            $_SESSION["settings_changed"] = "Successfully changed username.";
                            $_SESSION["username"] = $_POST["username"];
                            header("Location: settings.php", true);
                            exit();
                        }
                        else{
                            $_SESSION["settings_error"] = "Couldn't change username.";
                            header("Location: settings.php", true);
                            exit();
                        }
                    } else{
                        $_SESSION["settings_error"] = "Sorry, username is already taken.";
                        header("Location: settings.php", true);
                        exit();
                    }
                }
                else {
                    echo "couldn't retrieve records";
                }

            }
            catch(PDOException $e) {
                echo "not connected to database";
                die("Could not connect: " . $e->getMessage());
            }
        }
        else{
            $_SESSION["settings_error"] = "You entered the same username.";
            header("Location: settings.php", true);
            exit();
        }
    }
    else if( isset($_POST["email"]) ){
        if( $_POST["email"] != $_SESSION["email"] ){
            // connect to db
            try {
                $db = new PDO($conn, "root", "", [
                    PDO::ATTR_PERSISTENT => true
                ]);
                
                // retrieve records from users table
                $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
                if($stmt->execute([$_POST["email"]])) {
                    $result = $stmt->fetchAll();
                    
                    // check if email is taken
                    if( (count($result) == 0) ) {
                        $stmt1 = $db->prepare("UPDATE users SET email = ? WHERE user_id = ?");
                        
                        // change email
                        if($stmt1->execute([$_POST["email"], $_SESSION["user_id"]])) {
                            $_SESSION["settings_changed"] = "Successfully changed email.";
                            $_SESSION["email"] = $_POST["email"];
                            header("Location: settings.php", true);
                            exit();
                        }
                        else{
                            $_SESSION["settings_error"] = "Couldn't change email.";
                            header("Location: settings.php", true);
                            exit();
                        }
                    } else{
                        $_SESSION["settings_error"] = "Sorry, email is already taken.";
                        header("Location: settings.php", true);
                        exit();
                    }
                }
                else {
                    echo "couldn't retrieve records";
                }

            }
            catch(PDOException $e) {
                echo "not connected to database";
                die("Could not connect: " . $e->getMessage());
            }
        }
        else{
            $_SESSION["settings_error"] = "You entered the same email.";
            header("Location: settings.php", true);
            exit();
        }
    }
}
?>



<?php include "templates/header.php"; ?>

<?php
    if( isset($_SESSION["settings_error"]) ) {
        echo '<div class="text-center text-white h4 bg-warning" style="padding-top:80px; display:inline-block; width:100%;">' . $_SESSION["settings_error"] . '</div>';
        unset($_SESSION["settings_error"]);
    }
    else if( isset($_SESSION["settings_changed"]) ) {
        echo '<div class="text-center text-white h4 bg-success" style="padding-top:80px; display:inline-block; width:100%;">' . $_SESSION["settings_changed"] . '</div>';
        unset($_SESSION["settings_changed"]);
    }
?>

<div class="page text-center" style="padding-top:100px;">
    <div style="padding-top:30px;" class="display-1">Settings</div>

    <!-- posts container -->
    <div style="padding: 30px 200px 50px 200px">
        <div style="padding-top:30px;">
            <div style="color:#006598;"><b>First name:</b></div>
            <div><?php echo $_SESSION["first_name"]; ?></div>
        </div>
        
        <div style="padding-top:30px;">
            <div style="color:#006598;"><b>Last name:</b></div>
            <div><?php echo $_SESSION["last_name"]; ?></div>
        </div>

        <div style="padding-top:30px;">
            <div  style="color:#006598;" class="text-center"><b>Username:</b></div>
            <form method="POST" action="settings.php">
                <input type="text" name="username" value=<?php echo '"' . $_SESSION["username"] . '"'; ?>>
                <input class="btn btn-primary" name="submit" type="submit">
            </form>
        </div>

        <div style="padding-top:30px;">
            <div  style="color:#006598;" class="text-center"><b>Email:</b></div>
            <form method="POST" action="settings.php">
                <input type="email" name="email" value=<?php echo '"' . $_SESSION["email"] . '"'; ?>>
                <input class="btn btn-primary" name="submit" type="submit">
            </form>
        </div>
    </div>
</div>

<?php include "templates/footer.php"; ?>