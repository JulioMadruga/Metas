<?php

$rca = $_GET['rca'];

include_once '../../Database/Conexao.php';

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

$hierarquia = array(
    5534705 => 'AS 1a2',
    5534706 => 'AS 3a4',
    5534707 => 'AS 5',
    5534708 => 'Conv',
    5534716 => 'Trad'
);

$user= $conn->prepare("SELECT nome FROM `usuarios` where rca = $rca ");
$user->execute();
$usuario = $user->fetchAll();

$usuario = $usuario[0][0];





$delete = "DROP TABLE IF EXISTS temp_mix"; //Esvaziar a tabela
$limpa2 = $conn->prepare($delete);
$limpa2->execute();
$limpa2->closeCursor();


$consulta_mix = $conn->prepare("SELECT mix FROM `trimarca` ");
$consulta_mix->execute();
$result_mix = $consulta_mix->fetchAll();

$result = explode(",", $result_mix[0][0]);
//var_dump($result);


$sql = "CREATE TABLE temp_mix SELECT b.rca, c.nome, a.cod_cli, a.razao, a.endereco, a.bairro, a.cidade, a.cod_canal,";

foreach ($result as $row){

    $sql.= "'0' as '".$row."',";

}

$sql.= "'000' as total FROM `clientes_sap` a, clientes_flexx b, usuarios c where a.cod_cli = b.cod_cli and b.rca = c.rca and b.rca = $rca 
and a.cod_canal in(5534705,5534706,5534707,5534708,5534716)";

//echo $sql;
$createTabMix= $conn->prepare($sql);
//var_dump($createTabMix);
$createTabMix->execute();
$createTabMix->closeCursor();


foreach ($result as $row) {

    $posit = $conn->prepare("SELECT sum(a.Quantidade) as quant, id FROM $mes a WHERE a.material = $row and a.vendedor = $rca GROUP by a.id ");
    $posit->execute();
    $result_posit = $posit->fetchAll();

   
    foreach ($result_posit as $key => $value) {

        if($value['quant']>0){

            $upvenda = $conn->prepare("UPDATE temp_mix set `$row` = 1 where cod_cli = " . $value['id'] . "");
            //var_dump($upvenda);
            $upvenda->execute();

        }


    }

}

$translate = array(
    0 => "Dom",
    1 => "Seg",
    2 => "Ter",
    3 => "Qua",
    4 => "Qui",
    5 => "Sex",
    6 => "Sab",
);

$data = new DateTime($date);     // Pega a data de hoje
$diaN = date( "w", strtotime($data->format('Y-m-d'))); // Dia da semana, começa em 0 com domingo, 1 para segunda...

$data->modify('-' . $diaN . ' day');

for($i=0;$i<=6;$i++) {
    $data->format('d/m/Y') . ' - ' .  $translate[$data->format('w')] . "<br>";
    $data->modify('+1 day');

    if($translate[$data->format('w')] == "Seg"){
        $segunda = $data->format('Y-m-d');
    }
    if($translate[$data->format('w')] == "Ter"){
        $terca = $data->format('Y-m-d');
    }
    if($translate[$data->format('w')] == "Qua"){
        $quarta = $data->format('Y-m-d');
    }

    if($translate[$data->format('w')] == "Qui"){
        $quinta = $data->format('Y-m-d');
    }

    if($translate[$data->format('w')] == "Sex"){
        $sexta = $data->format('Y-m-d');
    }

}

$segunda = '2020-04-01';

foreach ($result as $row) {

    $posit = $conn->prepare("SELECT cod_cli, cod_prod FROM `ped_flexx` where cod_prod = $row and data BETWEEN '$segunda' AND '$sexta' and rca = $rca GROUP BY cod_cli");
    $posit->execute();
    $result_posit = $posit->fetchAll();
    //var_dump($posit);
   

    foreach ($result_posit as $key => $value) {

            $upvenda = $conn->prepare("UPDATE temp_mix set `$row` = 1 where cod_cli = " . $value['cod_cli'] . "");
           //var_dump($upvenda);
            $upvenda->execute();
       
    }

}




$as12 = [12415774,12396921,12312312,12365128];
$as34 = [11320331,12365128,12396921];
$trad = [12415774,12396921,12396888,12312312,12365128];

