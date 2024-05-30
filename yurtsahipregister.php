<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "btbs404";

$baglanti = new mysqli($servername, $username, $password, $database);

if ($baglanti->connect_error) {
    die("Bağlantı hatası: " . $baglanti->connect_error);
}

$baglanti->set_charset("utf8");

$kimlikno = $_POST['kimlikno'];
$password = $_POST['password'];
$shpadi = $_POST['shpadi'];
$shpsoyadi = $_POST['shpsoyadi'];

$check_sql = "SELECT * FROM yurtsahip WHERE kimlikno = '$kimlikno'";
$result = $baglanti->query($check_sql);

if ($result->num_rows > 0) {
    echo "Bu öğrenci numarasına ait kayıt zaten mevcut. Şifrenizi unuttuysanız öğrenci işlerine başvurun.";
} else {
    $insert_sql = "INSERT INTO yurtsahip (kimlikno, password, shpadi, shpsoyadi) VALUES ('$kimlikno', '$password', '$shpadi', 
	'$shpsoyadi')";

    if ($baglanti->query($insert_sql) === TRUE) {
        echo "Kaydınız başarıyla oluşturuldu.";
    } else {
        echo "Hata: " . $insert_sql . "<br>" . $baglanti->error;
    }
}

$baglanti->close();
?>
