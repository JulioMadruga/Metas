<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Cuiaba');

include_once "../database/conectar2.php";

if(isset($_POST['search'])){
    $search = $_POST['search'];

    $canal2 = [
        5534708 => 'Conveniência',
        5534706 => '5 CheckOut',
        5534716 => 'Atacado',
        5534711 => '3 CheckOut',
        5534705 => '1 CheckOut',
        5534707 => '4 CheckOut',
        5534710 => 'Tradicional',


    ];


    if(is_numeric($search)== true){
        $query = "SELECT * FROM clientes WHERE cnpj like'%".$search."%'";
        $result = mysqli_query($conn,$query);
    }else{
        $query = "SELECT * FROM clientes WHERE razao like'%".$search."%'";
        $result = mysqli_query($conn,$query);
    }


    while($row = mysqli_fetch_array($result) ){
        $response[] = array("label"=>$row['razao'],"id_cli"=>$row['cod_cli'], "cnpj"=>$row['cnpj'],
            "cidade"=>$row['cidade'],"rca"=>$row['rca'], "vend"=>$row['vendedor'],"canal"=>$row['hierarquia'], "canal2" => $canal2[$row['hierarquia']]);
    }

    echo json_encode($response);
}

exit;