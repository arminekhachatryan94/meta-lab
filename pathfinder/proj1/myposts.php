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
    if( $_POST["typeRequest"] == "deletePost" ){
        if( ($_POST["user_id"] == $_SESSION["user_id"]) || ($_SESSION["role"] == 'admin') ){
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
                    <!--a href="#" class="h4 text-primary" style="padding-left:10px; display:inline; float:right;">Edit</a-->
                    <form method="POST" action="myposts.php">
                        <a href="" name="delete" onclick="document.forms[<?php echo $i; ?>].submit();return false;" class="h4 text-primary" style="display:inline; float:right;">Delete</a> 
                        <input type="hidden" name="post_id" value="<?php echo $myposts[$i]["post_id"]; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $myposts[$i]["user_id"]; ?>">
                        <input type="hidden" name="typeRequest" value="deletePost">
                    </form>

                    <a onclick="showComments(<?php echo $myposts[$i]["post_id"]; ?>)" class="h4 text-primary" style="display:inline; float:left;"><u>Comments</u></a>
                </div>
            </div>
            <!-- comments -->
            <div>
                <div id="<?php echo $myposts[$i]["post_id"];?>" style="background-color:#c4e2ed; display:none; height:200px; width:100%; overflow:scroll;">
                    <!-- retrieve comments from db -->
                    <?php
                        $conn_comments = "mysql:host=127.0.0.1;dbname=metablog";
                        try {
                            $db_comments = new PDO($conn_comments, "root", "", [
                                PDO::ATTR_PERSISTENT => true
                            ]);
                            // echo "connected to database";
                        
                            $comments = $db_comments->prepare("SELECT * FROM `metablog`.`comments` WHERE `post_id` = ? ORDER BY created_at ASC");
                            if($comments->execute([$myposts[$i]["post_id"]])) {
                                $result_comments = $comments->fetchAll();
                                if( count($result_comments) == 0 ){
                                    echo '<div class="text-center" style="padding:10px;"><b>No comments</b></div>';
                                }
                                else {
                                    for( $j = 0; $j < count($result_comments); $j++ ){
                                        /* convert timestamp to date/time */
                                        $comment_seconds = strtotime($result_comments[$j]["created_at"]);
                                        $comment_date = date('M d, Y h:ia', $comment_seconds);
                        
                                        /* get commenter username */
                                        $username;
                                        try {
                                            $db = new PDO($conn, "root", "", [
                                                PDO::ATTR_PERSISTENT => true
                                            ]);
                                            // echo "connected to database";
                                        
                                            $commenter = $db->prepare("SELECT * FROM `metablog`.`users` WHERE user_id = ?");
                                            if($commenter->execute([$result_comments[$j]["commenter_id"]])) {
                                                $commenter_result = $commenter->fetchAll();
                                                $username = $commenter_result[0]["username"];
                                            }
                                            else{
                                                ;// echo "couldn't retrieve";
                                            }
                                        }
                                        catch(PDOException $e) {
                                            echo "not connected to database";
                                            die("Could not connect: " . $e->getMessage());
                                        }

                                        echo '<div style="padding-right:20px; padding-left:20px;';
                                        if( $j == 0 ){
                                            echo "padding-top:20px;";
                                        }

                                        if( $j + 1 < count($result_comments) ){
                                            echo '">';
                                            echo '<div class="text-left">';
                                                echo '<b style="color:#006598;">' . $username . '</b>';
                                            echo '</div>';
                                            echo '<div class="text-left" style="width:100%;">';
                                                echo $result_comments[$j]["body"];
                                            echo '</div>';
                                            echo '<div class="text-right" style="font-size:12px; width:100%">';
                                                echo $comment_date;
                                            echo '</div>';
                                            echo '<hr style="margin:0px; border-color:black;">';
                                        } else {
                                            echo 'padding-bottom:20px;">';
                                            echo '<div class="text-left">';
                                                echo '<b style="color:#006598;">' . $username . '</b>';
                                            echo '</div>';
                                            echo '<div class="text-left" style="width:100%;">';
                                                echo $result_comments[$j]["body"];
                                            echo '</div>';
                                            echo '<div class="text-right" style="font-size:12px; width:100%">';
                                                echo $comment_date;
                                            echo '</div>';
                                        }
                                        echo '</div>';
                                    }
                                }
                            }
                        }
                        catch(PDOException $e) {
                            echo "not connected to database";
                            die("Could not connect: " . $e->getMessage());
                        }
                    ?>
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

<script type="text/javascript">
    function showComments(id) {
        var display = document.getElementById(id).style.display;
        if( display == "none" ){
            document.getElementById(id).style.display = "inline-block";
        }
        else {
            document.getElementById(id).style.display = "none";
        }
    }
    
</script>

<?php include "templates/footer.php"; ?>