<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$host = "localhost";
$user = "root";
$password = "";
$database = "total_counter";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$date = isset($_GET['date']) ? $_GET['date'] : '';

if ($date) {
    $sql = "SELECT * FROM total WHERE DATE(timestamp) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $date);
} else {
    $sql = "SELECT * FROM total ORDER BY timestamp DESC";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($data);
?>
