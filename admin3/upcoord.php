<?php

require_once '../Database/Conexao.php';

date_default_timezone_set('America/Cuiaba');
$date = date('M' );



$meta = $mes_meta["$date"];


$vend = $_GET['vend'];

echo '<br>';

echo $id = $_POST['vend'];
echo $vendedor = $_POST['vendedor'];
echo $email = $_POST['email'];


$atuavendedor = $conn->prepare("UPDATE cad_super set nome = '$vendedor', email = '$email' WHERE  id = $id");
$atuavendedor-> execute();

$atuavendedor2 = $conn->prepare("UPDATE supervisor set nome = '$vendedor' WHERE  nome = '$vend'");
var_dump($atuavendedor2);
$atuavendedor2-> execute();


$atuaemail = $conn->prepare("UPDATE usuarios set super = '$vendedor' where super = '$vend'");
$atuaemail-> execute();

//
//$atuasuper = $conn->prepare("UPDATE supervisor set nome = '$super', email = '$email' WHERE  rca = $rca");
//$atuasuper-> execute();



echo ("<script>alert('Solicitação Atualizada!!!');</script>");
header("Location:cadcood.php");