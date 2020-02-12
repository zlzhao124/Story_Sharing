<!DOCTYPE html>
<html lang = 'en'>
    <head>
        <meta charset="utf-8"/>
        <title>Main Story Web page</title>
    </head>

    <style>
    body{font-size:100%; background-color:#c0c0c0;
    font-weight: lighter;
    background: lightblue;
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
 $user = $_SESSION['user'];

 $stmt = $mysqli->prepare("select username, story_title, story_content, link, story_id from story");
 if(!$stmt)
 {
     printf("Query Prep Failed: %s\n", $mysqli->error);
     exit;
 }
 $stmt->execute();
 $stmt->bind_result($user, $story_title, $story_content, $link, $story_id);
 echo"<h1>A list of current stories and comments</h1><br /> ";
 echo "Hi, <i>".$user."</i> ! Welcome to the News Sharing Site!!<br />";
 echo"Username, Title, Content";
 echo "<br /><br />";

 while($stmt->fetch()){
    printf("%s,%s,%s,%s<br />", htmlspecialchars($author), htmlspecialchars($title), htmlspecialchars($content), htmlspecialchars($link));
    echo "<a href=viewStory.php?val=$story_id>View Comments</a>";//view
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
    echo "<a href=deleteStory.php?val=$story_id>Delete Story with its comments</a>";//delete
    echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
    echo "<a href=editStory.php?val=$story_id>Edit Story content</a>";//edit
    echo "<br /><br />";
}
$stmt->close();

 ?>



<p>Here you can upload stories:<p>

<p>stories titles<p>
<textarea rows="6" cols="100" placeholder="Please type story title here." name="content" id="content"></textarea>

<p>stories content<p>
<textarea rows="6" cols="100" placeholder="Please type story content here." name="content" id="content"></textarea>

<label>Link:</label>
<input type="text" name="link" id="link" />
<br />
<input type= "submit" value = "POST" />

</body>
 </html>
