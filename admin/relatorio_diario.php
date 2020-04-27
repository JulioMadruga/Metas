<?php

session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.html");
}

include_once '../Database/Conexao.php';

$id2 = $_SESSION['user_session'];

$dados_user = $conn->prepare("SELECT * FROM usuarios where id = $id2");
//var_dump($dados_user);
$dados_user->execute();
$result = $dados_user->fetchAll();

$id_user = $result[0]['id'];
$usuario = $result[0]['nome'];


date_default_timezone_set('America/Cuiaba');

//$id = $usuario;
$date = date('Ymd' );


$data = date('D');
$mes = date('M');
$dia = date('d');
$ano = date('Y');

$mes_meta = array(
    'Jan' => 'meta1',
    'Feb' => 'meta2',
    'Mar' => 'meta3',
    'Apr' => 'meta4',
    'May' => 'meta5',
    'Jun' => 'meta6',
    'Jul' => 'meta7',
    'Aug' => 'meta8',
    'Nov' => 'meta11',
    'Sep' => 'meta9',
    'Oct' => 'meta10',
    'Dec' => 'meta12'
);

$mes_extenso = array(
    'Jan' => 'Janeiro',
    'Feb' => 'fevereiro',
    'Mar' => 'Marco',
    'Apr' => 'Abril',
    'May' => 'Maio',
    'Jun' => 'Junho',
    'Jul' => 'Julho',
    'Aug' => 'Agosto',
    'Nov' => 'Novembro',
    'Sep' => 'Setembro',
    'Oct' => 'Outubro',
    'Dec' => 'Dezembro'
);

$meta = $mes_meta["$mes"];

$mes = $mes_extenso["$mes"];


$translate = array(
    0 => "Dom",
    1 => "Seg",
    2 => "Ter",
    3 => "Qua",
    4 => "Qui",
    5 => "Sex",
    6 => "Sab",
);


$consulta_cood = $conn->prepare("SELECT DISTINCT super FROM usuarios where super <> '' ORDER by regiao, super");
$consulta_cood->execute();
$result_cood = $consulta_cood->fetchAll();

//var_dump($result_cood);

$i= 0;
foreach ($result_cood as $key=>$value){

    if (strlen($value['super']) !== 0){

     $cood = $value['super'];

        $consulta_geral = $conn->prepare("SELECT b.super, a.rca, b.nome, a.tab, a.Rgeral, a.flexx_geral, (a.tab - (a.Rgeral + a.flexx_geral)) as gapgeral, a.meta_baton, a.Rbaton, a.flexx_baton, (a.meta_baton - (a.Rbaton + a.flexx_baton)) as gapbaton, a.trimarca, a.Rbisc, a.flexx_bisc, (a.trimarca - (a.Rbisc + a.flexx_bisc)) as gapbisc FROM $meta a, usuarios b WHERE a.rca = b.Rca and b.super = '$cood' ORDER by b.super, gapgeral");
        $consulta_geral->execute();
        $result_geral[$i]= $consulta_geral->fetchAll();


        $consulta_total = $conn->prepare("SELECT b.super, a.rca, b.nome, sum(a.tab), sum(a.Rgeral), sum(a.flexx_geral), sum((a.tab - (a.Rgeral + a.flexx_geral))) as gapgeral, sum(a.meta_baton), sum(a.Rbaton), sum(a.flexx_baton), sum((a.meta_baton - (a.Rbaton + a.flexx_baton))) as gapbaton, sum(a.trimarca), sum(a.Rbisc), sum(a.flexx_bisc), sum((a.trimarca - (a.Rbisc + a.flexx_bisc))) as gapbisc FROM $meta a, usuarios b WHERE a.rca = b.Rca and b.super = '$cood' ORDER by b.super, b.nome");
        $consulta_total ->execute();
        $result_total [$i]= $consulta_total ->fetchAll();



       // var_dump($result_geral[$i]);


        $i++;

    }

}



