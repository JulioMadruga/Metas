<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Cuiaba');

include_once "../database/conectar.php";

if(isset($_POST['search'])){
    $search = $_POST['search'];

    $query = "SELECT * from produtos where id_prod not in 
              (SELECT a.id_prod from produtos a, itens_locados b where a.id_prod = b.id_prod and b.data_venc > now() GROUP by a.id_prod)
               and descricao like '%".$search."%'";
    $result = mysqli_query($conn,$query);

    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['id_prod'],"label"=>$row['descricao'],"H" => $row['p_hora'],"D"=>$row['p_dia'],"M"=>$row['p_mes']);
    }

    echo json_encode($response);
}

exit;