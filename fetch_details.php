<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btbs404";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Bağlantı hatası: ' . $conn->connect_error]));
}

$yurtadi = $_POST['yurtadi'];
$sql = "SELECT wifi, klima, banyo, yatak, balkon, televizyon, dolap, telefon, resim_url FROM yurtkars WHERE yurtadi = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $yurtadi);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Yurt bulunamadı']);
}

$stmt->close();
$conn->close();
?>