$consulta_Norte= $conn->prepare("SELECT b.super, a.rca, b.nome, sum(a.tab), sum(a.Rgeral), sum(a.flexx_geral), sum((a.tab - (a.Rgeral + a.flexx_geral))) as gapgeral, sum(a.meta_baton), sum(a.Rbaton), sum(a.flexx_baton), sum((a.meta_baton - (a.Rbaton + a.flexx_baton))) as gapbaton, sum(a.trimarca), sum(a.Rbisc), sum(a.flexx_bisc), sum((a.trimarca - (a.Rbisc + a.flexx_bisc))) as gapbisc FROM $meta a, usuarios b WHERE a.rca = b.Rca and b.Regiao = 'norte' ORDER by b.super, b.nome");
$consulta_Norte ->execute();
$result_Norte= $consulta_Norte ->fetchAll();


$consulta_Sul= $conn->prepare("SELECT b.super, a.rca, b.nome, sum(a.tab), sum(a.Rgeral), sum(a.flexx_geral), sum((a.tab - (a.Rgeral + a.flexx_geral))) as gapgeral, sum(a.meta_baton), sum(a.Rbaton), sum(a.flexx_baton), sum((a.meta_baton - (a.Rbaton + a.flexx_baton))) as gapbaton, sum(a.trimarca), sum(a.Rbisc), sum(a.flexx_bisc), sum((a.trimarca - (a.Rbisc + a.flexx_bisc))) as gapbisc FROM $meta a, usuarios b WHERE a.rca = b.Rca and b.Regiao = 'Sul' ORDER by b.super, b.nome");
$consulta_Sul ->execute();
$result_Sul= $consulta_Sul->fetchAll();

$consulta_Tot= $conn->prepare("SELECT b.super, a.rca, b.nome, sum(a.tab), sum(a.Rgeral), sum(a.flexx_geral), sum((a.tab - (a.Rgeral + a.flexx_geral))) as gapgeral, sum(a.meta_baton), sum(a.Rbaton), sum(a.flexx_baton), sum((a.meta_baton - (a.Rbaton + a.flexx_baton))) as gapbaton, sum(a.trimarca), sum(a.Rbisc), sum(a.flexx_bisc), sum((a.trimarca - (a.Rbisc + a.flexx_bisc))) as gapbisc FROM $meta a, usuarios b WHERE a.rca = b.Rca ORDER by b.super, b.nome");
$consulta_Tot ->execute();
$result_Tot= $consulta_Tot->fetchAll();





?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultados Diários</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


    <style>
        *{
             border: solid 2px white !important
        }

        .negativo{
            text-align: center;
            color: #ff1c2b;
            background: rgba(255,28,43,0.5)
        }
        .positivo{
            text-align: center;
            color: #5dc35a;
            background:rgba(117,244,113,0.5)

        }
        .azul{
            background: #72b1f494;
        }
        .vermelho{
            background: #efa3aa9e;
        }
        .amarelo{
            background: #efd895a3;
        }
        .branco{
            color: white !important;
        }

    </style>

</head>

<body>

<div style="margin-top: 20px" class="col-md-12" style="right: 20px; top: -5px"> <button style="float: right; cursor: pointer" class="btn-default" id="btnExport"><img src="../images/excel.png" width="40px" height="40px" /> Exportar para Excel</button>  </div>


<div style="padding: 50px">
<?php

$z=0;


