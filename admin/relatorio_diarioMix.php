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

        $consulta_geral = $conn->prepare("SELECT a.*, (a.metachoc - (a.realchoc + a.choc_flexx)) as gap from `ranking` a WHERE a.super = '$cood' ORDER by gap");
        $consulta_geral->execute();
        $result_geral[$i]= $consulta_geral->fetchAll();


        $consulta_total = $conn->prepare("SELECT sum(metachoc), sum(realchoc), sum(metabisc), sum(realbisc), SUM(choc_flexx), sum(bisc_flexx) from `ranking` WHERE super = '$cood'");
        $consulta_total ->execute();
        $result_total [$i]= $consulta_total ->fetchAll();



       // var_dump($result_geral[$i]);


        $i++;

    }

}



$consulta_Norte= $conn->prepare("SELECT sum(a.metachoc), sum(a.realchoc), sum(a.metabisc), sum(a.realbisc), SUM(a.choc_flexx), sum(a.bisc_flexx) from `ranking` a, usuarios b WHERE a.rca = b.Rca and b.Regiao = 'Norte'");
$consulta_Norte ->execute();
$result_Norte= $consulta_Norte ->fetchAll();


$consulta_Sul= $conn->prepare("SELECT sum(a.metachoc), sum(a.realchoc), sum(a.metabisc), sum(a.realbisc), SUM(a.choc_flexx), sum(a.bisc_flexx) from `ranking` a, usuarios b WHERE a.rca = b.Rca and b.Regiao = 'SUL'");
$consulta_Sul ->execute();
$result_Sul= $consulta_Sul->fetchAll();

$consulta_Tot= $conn->prepare("SELECT sum(metachoc), sum(realchoc), sum(metabisc), sum(realbisc), SUM(choc_flexx), sum(bisc_flexx) from `ranking`");
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
            background: #e0a38d69;
        }

        .marrom{
            background:#50362c
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
                      <th style="text-align: center" colspan="13">'.$value['super'].'</th>
                      </tr>
                      </thead>
                      <thead>
                      <tr>
                      <th class="marrom branco" style="text-align: center" colspan="6">MIX IDEAL CHOCOLATE</th>
                      <th class="bg-warning branco" style="text-align: center" colspan="4">MIX IDEAL BISCOITO</th>
                      </tr>
                      </thead>
                      
                        <tr>
                          <th class="marrom branco"scope="col" style="width: 45px">Ranking</th>
                          <th class="marrom branco"scope="col">Vendedores</th>
                          <th class="marrom branco text-center"scope="col">Meta Geral</th>
                          <th class="marrom branco text-center"scope="col">Faturado</th>
                          <th class="marrom branco text-center"scope="col">Transmitido</th>
                          <th class="marrom branco text-center"scope="col">Gap</th>
                          
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
                          <td class='azul'>$row[2]</td>
                          <td class='azul text-center'>$row[3]</td>
                          <td class='azul text-center'>$row[4]</td>
                          <td class='azul text-center'>$row[9]</td>";

                         $gap = $row[3] - ($row[4] + $row[9]);

                          if ($gap > 0){

                              echo "<td class='negativo'>$gap</td>";

                          }else{

                              echo "<td class='positivo'>$gap</td>";
                          }


                          echo " <td class='amarelo text-center'>$row[6]</td>
                          <td class='amarelo text-center'>$row[7]</td>
                          <td class='amarelo text-center'>$row[10]</td>";

                         $gap = $row[6] - ($row[7] + $row[10]);

                          if ($gap > 0){

                              echo "<td class='negativo'>$gap</td>";

                          }else{

                              echo "<td class='positivo'>$gap</td>";
                          }



            echo '</tr>';

                          $i++;

        }




        echo '</tbody>';

        foreach ($result_total[$z] as $row) {

            echo '<tfoot style="background: #25272a; color: white">';
            echo '<tr>';

            echo '<td colspan="2" style="text-align: center">Total</td>';

            echo '<td class="text-center">'.$row[0].'</td>';
            echo '<td class="text-center">'.$row[1].'</td>';
            echo '<td class="text-center">'.$row[4].'</td>';
            $gapchoco = $row[0] - ($row[1] + $row[4]);
            echo '<td class="text-center">'.$gapchoco.'</td>';
            echo '<td class="text-center">'.$row[2].'</td>';
            echo '<td class="text-center">'.$row[3].'</td>';
            echo '<td class="text-center">'.$row[5].'</td>';
            $gapbisc = $row[2] - ($row[3] + $row[5]);
            echo '<td class="text-center">'.$gapbisc.'</td>';

            echo '</tr>';

            echo '</tfoot>';
        }






        $z++;


    }




    echo '</table>';

}

