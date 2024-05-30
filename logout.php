<?php
session_start();

session_unset();

session_destroy();

header("Location: ana_sayfa.php");
exit();
?>
