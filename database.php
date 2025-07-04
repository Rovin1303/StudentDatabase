<?php
$servername = "localhost";
$username = "root";
$password = "";
$port = 4306; // ✅ change if your XAMPP shows something else
$database = "studentdb";

$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}
else
{
    echo "Database is connected.";
}
?>
