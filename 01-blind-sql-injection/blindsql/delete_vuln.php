<?php
ini_set('display_errors', 0); // hide errors

$conn = new mysqli("localhost", "vulnuser", "password", "blindSQL");

$id = $_GET['id'];

$query = "DELETE FROM users WHERE id = '$id'";
$conn->query($query);

echo "User deleted (if ID exists).";
$conn->close();
?>
