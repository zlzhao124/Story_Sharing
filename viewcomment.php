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
 //echo $user;
 $storyid = $_GET['val'];
 $suser = $_GET['suser'];
 //echo $suser;

 $stmt = $mysqli->prepare("select c_username,comment,story_id from comments where story_id =".$storyid." AND s_username = '".$suser."'");
//where story_id=?"
//now i can see every comment of every story but we dont want that
 if(!$stmt)
 {
     printf("Query Prep Failed: %s\n", $mysqli->error);
     exit;
 }
 $stmt->execute();
 $stmt->bind_result( $c_username,$comment, $story_id) ;

 echo("View Comments<br />");
echo "<br /><br />";
 while($stmt->fetch()){
    echo "<br /><br />";
    echo "*By User ".$c_username." <br /><br /> ";
    echo "comments: ".$comment."  ";
}
$stmt->close();



?>
</body>
</html>