foreach ($result_cood as $key=>$value){


    if (strlen($value['super']) !== 0){

        echo '<table id="tblExport"  class="table">';

       // echo "<h1 style='background: '>".$value['super']."</h1>";


                echo '
                      <thead class="thead-dark">
                      <tr>
                      <th style="text-align: center" colspan="14">'.$value['super'].'</th>
                      </tr>
                      </thead>
                      <thead>
                      <tr>
                      <th class="bg-primary branco" style="text-align: center" colspan="6">Positivação Geral</th>
                      <th class="bg-danger branco" style="text-align: center" colspan="4">Positivação Baton</th>
                      <th class="bg-warning branco" style="text-align: center" colspan="4">Positivação Biscoitos</th>
                      </tr>
                      </thead>
                      
                        <tr>
                          <th class="bg-primary branco"scope="col" style="width: 45px">Ranking</th>
                          <th class="bg-primary branco centerth" style="width: 200px !important;" >Vendedores</th>
                          <th class="bg-primary branco text-center"scope="col">Meta Geral</th>
                          <th class="bg-primary branco text-center"scope="col">Faturado</th>
                          <th class="bg-primary branco text-center"scope="col">Transmitido</th>
                          <th class="bg-primary branco text-center"scope="col">Gap</th>
                          
                          <th class="bg-danger branco text-center" scope="col">Meta Geral</th>
                          <th class="bg-danger branco text-center" scope="col">Faturado</th>
                          <th class="bg-danger branco text-center" scope="col">Transmitido</th>
                          <th class="bg-danger branco text-center" scope="col">Gap</th>
                          
                          <th class="bg-warning branco text-center" scope="col">Meta Geral</th>
                          <th class="bg-warning branco text-center" scope="col">Faturado</th>
                          <th class="bg-warning branco text-center" scope="col">Transmitido</th>
                          <th class="bg-warning branco text-center" scope="col">Gap</th>
                          
                        </tr>
                      </thead> <tbody> ';


                $i =1;
        foreach ($result_geral[$z] as $row){

            echo '<tr>';

                   echo  "<td class='azul' scope='row'>$i.º</td>
                          <th class='azul' scope='row'>$row[2]</th>
                          <td class='azul text-center'>$row[3]</td>
                          <td class='azul text-center'>$row[4]</td>
                          <td class='azul text-center'>$row[5]</td>";

                          if ($row[6] > 0){

                              echo "<td class='negativo'>$row[6]</td>";

                          }else{

                              echo "<td class='positivo'>$row[6]</td>";
                          }

                          echo"
                          
                          <td class='vermelho text-center'>$row[7]</td>
                          <td class='vermelho text-center'>$row[8]</td>
                          <td class='vermelho text-center'>$row[9]</td>";

                          if ($row[10] > 0){

                              echo "<td class='negativo'>$row[10]</td>";

                          }else{

                              echo "<td class='positivo'>$row[10]</td>";
                          }

                          echo"
                          
                          <td class='amarelo text-center'>$row[11]</td>
                          <td class='amarelo text-center'>$row[12]</td>
                          <td class='amarelo text-center'>$row[13]</td>";

                          if ($row[14] > 0){

                              echo "<td class='negativo'>$row[14]</td>";

                          }else{

                              echo "<td class='positivo'>$row[14]</td>";
                          }







            echo '</tr>';

                          $i++;

        }




        echo '</tbody>';

        foreach ($result_total[$z] as $row) {

            echo '<tfoot style="background: #25272a; color: white">';
            echo '<tr>';

            echo '<td colspan="2">Total</td>';

            echo '<td class="text-center">'.$row[3].'</td>';
            echo '<td class="text-center">'.$row[4].'</td>';
            echo '<td class="text-center">'.$row[5].'</td>';
            echo '<td class="text-center">'.$row[6].'</td>';
            echo '<td class="text-center">'.$row[7].'</td>';
            echo '<td class="text-center">'.$row[8].'</td>';
            echo '<td class="text-center">'.$row[9].'</td>';
            echo '<td class="text-center">'.$row[10].'</td>';
            echo '<td class="text-center">'.$row[11].'</td>';
            echo '<td class="text-center">'.$row[12].'</td>';
            echo '<td class="text-center">'.$row[13].'</td>';
            echo '<td class="text-center">'.$row[14].'</td>';

            echo '</tr>';

            echo '</tfoot>';
        }






        $z++;


    }




    echo '</table>';

}

//------------------------------------------------NORTE---------------------------------------------------------------------

