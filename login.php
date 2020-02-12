<?php
// This is a *good* example of how you can implement password-based user authentication in your web application.
require 'database.php';
$user = $_GET['username'];
session_start();

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];
//citation: https://stackoverflow.com/questions/6287903/how-to-properly-add-csrf-token-using-php
// Use a prepared statement
$stmt = $mysqli->prepare("SELECT COUNT(*), id, hashed_password FROM users WHERE username=?");

// Bind the parameter
$stmt->bind_param('s', $user);
$user = $_POST['username'];
$stmt->execute();
$stmt->bind_result($cnt, $user_id, $pwd_hash);
$stmt->fetch();

$pwd_guess = $_POST['password'];
// Compare the submitted password to the actual password hash

if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
	// Login succeeded!
	$_SESSION['user_id'] = $user_id;

	// Redirect to your target page
} else{
    echo "Login failed！Passwords Don't Match!";
} $stmt->close();
?>


