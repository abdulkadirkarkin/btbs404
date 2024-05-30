<?php
if (isset($_POST['odano'])) {
    $odano = $_POST['odano'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "btbs404";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $sql = "SELECT ogradi, ogrsoyadi, ogrno FROM yurtkayit WHERE odano = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $odano);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<p>" . $row['ogradi'] . " " . $row['ogrsoyadi'] . " <button class='send-message' data-ogrno='" . $row['ogrno'] . "'>Alıcı Seç </button></p>";
        }
    } else {
        echo "Bu odada öğrenci bulunmuyor";
    }

    $stmt->close();
    $conn->close();
}
?>
