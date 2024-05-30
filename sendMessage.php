<?php
session_start();

if (isset($_POST['gondogradi']) && isset($_POST['gondogrsoyadi']) && isset($_POST['gondogrno']) && isset($_POST['aliciogrno']) && isset($_POST['message'])) {
    $gondogradi = $_POST['gondogradi'];
    $gondogrsoyadi = $_POST['gondogrsoyadi'];
    $gondogrno = $_POST['gondogrno'];
    $aliciogrno = $_POST['aliciogrno'];
    $message = $_POST['message'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "btbs404";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $sql = "INSERT INTO mesaj (gondogradi, gondogrsoyadi, gondogrno, aliciogrno, mesaj) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $gondogradi, $gondogrsoyadi, $gondogrno, $aliciogrno, $message);

    if ($stmt->execute()) {
        echo "Mesaj başarıyla gönderildi.";
    } else {
        echo "Mesaj gönderilirken hata oluştu.";
    }

    $stmt->close();
    $conn->close();
}
?>
