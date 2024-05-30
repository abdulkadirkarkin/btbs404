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

$sql = "SELECT shpadi, shpsoyadi FROM yurtsahip WHERE kimlikno='$kimlikno' AND password='$password'";

$result = $baglanti->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $isim = $row["shpadi"];
    $soyisim = $row["shpsoyadi"];
    
    session_start();
    $_SESSION['isim'] = $isim;
	$_SESSION['soyisim'] = $soyisim;
    
	
	header("Refresh: 3; url=yurtupdate.php"); 
    echo "Hoşgeldiniz...";
	echo "</br>";
    echo "</br>";
	echo $isim;
	echo "    ";
	echo $soyisim;
    exit();
} else {
    echo "Hatalı giriş. Lütfen tekrar deneyin.";
}

$baglanti->close();

?>
