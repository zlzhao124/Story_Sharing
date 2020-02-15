<?php

require 'database.php';

session_start();
$c_username = $_SESSION['username'];
$s_username = $_GET['suser'];
$story_id =  $_GET['sid'];

echo $c_username;
echo $s_username;
echo $story_id;

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
if ($s_username!=$c_username){
    echo "You can only delete stories you created";
    header("Location: mainpage.php");
    exit;
}
else {
$stmt2 = $mysqli->prepare("delete from comments where story_id = ? AND s_username = ?");
    if(!$stmt2){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt2->bind_param('is', $story_id, $s_username);
    $stmt2->execute();
    $stmt2->close();
   // header("Location: mainpage.php");

    $stmt1 = $mysqli->prepare("delete from story where story_id = ? AND username = ?");
    if(!$stmt1){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt1->bind_param('is', $story_id, $c_username);
    $stmt1->execute();
    $stmt1->close();
   header("Location: mainpage.php");
}

?>
