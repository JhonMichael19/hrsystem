<?php
$servername = "localhost";
$username = "root"; // Change if using a different username
$password = ""; // Change if you have a database password
$database = "company_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
