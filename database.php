<?php
    //connects to mysql
    $mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass','story');

    if($mysqli->connect_errno) {
        printf("Connection Failed: %s\n", $mysqli->connect_error);
        exit;
    }
?>