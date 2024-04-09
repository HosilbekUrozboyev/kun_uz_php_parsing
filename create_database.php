<?php
include 'connect.php';

// Create database
$sql = "CREATE DATABASE kun_uz";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?>