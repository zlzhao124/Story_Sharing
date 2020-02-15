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
$comment_id = $_GET['comm'];

$linkstring =  "editcomment2.php?sid=".$story_id."&suser=".$s_username."&comm=".$comment_id;

?>

<form action="<?php echo $linkstring; ?>"  method="POST">
        <p>
                <label for="name">Retype your comment here to update it:</label>
                <textarea rows="6" cols="150" placeholder="Please type updated comment here." name="comment" id="comment"></textarea>

        </p>
        <p>
                <input type="submit" value="Comment" />
        </p>
</form>

</body>

</html>
