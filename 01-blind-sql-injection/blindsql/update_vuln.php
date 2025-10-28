<?php
ini_set('display_errors', 0); // hide errors

$conn = new mysqli("localhost", "vulnuser", "password", "blindSQL");

$id = $_GET['id'];
$newpass = $_GET['newpass'];

$query = "UPDATE users SET password = '$newpass' WHERE id = '$id'";
$conn->query($query);

echo "Password updated (if ID exists).";
$conn->close();
?>
