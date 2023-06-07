<?php

$hostname = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "gws_group27vs4";
$conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Connection not successful");
}
?>
