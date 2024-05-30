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

$sql = "SELECT ogradi, ogrsoyadi,ogrno FROM btbs404 WHERE ogrno='$ogrno' AND password='$password'";

$result = $baglanti->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
	$ogrno = $row["ogrno"];
    $isim = $row["ogradi"];
    $soyisim = $row["ogrsoyadi"];
    
    session_start();
	$_SESSION['ogrno'] = $ogrno;
    $_SESSION['isim'] = $isim;
	$_SESSION['soyisim'] = $soyisim;
    
	
	header("Refresh: 3; url=ana_sayfa.php"); 
    echo "Hoşgeldiniz...";
	echo "</br>";
    echo "</br>";
	echo $ogrno;
	echo "    ";
	echo $isim;
	echo "    ";
	echo $soyisim;
    exit();
} else {
    echo "Hatalı giriş. Lütfen tekrar deneyin.";
}

$baglanti->close();

?>
