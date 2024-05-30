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
$password = $_POST['password'];
$gizli = $_POST['gizli'];
$ogradi = $_POST['ogradi'];
$ogrsoyadi = $_POST['ogrsoyadi'];
	 session_start();
	$_SESSION['ogrno'] = $ogrno;
    $_SESSION['isim'] = $ogradi;
	$_SESSION['soyisim'] = $ogrsoyadi;
  

$check_sql = "SELECT * FROM btbs404 WHERE ogrno = '$ogrno'";
$result = $baglanti->query($check_sql);

if ($result->num_rows > 0) {
    echo "Bu öğrenci numarasına ait kayıt zaten mevcut. Şifrenizi unuttuysanız öğrenci işlerine başvurun.";


} else {
    $insert_sql = "INSERT INTO btbs404 (ogrno, password, gizli,ogradi, ogrsoyadi) VALUES ('$ogrno', '$password', '$gizli', '$ogradi', '$ogrsoyadi')";

    if ($baglanti->query($insert_sql) === TRUE) {
        echo "Kaydınız başarıyla oluşturuldu.";

  
	
	header("Refresh: 3; url=ana_sayfa.php"); 
    echo "</br>";
    echo "Hoşgeldiniz...";
	echo "</br>";
	echo $ogrno;
	echo "    ";
	echo $ogradi;
	echo "    ";
	echo $ogrsoyadi;
    echo "</br>";
	echo "3 Saniye İçinde Anasayfaya Yönlendiriliyorsunuz";
    } else {
        echo "Hata: " . $insert_sql . "<br>" . $baglanti->error;
    }
}

$baglanti->close();
?>
