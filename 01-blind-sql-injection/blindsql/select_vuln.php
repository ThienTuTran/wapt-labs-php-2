<?php
ini_set('display_errors', 0); // hide errors

$conn = new mysqli("localhost", "vulnuser", "password", "blindSQL");

$id = $_GET['id'];
$query = "SELECT username FROM users WHERE id = '$id'";
$result = $conn->query($query);

if ($result && $row = $result->fetch_assoc()) {
    echo "User: " . $row['username'];
} else {
    echo "No results found.";
}
$conn->close();
?>
