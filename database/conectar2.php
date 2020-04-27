<?php
$site = "http://localhost/AnalisePDV";
$servidor ="garoto.mysql.dbaas.com.br";    // servidor
$username = "garoto";        // usuário
$password = "D!sN0rt3G@r0t0";            // senha
$banco = "garoto";


$conn2 = new PDO("mysql:host=$servidor;dbname=$banco", $username, $password,
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    )
);

$conn = new mysqli($servidor, $username, $password, $banco);
if($conn->connect_error){
    die("Could not connect to database!");
}




?>