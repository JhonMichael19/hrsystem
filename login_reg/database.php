<?php
$host = "localhost"; // Your MySQL host (usually 'localhost')
$db_user = "root";   // Your MySQL username
$db_password = "";   // Your MySQL password
$db_name = "hr_system"; // Your MySQL database name

// Create a connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
