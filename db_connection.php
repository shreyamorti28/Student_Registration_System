<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change this according to your database settings
$password = "";
$dbname = "student_db"; // The name of the database you created

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
