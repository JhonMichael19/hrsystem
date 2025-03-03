<?php
session_start();
include 'db_connect.php'; // Ensure this file connects to your database

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $targetDir = "uploads/"; // Directory where images will be saved
    $imageName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $imageName;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $allowedTypes = ["jpg", "jpeg", "png", "gif"];

    // Validate file type
    if (in_array($imageFileType, $allowedTypes)) {
        // Move uploaded file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Insert file path into the database
            $stmt = $conn->prepare("INSERT INTO uploaded_images (image_name, image_path) VALUES (, ?)");
            $stmt->bind_param("ss", $imageName, $targetFilePath);
            if ($stmt->execute()) {
                echo "Image uploaded successfully!";
            } else {
                echo "Database error: " . $conn->error;
            }
            $stmt->close();
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Invalid file type. Allowed: JPG, JPEG, PNG, GIF.";
    }
} else {
    echo "No file uploaded.";
}

$conn->close();
?>