echo '<table id="tblExport"  class="table">';
echo '
                      <thead class="thead-dark">
                      <tr>
                      <th style="text-align: center" colspan="13">REGIÃO NORTE</th>
                      </tr>
                      </thead>
                      <thead>
                      <tr>
                      <th class="bg-primary branco" style="text-align: center" colspan="4">Positivação Geral</th>
                      <th class="bg-danger branco" style="text-align: center" colspan="4">Positivação Baton</th>
                      <th class="bg-warning branco" style="text-align: center" colspan="4">Positivação Biscoitos</th>
                      </tr>
                      </thead>
                      
                        <tr>                          
                          <th class="bg-primary branco text-center"scope="col">Meta Geral</th>
                          <th class="bg-primary branco text-center"scope="col">Faturado</th>
                          <th class="bg-primary branco text-center"scope="col">Transmitido</th>
                          <th class="bg-primary branco text-center"scope="col">Gap</th>
                          
                          <th class="bg-danger branco text-center" scope="col">Meta Geral</th>
                          <th class="bg-danger branco text-center" scope="col">Faturado</th>
                          <th class="bg-danger branco text-center" scope="col">Transmitido</th>
                          <th class="bg-danger branco text-center" scope="col">Gap</th>
                          
                          <th class="bg-warning branco text-center" scope="col">Meta Geral</th>
                          <th class="bg-warning branco text-center" scope="col">Faturado</th>
                          <th class="bg-warning branco text-center" scope="col">Transmitido</th>
                          <th class="bg-warning branco text-center" scope="col">Gap</th>
                          
                        </tr>
                      </thead> <tbody> ';


        foreach ($result_Norte as $row){

            echo '<tr>';

                   echo  "<td class='azul text-center'>$row[3]</td>
                          <td class='azul text-center'>$row[4]</td>
                          <td class='azul text-center'>$row[5]</td>";

                          if ($row[6] > 0){

                              echo "<td class='negativo'>$row[6]</td>";

                          }else{

                              echo "<td class='positivo'>$row[6]</td>";
                          }

                          echo"
                          
                          <td class='vermelho text-center'>$row[7]</td>
                          <td class='vermelho text-center'>$row[8]</td>
                          <td class='vermelho text-center'>$row[9]</td>";

                          if ($row[10] > 0){

                              echo "<td class='negativo'>$row[10]</td>";

                          }else{

                              echo "<td class='positivo'>$row[10]</td>";
                          }

                          echo"
                          
                          <td class='amarelo text-center'>$row[11]</td>
                          <td class='amarelo text-center'>$row[12]</td>
                          <td class='amarelo text-center'>$row[13]</td>";

                          if ($row[14] > 0){

                              echo "<td class='negativo'>$row[14]</td>";

                          }else{

                              echo "<td class='positivo'>$row[14]</td>";
                          }







            echo '</tr>';


        }




        echo '</tbody>';


     echo '</table>';




//---------------------------------------------------SUL------------------------------------------------------------------

echo '<table id="tblExport"  class="table">';
echo '
                      <thead class="thead-dark">
                      <tr>
                      <th style="text-align: center" colspan="13">REGIÃO SUL</th>
                      </tr>
                      </thead>
                      <thead>
                      <tr>
                      <th class="bg-primary branco" style="text-align: center" colspan="4">Positivação Geral</th>
                      <th class="bg-danger branco" style="text-align: center" colspan="4">Positivação Baton</th>
                      <th class="bg-warning branco" style="text-align: center" colspan="4">Positivação Biscoitos</th>
                      </tr>
                      </thead>
                      
                        <tr>                          
                          <th class="bg-primary branco text-center"scope="col">Meta Geral</th>
                          <th class="bg-primary branco text-center"scope="col">Faturado</th>
                          <th class="bg-primary branco text-center"scope="col">Transmitido</th>
                          <th class="bg-primary branco text-center"scope="col">Gap</th>
                          
                          <th class="bg-danger branco text-center" scope="col">Meta Geral</th>
                          <th class="bg-danger branco text-center" scope="col">Faturado</th>
                          <th class="bg-danger branco text-center" scope="col">Transmitido</th>
                          <th class="bg-danger branco text-center" scope="col">Gap</th>
                          
                          <th class="bg-warning branco text-center" scope="col">Meta Geral</th>
                          <th class="bg-warning branco text-center" scope="col">Faturado</th>
                          <th class="bg-warning branco text-center" scope="col">Transmitido</th>
                          <th class="bg-warning branco text-center" scope="col">Gap</th>
                          
                        </tr>
                      </thead> <tbody> ';


