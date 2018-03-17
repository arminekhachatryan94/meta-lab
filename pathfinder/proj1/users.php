<?php
session_start();

if( isset($_SESSION["user_id"]) ){
$users = array();

$conn = "mysql:host=127.0.0.1;dbname=metablog";
try {
    $db = new PDO($conn, "root", "", [
        PDO::ATTR_PERSISTENT => true
    ]);

    $user = $db->prepare("SELECT * FROM `metablog`.`users`");
    if($user->execute()) {
        $result = $user->fetchAll();
        // var_dump($result);
        $users = $result;
    }
    else{
        echo "couldn't retrieve";
    }
}
catch(PDOException $e) {
    echo "not connected to database";
    die("Could not connect: " . $e->getMessage());
}

if( !empty($_POST) ) {
    if( $_SESSION["user_id"] == $_POST["id"]){
        $_SESSION["user_id"] = $_POST["role"];
    }
    $conn = "mysql:host=127.0.0.1;dbname=metablog";
    try {
        $db = new PDO($conn, "root", "", [
            PDO::ATTR_PERSISTENT => true
        ]);    $stmt = $db->prepare("UPDATE user_roles SET role = ? WHERE user_id = ?");

        if($stmt->execute([$_POST["role"], $_POST["id"]])) {
            $_SESSION["role_change"] = "Successfully changed role.";
            header("Location: users.php", true);
            exit();
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
    if( isset($_SESSION["role_change"]) ){
        echo '<div style="padding:80px 100px 0px 100px;" class="bg-success text-white text-center h4">' . $_SESSION["role_change"] . "</div>";
        unset($_SESSION["role_change"]);
    }
?>

<div class="page text-center" style="padding-top:30px;">
    <div style="padding-top:100px; padding-bottom:50px;" class="display-1">All Users</div>
    
    <div class="h4 text-left" style="background-color:lightblue; padding:20px; margin:0px 100px 50px 100px;">
        <div class="row text-center text-primary" style="padding:10px;">
            <div class="col-xs-12">
                    <div class="col-xs-2">First Name</div>
                    <div class="col-xs-2">Last Name</div>
                    <div class="col-xs-2">Username</div>
                    <div style="display:hidden" class="col-xs-6"></div>
            </div>
        </div>
        <hr style="border:0.5px solid;" class="text-primary">
            <?php
            for( $i = 0; $i < count($users); $i++ ) {
            ?>
            <div class="row text-center" style="padding:10px;">
                <div class="col-xs-12">
                    <div class="col-xs-2"><?php echo $users[$i]["first_name"]?></div>
                    <div class="col-xs-2"><?php echo $users[$i]["last_name"]?></div>
                    <div class="col-xs-2"><?php echo $users[$i]["username"]?></div>
                    <form method="POST" class="col-xs-6">
                        <?php
                        $conn = "mysql:host=127.0.0.1;dbname=metablog";
                        try {
                            $db = new PDO($conn, "root", "", [
                                PDO::ATTR_PERSISTENT => true
                            ]);
                        
                            $roles = $db->prepare("SELECT * FROM `metablog`.`user_roles` WHERE user_id = ?");
                            if($roles->execute([$users[$i]["user_id"]])) {
                                $result = $roles->fetchAll();
                                if( $result[0]["role"] == "admin" ){
                                    echo '
                                        <input type="radio" name="id" checked style="visibility:hidden;" value="' . $result[0]["user_id"] . '">
                                        <input type="radio" name="role" value="admin" checked>Admin<br>
                                        <input type="radio" name="role" value="user">User<br>
                                        <input type="submit" value="Submit">
                                    ';
                                } else {
                                    echo '
                                        <input type="radio" name="id" checked style="visibility:hidden;" value="' . $result[0]["user_id"] . '">
                                        <input type="radio" name="role" value="admin">Admin<br>
                                        <input type="radio" name="role" value="user" checked>User<br>
                                        <input type="submit" value="Submit">
                                    ';
                                }
                            }
                            else{ ; }
                        }
                        catch(PDOException $e) { ; }
                        ?>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php include "templates/footer.php"; ?>

<?php
}
else {
    header("Location: index.php", true);
}
?>