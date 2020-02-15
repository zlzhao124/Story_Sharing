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


?>
