<?php
session_start();
require_once 'User.php';

$user = new User($conn);
$user->logout();

// Redirect to login page after logout
header("Location: login.php");
exit;
?>
