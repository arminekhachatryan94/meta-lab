<?php

session_start();

$allposts = array();

$conn = "mysql:host=127.0.0.1;dbname=metablog";
try {
    $db = new PDO($conn, "root", "", [
        PDO::ATTR_PERSISTENT => true
    ]);
    // echo "connected to database";

    $posts = $db->prepare("SELECT * FROM `metablog`.`posts` ORDER BY created_at DESC");
    if($posts->execute()) {
        $result = $posts->fetchAll();
        $allposts = $result;
        // var_dump($result);
    }
    else{
        echo "couldn't retrieve";
    }
}
catch(PDOException $e) {
    echo "not connected to database";
    die("Could not connect: " . $e->getMessage());
}

?>

<?php include "templates/header.php"; ?>

<?php
    if( isset($_SESSION["newpost"]) ) {
        echo '<div class="text-center text-white h4 bg-success" style="padding-top:80px; display:inline-block; width:100%;">' . $_SESSION["newpost"] . '</div>';
        unset($_SESSION["newpost"]);
    }?>

<div class="page text-center" style="padding-top:30px;">
    <div style="padding-top:100px;" class="display-1">All Posts</div>

    <!-- posts container -->
    <div style="padding: 30px 200px 50px 200px">
    <?php
    if( count($allposts) > 0 ){
        for( $i = 0; $i < count($allposts); $i++ ){
    ?>
        <!-- post -->
        <div style="margin:30px;">
            <!-- title -->
            <div class="h2 text-white" style="background-color:#006598; padding:7px; margin:0px"><?php echo $allposts[$i]["post_title"]; ?></div>
            <!-- body -->
            <div class="h4 text-left" style="background-color:lightblue; padding:20px; margin:0px;">
                <div class="text-left" style="padding-bottom:10px; color:#006598;">
                <?php
                    $users_temp = $db->prepare("SELECT * FROM `metablog`.`users` WHERE user_id = ?");
                    if($users_temp->execute([$allposts[$i]["user_id"]])) {
                        $result = $users_temp->fetchAll();
                        echo $result[0]["username"];
                    }
                    else{
                        echo "Anonymous";
                    }
                ?>
                </div>

                <?php echo $allposts[$i]["post_body"]; ?>
                <div class="h5 text-right" style="color:grey;"><i><?php

                $seconds = strtotime($allposts[$i]["created_at"]);
                $date = date('M d, Y h:i a', $seconds);
                echo $date;
                ?></i></div>
                <div style="padding-bottom:30px;">
                    <a href="#" class="h4 text-primary" style="display:inline; float:left;"><u>Comments</u></a>

                    <?php if( $allposts[$i]["user_id"] == $_SESSION["user_id"] ) { ?>
                        <a href="#" class="h4 text-primary" style="padding-left:10px; display:inline; float:right;">Edit</a>
                        <a href="#" class="h4 text-primary" style="display:inline; float:right;">Delete</a>
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