foreach ($result_Sul as $row){

    echo '<tr>';

    echo  "<td class='azul text-center'>$row[3]</td>
                          <td class='azul text-center'>$row[4]</td>
                          <td class='azul text-center'>$row[5]</td>";

    if ($row[6] > 0){

        echo "<td class='negativo'>$row[6]</td>";

    }else{

        echo "<td class='positivo'>$row[6]</td>";
    }

    echo"
                          
                          <td class='vermelho text-center'>$row[7]</td>
                          <td class='vermelho text-center'>$row[8]</td>
                          <td class='vermelho text-center'>$row[9]</td>";

    if ($row[10] > 0){

        echo "<td class='negativo'>$row[10]</td>";

    }else{

        echo "<td class='positivo'>$row[10]</td>";
    }

    echo"
                          
                          <td class='amarelo text-center'>$row[11]</td>
                          <td class='amarelo text-center'>$row[12]</td>
                          <td class='amarelo text-center'>$row[13]</td>";

    if ($row[14] > 0){

        echo "<td class='negativo'>$row[14]</td>";

    }else{

        echo "<td class='positivo'>$row[14]</td>";
    }







    echo '</tr>';


}




echo '</tbody>';


echo '</table>';


//---------------------------------------------------GERAL------------------------------------------------------------------

echo '<table id="tblExport"  class="table">';
echo '
                      <thead class="thead-dark">
                      <tr>
                      <th style="text-align: center" colspan="13">RESULTADO GERAL</th>
                      </tr>
                      </thead>
                      <thead>
                      <tr>
                      <th class="bg-primary branco" style="text-align: center" colspan="4">Positivação Geral</th>
                      <th class="bg-danger branco" style="text-align: center" colspan="4">Positivação Baton</th>
                      <th class="bg-warning branco" style="text-align: center" colspan="4">Positivação Biscoitos</th>
                      </tr>
                      </thead>
                      
                        <tr>                          
                          <th class="bg-primary branco text-center"scope="col">Meta Geral</th>
                          <th class="bg-primary branco text-center"scope="col">Faturado</th>
                          <th class="bg-primary branco text-center"scope="col">Transmitido</th>
                          <th class="bg-primary branco text-center"scope="col">Gap</th>
                          
                          <th class="bg-danger branco text-center" scope="col">Meta Geral</th>
                          <th class="bg-danger branco text-center" scope="col">Faturado</th>
                          <th class="bg-danger branco text-center" scope="col">Transmitido</th>
                          <th class="bg-danger branco text-center" scope="col">Gap</th>
                          
                          <th class="bg-warning branco text-center" scope="col">Meta Geral</th>
                          <th class="bg-warning branco text-center" scope="col">Faturado</th>
                          <th class="bg-warning branco text-center" scope="col">Transmitido</th>
                          <th class="bg-warning branco text-center" scope="col">Gap</th>
                          
                        </tr>
                      </thead> <tbody> ';


foreach ($result_Tot as $row){

    echo '<tr>';

    echo  "<td class='azul text-center'>$row[3]</td>
                          <td class='azul text-center'>$row[4]</td>
                          <td class='azul text-center'>$row[5]</td>";

    if ($row[6] > 0){

        echo "<td class='negativo'>$row[6]</td>";

    }else{

        echo "<td class='positivo'>$row[6]</td>";
    }

    echo"
                          
                          <td class='vermelho text-center'>$row[7]</td>
                          <td class='vermelho text-center'>$row[8]</td>
                          <td class='vermelho text-center'>$row[9]</td>";

    if ($row[10] > 0){

        echo "<td class='negativo'>$row[10]</td>";

    }else{

        echo "<td class='positivo'>$row[10]</td>";
    }

    echo"
                          
                          <td class='amarelo text-center'>$row[11]</td>
                          <td class='amarelo text-center'>$row[12]</td>
                          <td class='amarelo text-center'>$row[13]</td>";

    if ($row[14] > 0){

        echo "<td class='negativo'>$row[14]</td>";

    }else{

        echo "<td class='positivo'>$row[14]</td>";
    }







    echo '</tr>';


}




echo '</tbody>';


echo '</table>';












?>
</div>


</body>

<script src="../js/jquery.btechco.excelexport.js"></script>
<script src="../js/jquery.base64.js"></script>
<script>
    $(document).ready(function () {
        $("#btnExport").click(function () {
            $("#tblExport").btechco_excelexport({
                containerid: "tblExport"
                , datatype: $datatype.Table
                , filename: 'Realatorio de Positivação Diário'
            });
        });
    });
</script>

</html>

