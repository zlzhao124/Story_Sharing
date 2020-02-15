<!DOCTYPE html>
<html>
<head><title>Bold Printer</title></head>
<body>

<?php

require 'database.php';

session_start();
$current_user = $_SESSION['username'];
$s_username = $_GET['suser'];
$story_id =  $_GET['sid'];

$linkstring =  "editstory2.php?sid=".$story_id."&suser=".$s_username;


if ($s_username!=$current_user){
    echo "You can only edit the story you created!!!";
    header("Location: mainpage.php");
}
?>

<form action="<?php echo $linkstring; ?>"  method="POST">
        <p>
                <label for="name">Retype your story here to update it:</label>
                <textarea rows="6" cols="150" placeholder="Please type story content here." name="content" id="content"></textarea>

        </p>
        <p>
                <input type="submit" value="Comment" />
        </p>
</form>

</body>

</html>

