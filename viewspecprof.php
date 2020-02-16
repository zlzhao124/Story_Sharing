
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
 $viewinguser = $_GET['user'];
//first displays all the stories a user posted
 $stmt = $mysqli->prepare("select story_title, link, story_id from story where username = '".$viewinguser."'");

 if(!$stmt)
 {   
     printf("Query Prep Failed: %s\n", $mysqli->error);
     exit;
 }
 $stmt->execute();
 $stmt->bind_result( $title, $link, $id) ;

 echo("View Stories<br />");
echo "<br /><br />";
 while($stmt->fetch()){
    echo "<br />";
    echo "Title: ".$title;
    echo "<br />";
    echo "<a href=viewcontents.php?sid=$id&suser=$viewinguser>".$link."</a>";
    echo "<br /><br />";
}
$stmt->close();

//next displays all comments made by user (displays the story and the comment)
 $stmt2 = $mysqli->prepare("select s_username, story_id, comment from comments where c_username = '".$viewinguser."'");

 if(!$stmt2)
 {   
     printf("Query Prep Failed: %s\n", $mysqli->error);
     exit;
 }
 $stmt2->execute();
 $stmt2->bind_result($storyuser, $id, $comm) ;
echo "<br /><br />";
echo "<br /><br />";
 echo("View Comments<br />");
echo "<br /><br />";
 while($stmt2->fetch()){
    echo "<br />";
    echo "Story User: ".$title;
    echo "<br />";
    echo "Story ID: ".$id;
    echo "<br />";
   // echo "Link: ".$link;
    echo "Comment: ".$comm;
    echo "<br /><br />";
}
$stmt2->close();

// now it finally displays all the stories that the user has liked
$stmt3 = $mysqli->prepare("select s_username, story.story_title, story.link, story.story_id from likestory join story on (likestory.story_id=story.story_id and likestory.s_username = story.username) where liker = '".$viewinguser."'");

 if(!$stmt3)
 {
     printf("Query Prep Failed: %s\n", $mysqli->error);
     exit;
 }
 $stmt3->execute();

$stmt3->bind_result($storyuser, $storytitle, $link, $id);
echo "<br /><br />";
echo "<br /><br />";
 echo("Stories this user has liked<br />");
echo "<br /><br />";
 while($stmt3->fetch()){
    echo "<br />";
    echo "Story User: ".$storyuser;
    echo "<br />";
    echo "Story ID: ".$id;
    echo "<br />";
    echo "Story title: ".$storytitle;
    echo "<br />";
    echo "Story link: ";
    echo "<a href=viewcontents.php?sid=$id&suser=$storyuser>".$link."</a>";
    echo "<br /><br />";

}
$stmt3->close();





?>

<form action = "viewprofiles.php" methods = "POST">
<input type= "submit" name = "view" value = "Go Back" />
</form>


</body>
</html>
