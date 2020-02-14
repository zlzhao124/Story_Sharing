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

$linkstring =  "comment2.php?sid=".$story_id."&loginuser=".$s_username;


$stmt = $mysqli->prepare("select s_username from comments where story_id=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('ssss', $s_username,  $story_id);
if (!$stmt->execute()){
    echo "Fail to have username";
}

$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();

if ($s_username!=$username){
    echo "You can only edit the story you created!!!";
    header("Location: mainpage.php");
}
?>