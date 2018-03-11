<?php

session_start();

if( !empty($_POST) ) {
    $conn = "mysql:host=127.0.0.1;dbname=metablog";

    if( isset($_POST["username"]) ){
        $_SESSION["username"] = $_POST["username"];    

        try {
            $db = new PDO($conn, "root", "", [
                PDO::ATTR_PERSISTENT => true
            ]);    $stmt = $db->prepare("UPDATE users SET username = ? WHERE user_id = ?");
    
            if($stmt->execute([$_POST["username"], $_SESSION["user_id"]])) {
                $_SESSION["settings_changed"] = "Successfully changed username.";
                header("Location: settings.php", true);
                exit();
            }
        }
        catch(PDOException $e) {
            echo "not connected to database";
            die("Could not connect: " . $e->getMessage());
        }
    }
    else if( isset($_POST["email"]) . $_POST["email"] ){
        $_SESSION["email"] = $_POST["email"];

        try {
            $db = new PDO($conn, "root", "", [
                PDO::ATTR_PERSISTENT => true
            ]);    $stmt = $db->prepare("UPDATE users SET email = ? WHERE user_id = ?");
    
            if($stmt->execute([$_POST["email"], $_SESSION["user_id"]])) {
                $_SESSION["settings_changed"] = "Successfully changed email.";
                header("Location: settings.php", true);
                exit();
            }
        }
        catch(PDOException $e) {
            echo "not connected to database";
            die("Could not connect: " . $e->getMessage());
        }
    }
}
?>

<?php include "templates/header.php"; ?>

<?php
if( count($_SESSION["settings_changed"]) > 0 ) {
    echo '<div class="text-center bg-success text-white h4" style="padding-top:70px; display:inline-block; width:100%;">' . $_SESSION["settings_changed"] . "</div>";
    $_SESSION["settings_changed"] = "";
}
?>

<div class="page text-center">
    <div style="padding-top:10px;" class="display-1">Settings</div>

    <!-- posts container -->
    <div style="padding: 30px 200px 50px 200px">
        <div>
            <div class="text-center">Username:</div>
            <form method="POST" action="settings.php">
                <input type="text" name="username" value=<?php echo '"' . $_SESSION["username"] . '"'; ?>>
                <input name="submit" type="submit">
            </form>
        </div>

        <div style="padding-top:30px;">
            <div class="text-center">Email:</div>
            <form method="POST" action="settings.php">
                <input type="text" name="email" value=<?php echo '"' . $_SESSION["email"] . '"'; ?>>
                <input name="submit" type="submit">
            </form>
        </div>
    </div>
</div>

<?php include "templates/footer.php"; ?>