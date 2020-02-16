<?php
require 'database.php';
session_start();

$currentuser = $_SESSION['username'];
$story_id = $_GET['sid'];
$username = $_GET['suser'];
echo $story_id;


/*
$stmt1 = $mysqli->prepare("select count(*) from likestory");
if(!$stmt1){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
$stmt1->bind_result($totallikesize);
while($stmt1->fetch()){
    printf("%s<br />",
    htmlspecialchars("Size:".$totallikesize));
}





if (!$stmt1->execute()){
        echo "Fail to dislike";
    }

echo $totallikesize;
*/

$stmt2 = $mysqli->prepare("delete from likestory where liker = ? AND s_username = ? AND story_id = ?");
    if(!$stmt2){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt2->bind_param('sss',$currentuser, $username, $story_id);
    if (!$stmt2->execute()){
        echo "Fail to dislike";
    }

    else{
/*
$stmt3 = $mysqli->prepare("select count(*) from likestory");
if(!$stmt3){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
$stmt3->bind_result($totallikesize);
if (!$stmt3->execute()){
        echo "Fail to dislike";
    }

echo $totallikesize2;

if ($totallikesize2 < $totallikesize){
*/
        $stmt = $mysqli->prepare("update story set numlikes=numlikes-1 where story_id=? AND username = ? ");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    echo "reached";
    exit;
}

$stmt->bind_param('ss', $story_id, $username);
$stmt->execute();
}






    $stmt2->close();

?>

