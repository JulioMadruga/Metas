<?php
$site = "http://localhost/AnalisePDV";
$servidor ="localhost";    // servidor
$username = "root";        // usuário
$password = "";            // senha
$banco = "garoto";              // banco


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