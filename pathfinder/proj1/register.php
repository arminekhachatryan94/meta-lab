<?php

session_start();

if( !empty($_POST)){
    echo "first_name: " . $_POST["first_name"];
    echo "last_name: " . $_POST["last_name"];
    echo "username: " . $_POST["username"];
    echo "email: " . $_POST["email"];
    echo "password: " . $_POST["password"];
}
?>

<?php include "templates/header.php"; ?>

<div class="page text-center" style="padding-top:30px;">
    <div style="padding-top:100px;" class="display-1">Register</div>

    <form method="POST" action="register.php" style="padding-top:50px;">
        <div>First Name:</div>
        <input type="text" name="first_name"><br>
        <br>
        <div>Last Name:</div>
        <input type="text" name="last_name"><br>
        <br>
        <div>Username:</div>
        <input type="text" name="username"><br>
        <br>
        <div>Email:</div>
        <input type="email" name="email"><br>
        <br>
        <div>Password:<br></div>
        <input type="text" name="password">
        <br>
        <br>
        <input class="btn btn-primary" type="submit" name="submit" value="Submit">
        <br>
        
    </form>
</div>

<?php include "templates/footer.php"; ?>