<?php
include 'db_connect.php';

$query = "SELECT * FROM uploaded_images ORDER BY uploaded_at DESC";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    echo "<img src='" . $row['image_path'] . "' alt='" . $row['image_name'] . "' width='200'><br>";
}

$conn->close();
?>
