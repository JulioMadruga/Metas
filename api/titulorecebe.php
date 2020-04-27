<?php

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Cuiaba');

include_once "../database/conectar.php";

$res = array('error' => false);

$action = 'read';

if(isset($_GET['action'])){
    $action = $_GET['action'];
}


if($action == 'read'){
    $result = $conn->query("SELECT DATE_FORMAT(a.dt_lanc ,'%d/%m/%Y')AS data1, DATE_FORMAT(a.dt_venc ,'%d/%m/%Y')AS data2, format(a.valor,2,'de_DE') as valor_total2, a.*,b.* FROM `titulos_receb` a, clientes b where a.id_cli = b.id_cli");
    $Trecebe = array();

    while($row = $result->fetch_assoc()){
        array_push($Trecebe, $row);
    }

    $res['Trecebe'] = $Trecebe;
}




if($action == 'baixar'){
    $idtitulo = $_POST['id_titulosreceb'];
//    $id = $_POST['id_cli'];
//    $razao= $_POST['razao'];
//    $fantasia= $_POST['fantasia'];
//
//
//    $cnpj = $_POST['cnpj'];
//    $ie = $_POST['ie'];
//    $cpf = $_POST['cpf'];
//    $rg = $_POST['rg'];
//
//    $sexo= $_POST['sexo'];
//    $fone = $_POST['fone'];
//    $celular= $_POST['celular'];
//    $email= $_POST['email'];
//    $contato= $_POST['contato'];
//    $fone_contato= $_POST['fone_contato'];
//    $email_contato= $_POST['email_contato'];
//    $cep= $_POST['cep'];
//    $rua= $_POST['rua'];
//    $numero= $_POST['numero'];
//    $bairro= $_POST['bairro'];
//    $cidade= $_POST['cidade'];
//    $uf= $_POST['uf'];


    $result = $conn->query("INSERT INTO `caixa` (`id_pedido`, `id_cli`, `id_user`, `valor`, `dt_venc`, `dt_lanc`,status)
                           VALUES ('$idped','$idcli','$iduser','$valor', DATE_ADD(now(),INTERVAL $intervalo day),NOW(),'0')");

    $result2 = $conn->query("UPDATE `titulos_receb` set status = '1' where id_titulosreceb = '$idtitulo'");




    if($result){
        $res['message'] = "Titulo Baixado com Sucesso!";
    } else{
        $res['error'] = true;
        $res['message'] = "Não foi possivel Baixar o título tente novamente, se percistir o erro contate o suporte.";
    }

}



if($action == 'delete'){
    $id = $_POST['id_cli'];

    $result = $conn->query("DELETE FROM `clientes` WHERE `id_cli` = '$id'");

    if($result){
        $res['message'] = "Produto Excluido com Sucesso";
    } else{
        $res['error'] = true;
        $res['message'] = "Não foi possivel Excluir o cadastro tente novamente, se percistir o erro contate o suporte.";
    }

}





$conn->close();

header("Content-type: application/json");
echo json_encode($res);
die();