foreach ($as12 as $row) {

    $upvenda = $conn->prepare("UPDATE temp_mix set `$row` = 'X' WHERE cod_canal = 5534705 ");
    //var_dump($upvenda);
    $upvenda->execute();

}

foreach ($as34 as $row) {

    $upvenda = $conn->prepare("UPDATE temp_mix set `$row` = 'X' WHERE cod_canal = 5534706 ");
    //var_dump($upvenda);
    $upvenda->execute();

}

foreach ($trad as $row) {

    $upvenda = $conn->prepare("UPDATE temp_mix set `$row` = 'X' WHERE cod_canal in  (5534708,5534716) ");
    //var_dump($upvenda);
    $upvenda->execute();

}


$n = count($result );

$sql2 = "SELECT cod_cli,(";


$i = 1;
foreach ($result as $row){

    if($i<$n){
        $sql2.= "`$row` + ";
    }else {
        $sql2.= "`$row`) AS total ";
    }

    $i++;

}

$sql2 .= " FROM (SELECT ";

$i = 1;
foreach ($result as $row){

    if($i<$n){
        $sql2.= "if (`$row`= 'X',0,`$row`) as `$row`,";
    }else {
        $sql2.= "if (`$row`= 'X',0,`$row`) as `$row`, cod_cli ";
    }

    $i++;



}

$sql2.= " FROM `temp_mix` GROUP BY cod_cli) sub";

//echo $sql2;

$total= $conn->prepare($sql2);
//var_dump($createTabMix);
$total->execute();
$result_total = $total->fetchAll();



foreach ($result_total as $row) {

    $upvenda = $conn->prepare("UPDATE temp_mix set total = $row[1] WHERE cod_cli = '$row[0]'");
    //var_dump($upvenda);
    $upvenda->execute();

}


$consulta_cli = $conn->prepare("SELECT * FROM `temp_mix` order by cod_canal,razao");
$consulta_cli->execute();
$result_cli = $consulta_cli->fetchAll();

//var_dump($result_cli);





$resultado = array();


foreach ($result as $row){

  $sql3 = "SELECT sum(`$row`) as `$row` FROM temp_mix WHERE  `$row` <> 'X'";
  $total= $conn->prepare($sql3);
  $total->execute();
  $result_tot = $total->fetchAll();

  $resultado [$row] = $result_tot[0][$row];



}

//var_dump($result);

$geral = $conn->prepare("SELECT sum(total) as total FROM temp_mix ");
$geral->execute();
$result_geral = $geral->fetchAll();




 $html = '
<html>
<head>
</head>
<body>

<div class="bg-warning marrom" style="border: none !important; text-align: center; vertical-align: inherit; height: 40px; font-size: 25px; width: 100%" > 
<img style=" text-align:left !important; margin-left: 10px; width: 80px" src="../../images/logogaroto.png"> RELÁTORIO MIX IDEAL POR CLIENTE
</div>

<table class="table table-striped">

 <thead>
 <tr>
    <th style="background: #0d47a1; font-size:9px;color: white;">#</th>
    <th style="background: #0d47a1; font-size:9px;width: 90px; text-align:left; color: white;">Vendedor</th>
    <th style="background: #0d47a1; font-size:9px; width: 80px; text-align: center; color: white;">Cod. Cliente</th>
    <th style="background: #0d47a1; font-size:9px; width: 150px; color: white;">Razao</th>
    <th style="background: #0d47a1; font-size:9px; width: 180px; color: white;">Endereço</th> 
    <th style="background: #0d47a1; font-size:9px; width: 110px; text-align:left; color: white;">Bairro</th>
    <th style="background: #0d47a1; font-size:9px; width: 100px; text-align:left; color: white;">Cidade</th>
    <th style="background: #0d47a1; font-size:9px; width: 60px; text-align:left;color: white;">Canal</th>
    <th style="background: #0d47a1; font-size:9px; width: 60px; text-align: center;color: white;">Total</th> 
    <th style="background: #0d47a1; font-size:8px; width: 50px; text-align: center; color: white;">Bombom Sortido 250g</th>
    <th style="background: #0d47a1; font-size:8px; width: 50px;text-align: center; color: white;">Serenata de Amor 825g</th>
    <th style="background: #0d47a1; font-size:8px; width: 50px;text-align: center; color: white;">Talento Cst.Pará 90g</th>
    <th style="background: #0d47a1; font-size:8px; width: 50px;text-align: center; color: white;">Talento Cst.Pará 25g</th>
    <th style="background: #0d47a1; font-size:8px; width: 50px;text-align: center; color: white;">Baton ao Leite 16g</th>
    <th style="background: #0d47a1; font-size:8px; width: 50px;text-align: center; color: white;">Baton Choc Braco 16g</th> 
    <th style="background: #0d47a1; font-size:8px; width: 50px;text-align: center; color: white;">Tablete ao Leite 90g</th>
    <th style="background: #0d47a1; font-size:8px; width: 50px;text-align: center; color: white;">Tablete Meio Amargo 90g</th>
    <th style="background: #0d47a1; font-size:8px; width: 50px;text-align: center; color: white;">Bisc. Rech ao Leite 130g</th>
    <th style="background: #0d47a1; font-size:8px; width: 50px;text-align: center; color: white;">Bisc. Rech Choc BCO 130g</th> 
    <th style="background: #0d47a1; font-size:8px; width: 50px;text-align: center; color: white;">Bisc. Cookie Choc 60g</th>  
