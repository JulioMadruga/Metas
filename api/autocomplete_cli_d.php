<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Cuiaba');

include_once "../database/conectar2.php";

if(isset($_POST['search'])){
    $search = $_POST['search'];


    if(is_numeric($search)== true){
        $query = "SELECT * FROM clientes WHERE cnpj like'%".$search."%'";
        $result = mysqli_query($conn,$query);
    }else{
        $query = "SELECT * FROM clientes WHERE razao like'%".$search."%'";
        $result = mysqli_query($conn,$query);
    }


    while($row = mysqli_fetch_array($result) ){
        $response[] = array("label"=>$row['razao'],"id_cli"=>$row['cod_cli'], "cnpj"=>$row['cnpj'],
            "cidade"=>$row['cidade'],"rca"=>$row['rca'], "vend"=>$row['vendedor']);
    }

    echo json_encode($response);
}

exit;