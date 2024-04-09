<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kun_uz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Bazaga muvaffaqiyatli bog'landi <br>";
?>


