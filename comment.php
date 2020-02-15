<?php

require 'database.php';
include 'comment.php';
$comment = $_POST['name'];
    echo $c_username;
    echo "<br>";
    echo $s_username;
echo "<br>";
    echo $story_id;
echo "<br>";
echo $comment;

 $stmt = $mysqli->prepare("insert into comments(c_username, s_username, comment,story_id) values (?,?, ?, ?)");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('ssss', $c_username, $s_username, $comment, $story_id);
    if (!$stmt->execute()){
        echo "Fail to post";
    }
    else{
        echo "comment posted!";
        }

    $stmt->close();


?><!DOCTYPE html>
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
