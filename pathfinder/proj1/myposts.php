<?php

session_start();

$myposts = array();

$conn = "mysql:host=127.0.0.1;dbname=metablog";
try {
    $db = new PDO($conn, "root", "", [
        PDO::ATTR_PERSISTENT => true
    ]);
    // echo "connected to database";

    $posts = $db->prepare("SELECT * FROM `metablog`.`posts` WHERE user_id = ? ORDER BY created_at DESC");
    if($posts->execute([$_SESSION["user_id"]])) {
        $result = $posts->fetchAll();
        $myposts = $result;
    }
    else{
        echo "couldn't retrieve";
    }
}
catch(PDOException $e) {
    echo "not connected to database";
    die("Could not connect: " . $e->getMessage());
}

if( !empty($_POST) ){
    if( $_POST["crud"] == "delete" ){
        if( $_POST["user_id"] == $_SESSION["user_id"] ){
            $db = new PDO($conn, "root", "", [
                PDO::ATTR_PERSISTENT => true
            ]);
            
            $stmt = $db->prepare("DELETE FROM posts WHERE post_id = ?");

            // delete post
            if($stmt->execute([$_POST["post_id"]])) {
                header("Location: myposts.php", true);
                $_SESSION["post_deleted"] = "Post was successfully deleted.";
                $_SESSION["delete"] = 2;
            }
        }
    }
}


?>

<?php include "templates/header.php"; ?>

<?php
    if( isset($_SESSION["post_deleted"]) && $_SESSION["delete"] ){
        echo '<div class="text-center text-white h4 bg-success" style="padding-top:80px; display:inline-block; width:100%;">' . $_SESSION["post_deleted"] . '</div>';
        $_SESSION["delete"]--;
        if( $_SESSION["delete"] == 0 ){
            unset($_SESSION["post_deleted"]);
            unset($_SESSION["delete"]);
        }
    }
?>

<div class="page text-center" style="padding-top:30px;">
    <div style="padding-top:100px;" class="display-1">My Posts</div>

    <!-- posts container -->
    <div style="padding: 30px 200px 50px 200px">
    <?php
    if( count($myposts) > 0 ){
        for( $i = 0; $i < count($myposts); $i++ ){
    ?>
        <!-- post -->
        <div style="margin:30px;">
            <!-- title -->
            <div class="h2 text-white" style="background-color:#006598; padding:7px; margin:0px"><?php echo $myposts[$i]["post_title"]; ?></div>
            <!-- body -->
            <div class="h4 text-left" style="background-color:lightblue; padding:20px; margin:0px;">
                <div class="text-left" style="padding-bottom:10px; color:#006598;">
                <?php echo $_SESSION['username']; ?>
                </div>

                <?php echo $myposts[$i]["post_body"]; ?>
                <div class="h5 text-right" style="color:grey;"><i><?php

                $seconds = strtotime($myposts[$i]["created_at"]);
                $date = date('M d, Y h:i a', $seconds);
                echo $date;
                ?></i></div>
                <div style="padding-bottom:30px;">
                    <a href="#" class="h4 text-primary" style="display:inline; float:left;"><u>Comments</u></a>

                    <?php if( $myposts[$i]["user_id"] == $_SESSION["user_id"] ) { ?>
                        <a href="#" class="h4 text-primary" style="padding-left:10px; display:inline; float:right;">Edit</a>
                        <form method="POST" action="myposts.php">
                            <a href="" name="delete" onclick="document.forms[<?php echo $i; ?>].submit();return false;" class="h4 text-primary" style="display:inline; float:right;">Delete</a> 
                            <!--a href="" name="delete" onclick="document.forms[0].submit();return false;" class="h4 text-primary" style="display:inline; float:right;">Delete</a-->
                            <input type="hidden" name="post_id" value="<?php echo $myposts[$i]["post_id"]; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $myposts[$i]["user_id"]; ?>">
                            <input type="hidden" name="crud" value="delete">
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php
        }
    } else {
        echo "no posts";
    }
    ?>
    </div>
</div>

<?php include "templates/footer.php"; ?>