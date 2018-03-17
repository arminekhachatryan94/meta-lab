<?php

session_start();

if( !isset($_SESSION["user_id"]) ){

if( !empty($_POST)){
    $username=$_POST["username"];
    $password=$_POST["password"];
    
    $conn = "mysql:host=127.0.0.1;dbname=metablog";
    try {
        $db = new PDO($conn, "root", "", [
            PDO::ATTR_PERSISTENT => true
        ]);
        // echo "connected to database";

        $user = $db->prepare("SELECT * FROM `metablog`.`users` WHERE username = ?");
        if($user->execute([$username])) {
            $result = $user->fetchAll();
            // var_dump($result);

            // unique usernames
            if( count($result) == 1 && $username == $result[0]["username"] && password_verify($password, $result[0]["password"]) ) {
                // echo "successful login";
                $_SESSION["username"] = $username;
                $_SESSION["email"] = $result[0]["email"];
                $_SESSION["first_name"] = $result[0]["first_name"];
                $_SESSION["last_name"] = $result[0]["last_name"];
                $_SESSION["user_id"] = $result[0]["user_id"];

                // get role
                $role = $db->prepare("SELECT * FROM `metablog`.`user_roles` WHERE user_id = ?");
                if($role->execute([$_SESSION["user_id"]])) {
                    $result2 = $role->fetchAll();
                    
                    if( count($result2) == 1 ){
                        $_SESSION["role"] = $result2[0]["role"];
                    }
                }
                
                // redirect to posts
                header("Location: posts.php", true);
                exit();
            }
            else {
                $_SESSION["login_error"] = "Invalid credentials. Please try again.";
                header("Location: login.php", true);
                exit();
            }
        }
        else{
            echo "couldn't retrieve";
        }
    }
    catch(PDOException $e) {
        echo "not connected to database";
        die("Could not connect: " . $e->getMessage());
    }
}
?>

<?php include "templates/header.php"; ?>

<?php
if( isset($_SESSION["login_error"]) ){
    echo '<div class="text-center text-white h4 bg-warning" style="padding-top:80px; display:inline-block; width:100%;">' . $_SESSION["login_error"] . '</div>';
    unset($_SESSION["login_error"]);
}
if( isset($_SESSION["register_success"]) ) {
    echo '<div class="text-center text-white h4 bg-success" style="padding-top:80px; display:inline-block; width:100%;">' . $_SESSION["register_success"] . '</div>';
    unset($_SESSION["register_success"]);
}
?>
<div class="page text-center" style="padding-top:30px;">
    <div style="padding-top:100px;" class="display-1">Login</div>

    <form method="POST" action="login.php" style="padding-top:50px;">
        <div>Username:</div>
        <input type="text" name="username" required><br>
        <br>
        <div>Password:<br></div>
        <input type="password" name="password" required>
        <br>
        <br>
        <input class="btn btn-primary" type="submit" name="submit" value="Submit">
        <br>
        
    </form>
</div>

<?php include "templates/footer.php"; ?>

<?php
}
else {
    header("Location: posts.php", true);
}
?>