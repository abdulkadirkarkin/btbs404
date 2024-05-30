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



?>