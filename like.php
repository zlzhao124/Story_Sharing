<?php
require 'database.php';
session_start();
$story_id = $_POST['story_id'];
echo $story_id;

$stmt = $mysqli->prepare("update story set like=like+1 where story_id=? ");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    echo "reached";
    exit;
}

$stmt->bind_param('s', $story_id);
$stmt->execute();

// header("Location: mainpage.php?id=".$story_id);


?>