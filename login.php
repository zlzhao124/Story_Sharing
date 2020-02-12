<?php
require 'database.php';
$user_guess = $_POST['username'];
$pwd_guess = $_POST['password'];

$stmt = $mysqli->prepare("select COUNT(*),username,password from users where username=?");

if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('s', $user_guess);
$stmt->execute();
$stmt->bind_result($cnt, $username, $hashedPass);

// $hashedPass = substr($hashedPass, 0 ,60);

$stmt->fetch();

$stmt->close();
//$cnt == 1 &&
// Compare the submitted password to the actual password hash
echo $hashedPass;
echo $pwd_guess;
if(password_verify($pwd_guess, $hashedPass)){
	// Login succeeded!
	session_start();
	$_SESSION['username'] = $username;
	$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
	
	header("Location: mainpage.php");
	exit;
} else{
	// Login failed
	echo"login failed, passwords dont match!";
	exit;
}
?>