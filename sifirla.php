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

$ogrno = $_POST['ogrno'];
$gizli = $_POST['gizli'];
$new_password = $_POST['password'];

$sql = "SELECT ogradi, ogrsoyadi FROM btbs404 WHERE ogrno='$ogrno' AND gizli='$gizli'";
$result = $baglanti->query($sql);

if ($result->num_rows > 0) {
    $update_sql = "UPDATE btbs404 SET password='$new_password' WHERE ogrno='$ogrno' AND gizli='$gizli'";
    if ($baglanti->query($update_sql) === TRUE) {
        $row = $result->fetch_assoc();
        $isim = $row["ogradi"];
        $soyisim = $row["ogrsoyadi"];

        session_start();
        $_SESSION['isim'] = $isim;
        $_SESSION['soyisim'] = $soyisim;

        header("Refresh: 3; url=ana_sayfa.php"); 
        echo "Şifreniz başarıyla güncellendi, hoşgeldiniz...";
        echo "</br>";
        echo "</br>";
        echo $isim;
        echo " ";
        echo $soyisim;
    } else {
        echo "Şifre güncellenemedi. Lütfen tekrar deneyin.";
    }
} else {
    echo "Hatalı giriş. Lütfen öğrenci numaranızı ve gizli sözcüğünüzü kontrol edin.";
}

$baglanti->close();
?>
