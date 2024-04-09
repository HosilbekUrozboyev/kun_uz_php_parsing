<?php
include 'connect.php';
global $conn;

// sql to create table
$sql = "CREATE TABLE Maqolalar (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(250) NOT NULL,
image VARCHAR(250) NOT NULL,
time VARCHAR(100),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Maqolalar created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>