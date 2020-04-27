<?php
require 'Database/Conexao.php';

$razao = $_POST['razao'];
$cnpj = $_POST['cnpj'];
$rca = $_GET['rca'];
$cnpj2 = str_replace('/','',str_replace('-','',str_replace('.','',$cnpj)));
$email = $_POST['email'];
$canal = $_POST['canal'];

$contato = $_POST['contato'];
$fone = $_POST['fone'];

echo $razao.'<br>';
echo $rca.'<br>';
echo str_replace('/','',str_replace('-','',str_replace('.','',$cnpj))).'<br>';
echo $canal.'<br>';

$verif = $conn->prepare("select cnpj from solicitacao where cnpj = $cnpj2");
$verif -> execute();
$result_verif= $verif ->fetchAll();

if(empty($result_verif)) {


    $cadcliente = $conn->prepare("Insert into solicitacao (rca,cnpj,razao,estado,obs,email,dataini,datafim,canal,fone,contato,dt_encerrado,cod_sap) VALUES ('$rca','$cnpj2','$razao','Pendente','','$email',curdate(),CURDATE() + INTERVAL 20 DAY,'$canal','$fone','$contato',null,null)");
    var_dump($cadcliente);
    $cadcliente->execute();

    echo ("<script>alert('Solicitação Enviada com Sucesso!!!');</script>");
    header("Location:cadastro.php?result=ok");

}

echo '<script> alert("JÁ EXISTE UMA SOLICITAÇÃO PARA ESTE CNPJ'.$CNPJ.'");window.history.go(-1); </script>';die;

echo ("<script>alert('Dados Atualizado com Sucesso!!!');window.history.go(-1);</script>"); die;


?>