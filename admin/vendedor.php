<?php
require_once '../Database/Conexao.php';

$vendedor = $_POST['vendedor'];
$email = $_POST['email'];
$meta = $_POST['mes'];
$regiao = $_POST['regiao'];
$rca = $_POST['rca'];
$super = trim($_POST['super']);


if($vendedor == null  || $email == null || $regiao == null ){

    if($vendedor == null) {

        echo("<script>alert('Favor informar o vendedor');</script>");

    }

    if($email == null) {

        echo("<script>alert('Favor informar o email');</script>");

    }

    if($regiao == null) {

        echo("<script>alert('Favor Informar a Região');</script>");

    }

     echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrar.php'>";



}else{



    $Cad_Vend= $conn->prepare("INSERT INTO usuarios (rca,nome, email, senha, tipo, acesso, nacesso,regiao,super) values ('$rca','$vendedor','$email','agilvendas','logar','2015-09-23','0','$regiao','$super')");
    var_dump($Cad_Vend);
    $Cad_Vend->execute();


    $Cad_Vend2= $conn->prepare("INSERT INTO $meta (vendedor,rca,trimarca, meta_baton, tab, valor_choc, posit_rech, posit_cookies, valor_bisc, valor  ) values ('$vendedor','$rca','0','0','0','0','0','0','0','0')");
    var_dump($Cad_Vend2);
    $Cad_Vend2->execute();

    echo ("<script>alert('O Vendedor ".$vendedor." foi cadastrado com Sucesso !!!');</script>");




   echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cadastrar.php'>";
}

?>