<?php
$servername = "localhost"; // Server name
$username = "root"; // MySQL username
$password = ""; // MySQL password
$dbname = "items"; // Database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>