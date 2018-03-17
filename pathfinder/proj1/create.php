<?php

session_start();

if( isset($_SESSION["user_id"]) ){

if( !empty($_POST) ) {
    if( count($_POST["title"]) > 0 && count($_POST["body"]) > 0 ){
        $conn = "mysql:host=127.0.0.1;dbname=metablog";
        try {
            $db = new PDO($conn, "root", "", [
                PDO::ATTR_PERSISTENT => true
            ]);
            // echo "connected to database";

            $stmt = $db->prepare("INSERT INTO posts (user_id, post_title, post_body) VALUES (?, ?, ?)");

            if($stmt->execute([$_SESSION["user_id"], $_POST["title"], $_POST["body"]])) {
                // echo "New record successfully added into the posts table";
                $_SESSION["newpost"] = "New post was successfully published.";
                header("Location: posts.php", true);
            } else{
                echo "couldn't add into posts table";
            }
        }
        catch(PDOException $e) {
            echo "not connected to database";
            die("Could not connect: " . $e->getMessage());
        }
    } else{
        echo "invalid length";
    }
}
?>

<?php include "templates/header.php"; ?>


<div class="page text-center" style="padding-top:30px;">
    <div style="padding-top:100px;" class="display-1">Create a New Post</div>
    
    <!-- posts container -->
    <div style="padding: 30px 200px 50px 200px;">
        <!-- post -->
        <form method="POST" action="create.php" style="margin:30px; background-color:lightblue; border: 2px #006598 solid;">
            <!-- title -->
            <div class="h3 text-white text-center" style="background-color:#006598; padding:7px; margin:0px">
                <div>Title:</div>
                <input name="title" style="color:black;" type="text" required>
            </div>
            <!-- body -->
            <div class="h3 text-center" style="padding:20px; margin:0px;">
                <div style="padding-bottom:10px; color:#006598;">
                    <div>Body:</div>
                    <textarea name="body" class="h5" style="color:black; width:90%; height:100px;" required></textarea>
                </div>
            </div>
            <div style="padding-bottom:30px;">
                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            </div>
        </form>
    </div>
</div>

<?php include "templates/footer.php"; ?>

<?php
}
else {
    header("Location: index.php", true);
}
?>