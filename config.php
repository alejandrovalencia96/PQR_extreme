<?php

$servername = "localhost";
$database = "extreme";
$username = "root";
$password = "";

// Create connection
$connDominio = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$connDominio) {
    die("Connection failed: " . mysqli_connect_error());
}
// Cambiamos el charset a utf8
mysqli_set_charset($connDominio,"utf8");

//echo "Connected successfully";
//mysqli_close($connDominio);

?>
