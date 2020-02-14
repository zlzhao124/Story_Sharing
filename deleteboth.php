<?php

require 'database.php';
echo $c_username;
echo "<br>";
echo $s_username;
echo "<br>";
echo $story_id;
echo "<br>";
echo $comment;
session_start();
$c_username = $_SESSION['username'];
$s_username = $_GET['loginuser'];
$story_id =  $_GET['sid'];

$stmt = $mysqli->prepare("select username from story where story_id=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('i', $story_id);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();
if ($s_username!=$username){
    echo "You can only delete the story you created";
    header("Location: mainpage.php");
    exit;
} 
else {
    $stmt1 = $mysqli->prepare("delete from comments where story_id=?");
    if(!$stmt1){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt1->bind_param('i', $story_id);
    $stmt1->execute();
    $stmt1->close();
    header("Location: mainpage.php");
}

$stmt2 = $mysqli->prepare("delete from story where story_id=?");
if(!$stmt2){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt2->bind_param('i', $story_id);
$stmt2->execute();
$stmt2->close();

?>
