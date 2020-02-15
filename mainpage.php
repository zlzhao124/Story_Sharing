<!DOCTYPE html>
<html lang = 'en'>
    <head>
        <meta charset="utf-8"/>
        <title>Main Story Web page</title>
        <form action = "logout.php" methods = "POST">
        <input type= "submit" name = "Log Out" value = "Log Out" />
        </form>

    </head>

    <style>
    body{font-size:100%; background-color:#eaf0bb;
    font-weight: lighter;
    font-family: Arial;
    font-size: 30px;
     text-align: center
      };
    form{ display:inline-block};

</style>

<body>
<?php
 require 'database.php';
 session_start();
 $username1 = $_SESSION['username'];

 $stmt = $mysqli->prepare("select username, story_title, story_content, link, story_id from story");
 if(!$stmt)
 {
     printf("Query Prep Failed: %s\n", $mysqli->error);
     exit;
 }
 $stmt->execute();

 $stmt->bind_result($username, $story_title, $story_content, $link, $story_id);
 echo"<h1>Story Sharing Site</h1><br /> ";
 echo "Hi, our dear user  <i>".$username1."</i> ! Welcome to the Story Sharing Site!!<br />";
 echo "You can see a list of stories and their comments below.<br />";
 echo "<br /><br />";

 while($stmt->fetch()){
    printf("%s,%s,%s,%s<br />",
    htmlspecialchars("Story user:".$username),
    htmlspecialchars("Story title :".$story_title),
    htmlspecialchars("Story content:" .$story_content),
    htmlspecialchars("Story Link:" .$link),
    htmlspecialchars("Story id" .$story_id));
    echo "<a href=comment.php?sid=$story_id&suser=$username>Comment on This Story</a>";
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
    echo "<a href=viewcomment.php?val=$story_id>View Story Comments</a>";
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
    echo "<a href=deletess.php?val=$story_id>Delete Story </a>";//delete
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
    echo "<a href=edit.php?val=$story_id>Edit Story content</a>";//edit
    echo "<br /><br />";
    
}
$stmt->close();
 ?>

<p>You can upload stories here :<p>
        <form action = "poststory.php" methods = "POST">
    <label>Please enter your Username(must be same as your login username!):</label>
    <input type="text" name="username" id="username" />
    <label>New Story Title:</label>
    <input type="text" name="storytitle" id="storytitle" />
    <label>Stories content:</label>
    <textarea rows="6" cols="150" placeholder="Please type story content here." name="content" id="content"></textarea>
    <label> Story Link:</label>
    <input type="text" name = "link" id = "link" />
    <label> Story id:</label>
    <input type="integer" name = "story_id" id = "story_id" />
<input type= "submit" name = "submit" value = "submit" />

</form>


</body>
 </html>
