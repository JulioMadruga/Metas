<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Cuiaba');

include_once "../database/conectar.php";

if(isset($_POST['search'])){
    $search = $_POST['search'];

    if(is_numeric($search)){
        $query = "SELECT DISTINCT a.id_orcamento, b.razao, a.valor_total FROM orcamentos a,clientes b WHERE a.id_cli = b.id_cli and a.id_orcamento not in (SELECT id_orcamento from locacoes) and a.id_orcamento like'%".$search."%' and a.data_venc >= NOW()";
        $result = mysqli_query($conn,$query);

    }else{

        $query = "SELECT DISTINCT a.id_orcamento, b.razao, a.valor_total FROM orcamentos a,clientes b WHERE a.id_cli = b.id_cli and a.id_orcamento not in (SELECT id_orcamento from locacoes) and b.razao like'%".$search."%' and a.data_venc >= NOW()";
        $result = mysqli_query($conn,$query);

    }



    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['id_orcamento'],"label"=>$row['razao'],"vl_total"=>$row['valor_total']);
    }

    echo json_encode($response);
}

exit;