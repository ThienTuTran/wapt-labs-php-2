<?php
ini_set('display_errors', 0); // hide errors

$conn = new mysqli("localhost", "vulnuser", "password", "blindSQL");

$user = $_GET['user'];
$pass = $_GET['pass'];

$query = "INSERT INTO users (username, password)
          SELECT '$user', '$pass'
          WHERE $user";

$conn->query($query);

echo "User inserted (if condition true).";
$conn->close();
?>
