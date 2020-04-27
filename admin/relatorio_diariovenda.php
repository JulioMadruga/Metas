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

        $consulta_geral = $conn->prepare("SELECT a.*, round(a.gap,0) as gap2 FROM `venda_diaria` a where super = '$cood' ORDER BY gap2");
        $consulta_geral->execute();
        $result_geral[$i]= $consulta_geral->fetchAll();


        $consulta_total = $conn->prepare("SELECT super, sum(meta), round(sum(realizado),2), round(sum(seg),2), round(sum(ter),2), 
        round(sum(qua),2), round(sum(qui),2), round(sum(sex),2), round(sum(realfat),2), round(sum(tendenciafecha),2), round(sum(gap),2) FROM `venda_diaria`
         where super = '$cood' ORDER by vendedor");
        $consulta_total ->execute();
        $result_total [$i]= $consulta_total ->fetchAll();



       // var_dump($result_geral[$i]);


        $i++;

    }

}



$consulta_Norte= $conn->prepare("SELECT a.super, sum(a.meta), round(sum(a.realizado),2), round(sum(a.seg),2), round(sum(a.ter),2), 
        round(sum(a.qua),2), round(sum(a.qui),2), round(sum(a.sex),2), round(sum(a.realfat),2), round(sum(a.tendenciafecha),2), round(sum(a.gap),2) FROM `venda_diaria` a, usuarios b 
         where a.rca = b.Rca and b.Regiao = 'Norte' ORDER by a.vendedor");
$consulta_Norte ->execute();
$result_Norte= $consulta_Norte ->fetchAll();


$consulta_Sul= $conn->prepare("SELECT a.super, sum(a.meta), round(sum(a.realizado),2), round(sum(a.seg),2), round(sum(a.ter),2), 
        round(sum(a.qua),2), round(sum(a.qui),2), round(sum(a.sex),2), round(sum(a.realfat),2), round(sum(a.tendenciafecha),2), round(sum(a.gap),2) FROM `venda_diaria` a, usuarios b 
         where a.rca = b.Rca and b.Regiao = 'Sul' ORDER by a.vendedor");
$consulta_Sul ->execute();
$result_Sul= $consulta_Sul->fetchAll();

$consulta_Tot= $conn->prepare("SELECT super, sum(meta), round(sum(realizado),2), round(sum(seg),2), round(sum(ter),2), 
        round(sum(qua),2), round(sum(qui),2), round(sum(sex),2), round(sum(realfat),2), round(sum(tendenciafecha),2), round(sum(gap),2) FROM `venda_diaria` ORDER by vendedor");
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
       * {
             border: solid 2px white;
           font-size: 13px;
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
        .azulforte{
            background: #282e6a;
        }
        .vermelho{
            background: #efa3aa9e;
        }
       .vermelho2{
           color: red;
       }
        .amarelo{
            background: #efd895a3;
        }
        .branco{
            color: white !important;
        }

        .marrom{
            color: #52382f !important;
        }
        .verde{
            background: darkgreen !important;
        }
        .verde2{
            background: #006400ab !important;
        }
       .verde3{
           background: #1b3c1c !important;
       }

        .pretoclaro{
            background: black;
        }
        .centerth {

            vertical-align: inherit !important;

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
                      <thead class="bg-warning marrom">
                      <tr>
                      <th style="border: none !important; text-align: center; vertical-align: inherit; height: 100px; font-size: 36px"  colspan="13"> <img style="position: absolute; margin-left: 53%; width: 130px" src="../images/logogaroto.png"> ACOMPANHAMENTO DIÁRIO </th>
                      <!-- <th style="border: none !important; vertical-align: inherit; "></th> -->
                      </tr>
                      </thead>
                      
                      <thead class="azulforte branco">
                      <tr>
                      <th style="text-align: center" colspan="13">'.$value['super'].'</th>
                      </tr>
                      </thead>
                                            
                        <tr>
                          <th class="bg-primary branco"scope="col" style="width: 45px">Ranking</th>
                          <th class="bg-primary branco centerth" style="width: 200px !important;" >Vendedores</th>
                          <th class="bg-primary branco text-center centerth" style="width: 150px !important;"scope="col">Meta Valor</th>
                          <th class="bg-primary branco text-center centerth" style="width: 150px !important; scope="col">Faturado</th>
                          
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;" scope="col">Segunda</th>
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;"scope="col">Terça</th>
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;"scope="col">Quarta</th>
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;"scope="col">Quinta</th>
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;"scope="col">Sexta</th>
                          
                          <th class="bg-primary branco text-center centerth" style="font-size: 12px; width: 140px !important;" scope="col">Faturado + Realizado</th>
                          <th class="verde2 branco text-center centerth" style="font-size: 12px; width: 140px !important;" scope="col">Tendência Fechamento</th>
                          <th class="bg-dark branco text-center centerth"scope="col">Tendência</th>
                          <th class="bg-warning branco text-center centerth" style="font-size: 13px; width: 130px !important;" scope="col">GAP</th>
                         
                          
                          
                          
                         
                          
                        </tr>
                      </thead> <tbody> ';

             $i = 1;
        foreach ($result_geral[$z] as $row){

            echo '<tr>';

                   echo  "<td class='azul' scope='row'>$i.º</td>
                          <td class='azul'style='padding-left: 15px'>$row[3]</td>
                          <td class='azul text-center'>R$  " . number_format($row[4], 2, ',', '.')."</td>
                          <td class='azul text-center'>R$  " . number_format($row[5], 2, ',', '.')."</td>";

                              if($row[6]>0){
                                  echo "<td class='azulforte branco text-center'>R$  " . number_format($row[6], 2, ',', '.')."</td>";
                              }else{
                                  echo "<td class='amarelo text-center'></td>";
                              }




                            if($row[7]>0){
                                echo "<td class='azulforte branco text-center'>R$  " . number_format($row[7], 2, ',', '.')."</td>";
                            }else{
                                echo "<td class='amarelo text-center'></td>";
                            }

                            if($row[8]>0){
                                echo "<td class='azulforte branco text-center'>R$  " . number_format($row[8], 2, ',', '.')."</td>";
                            }else{
                                echo "<td class='amarelo text-center'></td>";
                            }


                            if($row[9]>0){
                                echo "<td class='azulforte branco text-center'>R$  " . number_format($row[9], 2, ',', '.')."</td>";
                            }else{
                                echo "<td class='amarelo text-center'></td>";
                            }

                            if($row[10]>0){
                                echo "<td class='azulforte branco text-center'>R$  " . number_format($row[10], 2, ',', '.')."</td>";
                            }else{
                                echo "<td class='amarelo text-center'></td>";
                            }






                         echo"
                          <td class='azul text-center' style='font-size: 13px; width: 140px !important;' >R$  " . number_format($row[11], 2, ',', '.')."</td>
                          <td class='verde branco text-center'>R$  " . number_format($row[12], 2, ',', '.')."</td>
                          <td class='pretoclaro branco font-weight-bold text-center'>$row[13]%</td>
                          ";

                           if($row[14]>0){
                                echo "<td class='vermelho vermelho2 font-weight-bold text-center'>R$  " . number_format($row[14], 2, ',', '.')."</td>";
                            }else{
                                echo "<td class='verde2 branco  font-weight-bold text-center'>R$  " . number_format($row[14], 2, ',', '.')."</td>";
                            }






            echo '</tr>';

                           $i++;

        }




        echo '</tbody>';

        foreach ($result_total[$z] as $row) {

            $percent = round((($row[9]/$row[1])*100),0);

            echo '<tfoot style="background: #25272a; color: white">';
            echo '<tr>';

            echo '<td  colspan="2" class="font-weight-bold">Total</td>';

            echo '<td class="text-center">R$  '. number_format($row[1], 2, ",", ".").'</td>';
            echo '<td class="text-center">R$  '. number_format($row[2], 2, ",", ".").'</td>';
            echo '<td class="text-center">R$  '. number_format($row[3], 2, ",", ".").'</td>';
            echo '<td class="text-center">R$  '. number_format($row[4], 2, ",", ".").'</td>';
            echo '<td class="text-center">R$  '. number_format($row[5], 2, ",", ".").'</td>';
            echo '<td class="text-center">R$  '. number_format($row[6], 2, ",", ".").'</td>';
            echo '<td class="text-center">R$  '. number_format($row[7], 2, ",", ".").'</td>';
            echo '<td class="text-center">R$  '. number_format($row[8], 2, ",", ".").'</td>';
            echo '<td class="text-center">R$  '. number_format($row[9], 2, ",", ".").'</td>';
            echo '<td class="text-center font-weight-bold">'.$percent.'%</td>';

            if($row[10]>0){

                echo '<td class="vermelho2 font-weight-bold text-center">R$  '. number_format($row[10], 2, ",", ".").'</td>';

            }else{

                echo '<td class="verde font-weight-bold branco text-center">R$  '. number_format($row[10], 2, ",", ".").'</td>';
            }



            echo '</tr>';

            echo '</tfoot>';
        }






        $z++;


    }




    echo '</table>';

}

//-------------------------------------  NORTE  ---------------------------------------------------------------------------

foreach ($result_Norte as $row){



        echo '<table id="tblExport"  class="table">';

        // echo "<h1 style='background: '>".$value['super']."</h1>";


        echo '
                      <thead class="bg-warning marrom">
                      <tr>
                      <th style="border: none !important; text-align: center; vertical-align: inherit; height: 80px; font-size: 36px"  colspan="12"> <img style="position: absolute; margin-left: 53%; width: 130px" src="../images/logogaroto.png"> ACOMPANHAMENTO DIÁRIO </th>
                      <!-- <th style="border: none !important; vertical-align: inherit; "></th> -->
                      </tr>
                      </thead>
                      
                      <thead class="azulforte branco">
                      <tr>
                      <th style="text-align: center; height: 60px; vertical-align: inherit; font-size: 24px" colspan="12">NORTE</th>
                      </tr>
                      </thead>
                                            
                        <tr>
                          <th class="bg-primary branco centerth" style="width: 200px !important;" scope="col">Vendedores</th>
                          <th class="bg-primary branco text-center centerth" style="width: 150px !important;"scope="col">Meta Valor</th>
                          <th class="bg-primary branco text-center centerth" style="width: 150px !important; scope="col">Faturado</th>
                          
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;" scope="col">Segunda</th>
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;"scope="col">Terça</th>
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;"scope="col">Quarta</th>
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;"scope="col">Quinta</th>
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;"scope="col">Sexta</th>
                          
                          <th class="bg-primary branco text-center centerth" style="font-size: 12px; width: 140px !important;" scope="col">Faturado + Realizado</th>
                          <th class="verde2 branco text-center centerth" style="font-size: 12px; width: 140px !important;" scope="col">Tendência Fechamento</th>
                          <th class="bg-dark branco text-center centerth"scope="col">Tendência</th>
                          <th class="bg-warning branco text-center centerth" style="font-size: 13px; width: 130px !important;" scope="col">GAP</th>
                         
                          
                          
                          
                         
                          
                        </tr>
                      </thead>';





            $percent = round((($row[9]/$row[1])*100),0);

            echo '<tbody style="background: #25272a; color: white">';
            echo '<tr>';

            echo '<td class="font-weight-bold">Total</td>';

            echo '<td class="text-center">R$  '. number_format($row[1], 2, ",", ".").'</td>';
            echo '<td class="text-center">R$  '. number_format($row[2], 2, ",", ".").'</td>';
            echo '<td class="text-center">R$  '. number_format($row[3], 2, ",", ".").'</td>';
            echo '<td class="text-center">R$  '. number_format($row[4], 2, ",", ".").'</td>';
            echo '<td class="text-center">R$  '. number_format($row[5], 2, ",", ".").'</td>';
            echo '<td class="text-center">R$  '. number_format($row[6], 2, ",", ".").'</td>';
            echo '<td class="text-center">R$  '. number_format($row[7], 2, ",", ".").'</td>';
            echo '<td class="text-center">R$  '. number_format($row[8], 2, ",", ".").'</td>';
            echo '<td class="text-center">R$  '. number_format($row[9], 2, ",", ".").'</td>';
            echo '<td class="text-center font-weight-bold">'.$percent.'%</td>';

            if($row[10]>0){

                echo '<td class="vermelho2 font-weight-bold text-center">R$  '. number_format($row[10], 2, ",", ".").'</td>';

            }else{

                echo '<td class="verde font-weight-bold branco text-center">R$  '. number_format($row[10], 2, ",", ".").'</td>';
            }



            echo '</tr>';

            echo '</tbody>';


    echo '</table>';

}


//-------------------------------------  SUL  ---------------------------------------------------------------------------

foreach ($result_Sul as $row){



    echo '<table id="tblExport"  class="table">';

    // echo "<h1 style='background: '>".$value['super']."</h1>";


    echo '
                      <thead class="bg-warning marrom">
                      <tr>
                      <th style="border: none !important; text-align: center; vertical-align: inherit; height: 80px; font-size: 36px"  colspan="12"> <img style="position: absolute; margin-left: 53%; width: 130px" src="../images/logogaroto.png"> ACOMPANHAMENTO DIÁRIO </th>
                      <!-- <th style="border: none !important; vertical-align: inherit; "></th> -->
                      </tr>
                      </thead>
                      
                      <thead class="azulforte branco">
                      <tr>
                      <th style="text-align: center; height: 60px; vertical-align: inherit; font-size: 24px" colspan="12">SUL</th>
                      </tr>
                      </thead>
                                            
                        <tr>
                          <th class="bg-primary branco centerth" style="width: 200px !important;" scope="col">Vendedores</th>
                          <th class="bg-primary branco text-center centerth" style="width: 150px !important;"scope="col">Meta Valor</th>
                          <th class="bg-primary branco text-center centerth" style="width: 150px !important; scope="col">Faturado</th>
                          
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;" scope="col">Segunda</th>
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;"scope="col">Terça</th>
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;"scope="col">Quarta</th>
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;"scope="col">Quinta</th>
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;"scope="col">Sexta</th>
                          
                          <th class="bg-primary branco text-center centerth" style="font-size: 12px; width: 140px !important;" scope="col">Faturado + Realizado</th>
                          <th class="verde2 branco text-center centerth" style="font-size: 12px; width: 140px !important;" scope="col">Tendência Fechamento</th>
                          <th class="bg-dark branco text-center centerth"scope="col">Tendência</th>
                          <th class="bg-warning branco text-center centerth" style="font-size: 13px; width: 130px !important;" scope="col">GAP</th>
                         
                          
                          
                          
                         
                          
                        </tr>
                      </thead>';





    $percent = round((($row[9]/$row[1])*100),0);

    echo '<tbody style="background: #25272a; color: white">';
    echo '<tr>';

    echo '<td class="font-weight-bold">Total</td>';

    echo '<td class="text-center">R$  '. number_format($row[1], 2, ",", ".").'</td>';
    echo '<td class="text-center">R$  '. number_format($row[2], 2, ",", ".").'</td>';
    echo '<td class="text-center">R$  '. number_format($row[3], 2, ",", ".").'</td>';
    echo '<td class="text-center">R$  '. number_format($row[4], 2, ",", ".").'</td>';
    echo '<td class="text-center">R$  '. number_format($row[5], 2, ",", ".").'</td>';
    echo '<td class="text-center">R$  '. number_format($row[6], 2, ",", ".").'</td>';
    echo '<td class="text-center">R$  '. number_format($row[7], 2, ",", ".").'</td>';
    echo '<td class="text-center">R$  '. number_format($row[8], 2, ",", ".").'</td>';
    echo '<td class="text-center">R$  '. number_format($row[9], 2, ",", ".").'</td>';
    echo '<td class="text-center font-weight-bold">'.$percent.'%</td>';

    if($row[10]>0){

        echo '<td class="vermelho2 font-weight-bold text-center">R$  '. number_format($row[10], 2, ",", ".").'</td>';

    }else{

        echo '<td class="verde font-weight-bold branco text-center">R$  '. number_format($row[10], 2, ",", ".").'</td>';
    }



    echo '</tr>';

    echo '</tbody>';


    echo '</table>';

}







//-------------------------------------  GERAL  ---------------------------------------------------------------------------

foreach ($result_Tot as $row){



    echo '<table id="tblExport"  class="table">';

    // echo "<h1 style='background: '>".$value['super']."</h1>";


    echo '
                      <thead class="bg-warning marrom">
                      <tr>
                      <th style="border: none !important; text-align: center; vertical-align: inherit; height: 80px; font-size: 36px"  colspan="12"> <img style="position: absolute; margin-left: 53%; width: 130px" src="../images/logogaroto.png"> ACOMPANHAMENTO DIÁRIO </th>
                      <!-- <th style="border: none !important; vertical-align: inherit; "></th> -->
                      </tr>
                      </thead>
                      
                      <thead class="verde3 branco">
                      <tr>
                      <th style="text-align: center; height: 60px; vertical-align: inherit; font-size: 24px" colspan="12">GERAL</th>
                      </tr>
                      </thead>
                                            
                        <tr>
                          <th class="bg-primary branco centerth" style="width: 200px !important;" scope="col">Vendedores</th>
                          <th class="bg-primary branco text-center centerth" style="width: 150px !important;"scope="col">Meta Valor</th>
                          <th class="bg-primary branco text-center centerth" style="width: 150px !important; scope="col">Faturado</th>
                          
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;" scope="col">Segunda</th>
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;"scope="col">Terça</th>
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;"scope="col">Quarta</th>
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;"scope="col">Quinta</th>
                          <th class="bg-warning branco text-center centerth" style="width: 140px !important;"scope="col">Sexta</th>
                          
                          <th class="bg-primary branco text-center centerth" style="font-size: 12px; width: 140px !important;" scope="col">Faturado + Realizado</th>
                          <th class="verde2 branco text-center centerth" style="font-size: 12px; width: 140px !important;" scope="col">Tendência Fechamento</th>
                          <th class="bg-dark branco text-center centerth"scope="col">Tendência</th>
                          <th class="bg-warning branco text-center centerth" style="font-size: 13px; width: 130px !important;" scope="col">GAP</th>
                         
                          
                          
                          
                         
                          
                        </tr>
                      </thead>';





    $percent = round((($row[9]/$row[1])*100),0);

    echo '<tbody style="background: #25272a; color: white">';
    echo '<tr>';

    echo '<td class="font-weight-bold">Total</td>';

    echo '<td class="text-center">R$  '. number_format($row[1], 2, ",", ".").'</td>';
    echo '<td class="text-center">R$  '. number_format($row[2], 2, ",", ".").'</td>';
    echo '<td class="text-center">R$  '. number_format($row[3], 2, ",", ".").'</td>';
    echo '<td class="text-center">R$  '. number_format($row[4], 2, ",", ".").'</td>';
    echo '<td class="text-center">R$  '. number_format($row[5], 2, ",", ".").'</td>';
    echo '<td class="text-center">R$  '. number_format($row[6], 2, ",", ".").'</td>';
    echo '<td class="text-center">R$  '. number_format($row[7], 2, ",", ".").'</td>';
    echo '<td class="text-center">R$  '. number_format($row[8], 2, ",", ".").'</td>';
    echo '<td class="text-center">R$  '. number_format($row[9], 2, ",", ".").'</td>';
    echo '<td class="text-center font-weight-bold">'.$percent.'%</td>';

    if($row[10]>0){

        echo '<td class="vermelho2 font-weight-bold text-center">R$  '. number_format($row[10], 2, ",", ".").'</td>';

    }else{

        echo '<td class="verde font-weight-bold branco text-center">R$  '. number_format($row[10], 2, ",", ".").'</td>';
    }



    echo '</tr>';

    echo '</tbody>';


    echo '</table>';

}








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

