<?php
header('Content-Type: application/json');

// Connect to MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "people_counter";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

// Get latest entry
$sql = "SELECT people_in, people_out, total_inside FROM counts ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["people_in" => 0, "people_out" => 0, "total_inside" => 0]);
}

$conn->close();
?>
