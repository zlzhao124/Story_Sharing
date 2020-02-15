
<?php
require 'database.php';
session_start();
$story_id =  $_GET['sid'];

$stmt = $mysqli->prepare("update story set like=like+1 where story_id=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('s', $story_id);
header("Location: main.php");

?>