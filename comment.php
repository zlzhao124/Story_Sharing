<!DOCTYPE html>
<html>
<head><title>Bold Printer</title></head>
<body>



<?php

require 'database.php';

    session_start();
    $c_username = $_SESSION['username'];
    $s_username = $_GET['suser'];
    $story_id =  $_GET['sid'];

  //  echo $c_username;
  //  echo $s_username;
  //  echo $story_id;

    $linkstring =  "comment2.php?sid=".$story_id."&suser=".$s_username;
 //   echo $linkstring;

   // echo $comment;


?>
<form action="<?php echo $linkstring; ?>"  method="POST">
        <p>
                <label for="name">Comment:</label>
                <input type="text" name="name" id="name" />
        </p>
        <p>
                <input type="submit" value="Comment" />
        </p>
</form>




</body>
</html>
