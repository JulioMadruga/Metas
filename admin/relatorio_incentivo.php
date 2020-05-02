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


$categoria = array(
    0 => "CAIXAS SORTIDOS",
    1 => "BOMBOM SERENATA",
    2 => "BATON",
    3 => "BISCOITOS",
    4 => "TALENTOS 25G",
    5 => "TALENTOS 90G",
    6 => "JUMBOS",
    7 => "PASTILHAS",
    8 => "PÓS"
);

$categoria2 = array(
    0 => "sortido",
    1 => "serenata",
    2 => "batom",
    3 => "bisc",
    4 => "talento25",
    5 => "talento90",
    6 => "jumbo",
    7 => "pastilha",
    8 => "pos"
);






$consulta_cood = $conn->prepare("SELECT DISTINCT super FROM usuarios where super <> '' ORDER by regiao, super");
$consulta_cood->execute();
$result_cood = $consulta_cood->fetchAll();

//var_dump($result_cood);

$i= 0;
foreach ($result_cood as $key=>$value){

    if (strlen($value['super']) !== 0){

     $cood = $value['super'];

        $consulta_geral = $conn->prepare("SELECT * from campanha_super where supervisor = '$cood' and mes = '$mes'");
        $consulta_geral->execute();
        $result_geral[$i]= $consulta_geral->fetchAll();


       // var_dump($result_geral[$i]);


        $i++;

    }

}

$sql = "SELECT ";

$i = 0;
foreach ($categoria2 as $item){

    $colum = $categoria2[$i]."M";
    $colum1 = $categoria2[$i]."F";
    $colum2 = $categoria2[$i]."T";

    if($colum2 == "posT"){
        $sql .= "round(sum($colum),2) AS $colum, round(sum($colum1),2) AS $colum1, round(sum($colum2),2) AS $colum2";
    }else{
        $sql .= "round(sum($colum),2) AS $colum, round(sum($colum1),2) AS $colum1, round(sum($colum2),2) AS $colum2,";
    }



    $i++;
}

$sql .= " from campanha_super where mes = '$mes'";

//print_r($sql);
//
//die();

$consulta_Tot= $conn->prepare($sql);
$consulta_Tot ->execute();
$result_Tot= $consulta_Tot->fetchAll();




//$consulta_Norte= $conn->prepare("SELECT sum(a.metachoc), sum(a.realchoc), sum(a.metabisc), sum(a.realbisc), SUM(a.choc_flexx), sum(a.bisc_flexx) from `ranking` a, usuarios b WHERE a.rca = b.Rca and b.Regiao = 'Norte'");
//$consulta_Norte ->execute();
//$result_Norte= $consulta_Norte ->fetchAll();
//
//
//$consulta_Sul= $conn->prepare("SELECT sum(a.metachoc), sum(a.realchoc), sum(a.metabisc), sum(a.realbisc), SUM(a.choc_flexx), sum(a.bisc_flexx) from `ranking` a, usuarios b WHERE a.rca = b.Rca and b.Regiao = 'SUL'");
//$consulta_Sul ->execute();
//$result_Sul= $consulta_Sul->fetchAll();
//
//$consulta_Tot= $conn->prepare("SELECT sum(metachoc), sum(realchoc), sum(metabisc), sum(realbisc), SUM(choc_flexx), sum(bisc_flexx) from `ranking`");
//$consulta_Tot ->execute();
//$result_Tot= $consulta_Tot->fetchAll();



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
            background: #30465d;
        }

        .azul2{
            background: #7ca9d6;
        }

        .azul3{
            background: #c8ddf3;
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
                                           
                        <tr>
                          <th class="azul branco"scope="col"> Categoria</th>
                          <th class="azul branco text-center"scope="col">Meta Geral</th>
                          <th class="azul branco text-center"scope="col">Faturado</th>
                          <th class="azul branco text-center"scope="col">Transmitido</th>
                          <th class="azul branco text-center"scope="col">Gap</th>
                                                   
                                                   
                        </tr>
                      </thead> <tbody> ';

            $i =1;
        foreach ($result_geral[$z] as $row){

            echo '<tr>';

                      $i2 =0;
                      foreach ($categoria as $value){
                          echo  "<td class='azul2 font-weight-bold'>$value</td>";
                          $colum = $categoria2[$i2]."M";
                          $colum1 = $categoria2[$i2]."F";
                          $colum2 = $categoria2[$i2]."T";
                          echo  '<td class="azul3 text-center">R$  ' . number_format($row[$colum], 2, ',', '.') . '</td>';
                          echo  '<td class="azul3 text-center">R$  ' . number_format($row[$colum1], 2, ',', '.') . '</td>';
                          echo  '<td class="azul3 text-center">R$  ' . number_format($row[$colum2], 2, ',', '.') . '</td>';

                          $gap = ($row[$colum] - ($row[$colum1] + $row[$colum2]));

                          if($gap<=0){
                              echo  '<td class="positivo text-center">R$  ' . number_format($gap, 2, ',', '.') . '</td>';
                          }else{
                              echo  '<td class="negativo text-center">R$  ' . number_format($gap, 2, ',', '.') . '</td>';
                          }



                          echo '</tr>';
                          $i2++;
                      }







                          $i++;

        }




        echo '</tbody>';



        $z++;


    }




    echo '</table>';

}



//----------------------------------------------------------------------------------------------------------------------------------------




        echo '<table id="tblExport"  class="table">';

        // echo "<h1 style='background: '>".$value['super']."</h1>";


        echo '
                      <thead class="thead-dark">
                      <tr>
                      <th style="text-align: center" colspan="13">GERAL</th>
                      </tr>
                      </thead>
                                           
                        <tr>
                          <th class="azul branco"scope="col"> Categoria</th>
                          <th class="azul branco text-center"scope="col">Meta Geral</th>
                          <th class="azul branco text-center"scope="col">Faturado</th>
                          <th class="azul branco text-center"scope="col">Transmitido</th>
                          <th class="azul branco text-center"scope="col">Gap</th>
                                                   
                                                   
                        </tr>
                      </thead> <tbody> ';


        foreach ($result_Tot AS $row){
            echo '<tr>';

            $i2 =0;
            foreach ($categoria as $value){
                echo  "<td class='azul2 font-weight-bold'>$value</td>";
                $colum = $categoria2[$i2]."M";
                $colum1 = $categoria2[$i2]."F";
                $colum2 = $categoria2[$i2]."T";
                echo  '<td class="azul3 text-center">R$  ' . number_format($row[$colum], 2, ',', '.') . '</td>';
                echo  '<td class="azul3 text-center">R$  ' . number_format($row[$colum1], 2, ',', '.') . '</td>';
                echo  '<td class="azul3 text-center">R$  ' . number_format($row[$colum2], 2, ',', '.') . '</td>';

                $gap = ($row[$colum] - ($row[$colum1] + $row[$colum2]));

                if($gap<=0){
                    echo  '<td class="positivo text-center">R$  ' . number_format($gap, 2, ',', '.') . '</td>';
                }else{
                    echo  '<td class="negativo text-center">R$  ' . number_format($gap, 2, ',', '.') . '</td>';
                }



                echo '</tr>';
                $i2++;
            }







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