</tr>    
 </thead> 
 
 <tbody>';

 $i = 1;


 foreach($result_cli as $key=>$value){



     $canal = $hierarquia[$value['cod_canal']];

     $html .= '<tr>';

     $html .= '<td style="font-size: 9px"> '.$i.'</td>';
     $html .= '<td style="font-size: 9px">  '.$value['rca'].'-'.$value['nome'].'</td>';
     $html .= '<td style="font-size: 9px; text-align: center; "> '.$value['cod_cli'].'</td>';
     $html .= '<td style="font-size: 9px"> '.mb_strimwidth($value['razao'], 0, 25).'</td>';
     $html .= '<td style="font-size: 9px"> '.$value['endereco'].'</td>';
     $html .= '<td style="font-size: 9px"> '.$value['bairro'].'</td>';
     $html .= '<td style="font-size: 9px"> '.$value['cidade'].'</td>';

     $html .= '<td style="font-size: 9px"> '.$canal.'</td>';
     if($value['total']>0){
         $html .= '<td style="text-align: center; font-size: 9px; background:#096c32; color: white"> '.$value['total'].'</td>';
     }else{
         $html .= '<td style="text-align: center; font-size: 11px; background:red; color: white "> '.$value['total'].'</td>';

     }



     foreach ($result as $row) {

         if($value[$row] == 'X'){
             $html .= '<td style=" text-align: center; font-size: 9px; width: 65px; background:#b2b2b2"> ' . $value[$row] . '</td>';
         }elseif($value[$row] <= 0){
             $html .= '<td style=" text-align: center; font-size: 9px; width: 65px; background:rgba(255,39,65,0.57)"> ' . $value[$row] . '</td>';
         }else{
             $html .= '<td style="text-align: center; font-size: 9px; width: 65px; background:rgba(117,244,113,0.57)"> ' . $value[$row] . '</td>';

         }


     }


     $html .= '</tr>';

     $i++;

 }





 $html .='
</tbody>
 <tfoot>
 <tr>
 <td colspan="8" style="background:#1d1d1d; color: white; font-size: 10px; text-align: right; padding-right: 10px; border-left: solid white">TOTAL</td>
 <td style="background:#1d1d1d; color: white; font-size: 10px; text-align: center; border-left: solid white">'.$result_geral[0][0].'</td>';

 foreach ($result as $row){


         $html .='<td style="background:#1d1d1d; color: white; font-size: 10px; text-align: center; border-left: solid white">'.$resultado[$row].'</td>';


 }



$html .='
</tr>
</tfoot>
 
 
 
 
 </table>
</body>
</html>  
 
 
  ';

  //echo $html;



use Mpdf\Mpdf;

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new Mpdf([
    'margin_top' => 5,
    'margin_left' => 15,
    'margin_right' => 15,
    'margin_bottom' => 5,
    'mirrorMargins' => true
]);


$css = file_get_contents("assets/css/bootstrap.css ");
$mpdf->WriteHTML($css,1);
$mpdf->AddPage('L');


$mpdf->WriteHTML($html);



$mpdf->Output('Mix Ideal - '.$usuario.'.pdf', 'D');










