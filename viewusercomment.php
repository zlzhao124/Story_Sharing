<!DOCTYPE html>
<html>
<head><title>Bold Printer</title></head>
<body>
<style>
    body{font-size:100%; background-color:#eaf0bb;
    font-weight: lighter;
    font-family: Arial;
    font-size: 30px;
     text-align: center
      };

    form{ display:inline-block};

</style>


<?php
 require 'database.php';
 session_start();
 $user = $_SESSION['username'];

 $stmt = $mysqli->prepare("select s_username,comment,story_id,comment_id from comments where c_username = '".$user."'");
//where story_id=?"
//now i can see every comment of every story but we dont want that
 if(!$stmt)
 {
     printf("Query Prep Failed: %s\n", $mysqli->error);
     exit;
 }
 $stmt->execute();
 $stmt->bind_result( $s_username,$comment, $story_id, $comment_id) ;

 echo("View Comments<br />");
echo "<br /><br />";
 while($stmt->fetch()){
    echo "<br /><br />";
    echo "*Story User ".$s_username." <br /><br /> ";
    echo "comment: ".$comment."  ";
    echo "<br /><br />";
    echo "story id:".$story_id;
    echo "<a href=editcomment.php?sid=$story_id&suser=$s_username&comm=$comment_id>Edit Comment</a>";
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
    echo "<a href=deleteusercomment.php?sid=$story_id&suser=$s_username&comm=$comment_id>Delete Comment</a>";
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
}
$stmt->close();



?>
</body>
</html>
