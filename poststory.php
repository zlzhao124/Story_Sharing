<?php
    require 'database.php';
    session_start();
    $username = $_GET['username'];
    $story_id =  $_GET['story_id'];
    $story_title = $_GET['storytitle'];
    $story_content = $_GET['content'];
    $link = $_GET['link'];

    echo $username;
    echo "<br>";
    echo $story_id;
    echo "<br>";
    echo $story_title;
    echo "<br>";
    echo $story_content;
    echo "<br>";
    echo $link;

    
    $stmt = $mysqli->prepare("insert into story(username, story_id, story_title,story_content, link) values (?,?, ?, ?, ?)");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->bind_param('ssssi', $username, $story_id, $story_title, $story_content,$link);
    if (!$stmt->execute()){
        echo "Fail to post";
    }
    $stmt->close();
    echo "successsfully posted! ";

    //header("Location: mainpage.php");
    ?>