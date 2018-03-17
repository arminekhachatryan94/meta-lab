<?php

session_start();

if( !isset($_SESSION["user_id"]) ){

if( !empty($_POST)){
    if( $_POST["password"] == $_POST["confirm_password"] ){
    $conn = "mysql:host=127.0.0.1;dbname=metablog";
    try {
        $db = new PDO($conn, "root", "", [
            PDO::ATTR_PERSISTENT => true
        ]);
        // echo "connected to database";

        // check if username is already used
        $email_free = false;
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        if($stmt->execute([$_POST["email"]])) {
            $result = $stmt->fetchAll();
            if( count($result) == 0 ){
                $email_free = true;
            }
        } else {
            echo "couldn't retrieve users from db";
        }

        // check if email is already used
        $username_free = false;
        $stmt1 = $db->prepare("SELECT * FROM users WHERE username = ?");
        if($stmt1->execute([$_POST["username"]])) {
            $result = $stmt1->fetchAll();
            if( count($result) == 0 ){
                $username_free = true;
            }
        } else {
            echo "couldn't retrieve users from db";
        }

        if( $email_free && $username_free ){

            $hashed_pwd = password_hash($_POST["password"], PASSWORD_BCRYPT);

            // create new user
            $stmt2 = $db->prepare("INSERT INTO users (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)");

            if($stmt2->execute([$_POST["first_name"], $_POST["last_name"], $_POST["username"], $_POST["email"], $hashed_pwd])) {

                // get user id assigned
                $stmt3 = $db->prepare("SELECT * FROM users WHERE username = ?");
                if($stmt3->execute([$_POST["username"]])) {
                    $result = $stmt3->fetchAll();
                    $new_id = $result[0]["user_id"];

                    // add role as user
                    $stmt4 = $db->prepare("INSERT INTO user_roles (user_id, role) VALUES (?, ?)");

                    // insert the new record into the drinks table using the data array
                    if($stmt4->execute([$new_id, "user"])) {
                        $_SESSION["register_success"] = "Successfully created user. Please login.";
                        header("Location: login.php", true);
                    }

                }

            }
            else {
                // Unable to create user
                $_SESSION["register_errors"] = "Unable to register.";
                $_SESSION["register"] = 2;
                header("Location: register.php", true);
            }
        } else if( !$email_free && !$username_free ) {
            // both email & username are taken
            $_SESSION["register_errors"] = "Username and email are already taken.";
            $_SESSION["register"] = 2;
            header("Location: register.php", true);
        } else if( $email_free && !$username_free ){
            // email is free but username is taken
            $_SESSION["register_errors"] = "Username is already taken.";
            $_SESSION["register"] = 2;
            header("Location: register.php", true);
        } else if( $username_free && !$email_free ){
            // username is free but email is taken
            $_SESSION["register_errors"] = "Email is already taken.";
            $_SESSION["register"] = 2;
            header("Location: register.php", true);
        } else {
            // Unable to create user
            $_SESSION["register_errors"] = "Unable to register.";
            $_SESSION["register"] = 2;
            header("Location: register.php", true);
        }

    }
    catch(PDOException $e) {
        echo "not connected to database";
        die("Could not connect: " . $e->getMessage());
    }
    }
    else {
        $_SESSION["register_errors"] = "Passwords do not match.";
        $_SESSION["register"] = 2;
        header("Location: register.php", true);
    }

}
?>

<?php include "templates/header.php"; ?>

<?php
    if( isset($_SESSION["register_errors"]) ) {
        echo '<div class="text-center text-white h4 bg-warning" style="padding-top:80px; display:inline-block; width:100%;">' . $_SESSION["register_errors"] . '</div>';
        $_SESSION["register"]--;
        if( $_SESSION["register"] == 0 ){
            unset($_SESSION["register_errors"]);
            unset($_SESSION["register"]);
        }
    }
?>
<div class="page text-center" style="padding-top:30px;">
    <div style="padding-top:100px;" class="display-1">Register</div>

    <form method="POST" action="register.php" style="padding-top:50px;">
        <div>First Name:</div>
        <input type="text" name="first_name" required><br>
        <br>
        <div>Last Name:</div>
        <input type="text" name="last_name" required><br>
        <br>
        <div>Username:</div>
        <input type="text" name="username" required><br>
        <br>
        <div>Email:</div>
        <input type="email" name="email" required><br>
        <br>
        <div>Password:<br></div>
        <input type="password" name="password" required>
        <br>
        <br>
        <div>Confirm Password:<br></div>
        <input type="password" name="confirm_password" required>
        <br>
        <br>
        <input class="btn btn-primary" type="submit" name="submit" value="Submit">
        <br>
        <br>
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