//------------------------------------------------NORTE---------------------------------------------------------------------


 echo '<table id="tblExport"  class="table">';

       // echo "<h1 style='background: '>".$value['super']."</h1>";


                echo '
                      <thead class="thead-dark">
                      <tr>
                      <th style="text-align: center" colspan="13">NORTE</th>
                      </tr>
                      </thead>
                      <thead>
                      <tr>
                      <th class="marrom branco" style="text-align: center" colspan="4">MIX IDEAL CHOCOLATE</th>
                      <th class="bg-warning branco" style="text-align: center" colspan="4">MIX IDEAL BISCOITO</th>
                      </tr>
                      </thead>
                      
                        <tr>
                          <th class="marrom branco text-center"scope="col">Meta Geral</th>
                          <th class="marrom branco text-center"scope="col">Faturado</th>
                          <th class="marrom branco text-center"scope="col">Transmitido</th>
                          <th class="marrom branco text-center"scope="col">Gap</th>
                          
                          <th class="bg-warning branco text-center" scope="col">Meta Geral</th>
                          <th class="bg-warning branco text-center" scope="col">Faturado</th>
                          <th class="bg-warning branco text-center" scope="col">Transmitido</th>
                          <th class="bg-warning branco text-center" scope="col">Gap</th>
                          
                                                   
                        </tr>
                      </thead> <tbody> ';


        foreach ($result_Norte as $row){

            echo '<tr>';

                   echo  "<td class='azul text-center'>$row[0]</td>
                          <td class='azul text-center'>$row[1]</td>
                          <td class='azul text-center'>$row[4]</td>";

                         $gap = $row[0] - ($row[1] + $row[4]);

                          if ($gap > 0){

                              echo "<td class='negativo'>$gap</td>";

                          }else{

                              echo "<td class='positivo'>$gap</td>";
                          }


                          echo " <td class='amarelo text-center'>$row[2]</td>
                          <td class='amarelo text-center'>$row[3]</td>
                          <td class='amarelo text-center'>$row[5]</td>";

                         $gap = $row[2] - ($row[3] + $row[5]);

                          if ($gap > 0){

                              echo "<td class='negativo'>$gap</td>";

                          }else{

                              echo "<td class='positivo'>$gap</td>";
                          }



            echo '</tr>';


        }




        echo '</tbody>';



    echo '</table>';






//---------------------------------------------------SUL------------------------------------------------------------------


echo '<table id="tblExport"  class="table">';

// echo "<h1 style='background: '>".$value['super']."</h1>";


echo '
                      <thead class="thead-dark">
                      <tr>
                      <th style="text-align: center" colspan="13">SUL</th>
                      </tr>
                      </thead>
                      <thead>
                      <tr>
                      <th class="marrom branco" style="text-align: center" colspan="4">MIX IDEAL CHOCOLATE</th>
                      <th class="bg-warning branco" style="text-align: center" colspan="4">MIX IDEAL BISCOITO</th>
                      </tr>
                      </thead>
                      
                        <tr>
                          <th class="marrom branco text-center"scope="col">Meta Geral</th>
                          <th class="marrom branco text-center"scope="col">Faturado</th>
                          <th class="marrom branco text-center"scope="col">Transmitido</th>
                          <th class="marrom branco text-center"scope="col">Gap</th>
                          
                          <th class="bg-warning branco text-center" scope="col">Meta Geral</th>
                          <th class="bg-warning branco text-center" scope="col">Faturado</th>
                          <th class="bg-warning branco text-center" scope="col">Transmitido</th>
                          <th class="bg-warning branco text-center" scope="col">Gap</th>
                          
                                                   
                        </tr>
                      </thead> <tbody> ';


foreach ($result_Sul as $row){

    echo '<tr>';

    echo  "<td class='azul text-center'>$row[0]</td>
                          <td class='azul text-center'>$row[1]</td>
                          <td class='azul text-center'>$row[4]</td>";

    $gap = $row[0] - ($row[1] + $row[4]);

    if ($gap > 0){

        echo "<td class='negativo'>$gap</td>";

    }else{

        echo "<td class='positivo'>$gap</td>";
    }


    echo " <td class='amarelo text-center'>$row[2]</td>
                          <td class='amarelo text-center'>$row[3]</td>
                          <td class='amarelo text-center'>$row[5]</td>";

    $gap = $row[2] - ($row[3] + $row[5]);

    if ($gap > 0){

        echo "<td class='negativo'>$gap</td>";

    }else{

        echo "<td class='positivo'>$gap</td>";
    }



    echo '</tr>';


}




echo '</tbody>';



echo '</table>';






//---------------------------------------------------GERAL------------------------------------------------------------------



echo '<table id="tblExport"  class="table">';

// echo "<h1 style='background: '>".$value['super']."</h1>";


echo '
                      <thead class="thead-dark">
                      <tr>
                      <th style="text-align: center" colspan="13">GERAL</th>
                      </tr>
                      </thead>
                      <thead>
                      <tr>
                      <th class="marrom branco" style="text-align: center" colspan="4">MIX IDEAL CHOCOLATE</th>
                      <th class="bg-warning branco" style="text-align: center" colspan="4">MIX IDEAL BISCOITO</th>
                      </tr>
                      </thead>
                      
                        <tr>
                          <th class="marrom branco text-center"scope="col">Meta Geral</th>
                          <th class="marrom branco text-center"scope="col">Faturado</th>
                          <th class="marrom branco text-center"scope="col">Transmitido</th>
                          <th class="marrom branco text-center"scope="col">Gap</th>
                          
                          <th class="bg-warning branco text-center" scope="col">Meta Geral</th>
                          <th class="bg-warning branco text-center" scope="col">Faturado</th>
                          <th class="bg-warning branco text-center" scope="col">Transmitido</th>
                          <th class="bg-warning branco text-center" scope="col">Gap</th>
                          
                                                   
                        </tr>
                      </thead> <tbody> ';


foreach ($result_Tot as $row){

    echo '<tr>';

    echo  "<td class='azul text-center'>$row[0]</td>
                          <td class='azul text-center'>$row[1]</td>
                          <td class='azul text-center'>$row[4]</td>";

    $gap = $row[0] - ($row[1] + $row[4]);

    if ($gap > 0){

        echo "<td class='negativo'>$gap</td>";

    }else{

        echo "<td class='positivo'>$gap</td>";
    }


    echo " <td class='amarelo text-center'>$row[2]</td>
                          <td class='amarelo text-center'>$row[3]</td>
                          <td class='amarelo text-center'>$row[5]</td>";

    $gap = $row[2] - ($row[3] + $row[5]);

    if ($gap > 0){

        echo "<td class='negativo'>$gap</td>";

    }else{

        echo "<td class='positivo'>$gap</td>";
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

