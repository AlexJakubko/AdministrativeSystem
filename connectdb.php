<?php
$servername = "147.232.47.244";
$username = "Jakubko";
$password = "";
$dbname = "Jakubko";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "Connected successfully";
    mysqli_set_charset($conn, "utf8");
}
