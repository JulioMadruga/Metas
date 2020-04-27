<?php
require_once 'database/conectar2.php';

$id = $_GET['id'];

if($_GET['tipo'] == "D"){

    $conn2->query("DELETE from ck_disnorte where id_check = $id ");

}else{

   $conn2->query("DELETE from ck_garoto where id_check = $id ");
}



header('Location: painel.php?result=ex');
die();