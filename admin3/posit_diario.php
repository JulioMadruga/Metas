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





$cont_tri = $conn->prepare("select * from trimarca");
$cont_tri->execute();
$result_cont = $cont_tri->fetchAll();

$bat = $result_cont[0][0];
$tal = $result_cont[0][1];
$ser = $result_cont[0][2];
$jum = $result_cont[0][4];
$bisc = $result_cont[0][5];





$importBisc= $conn->prepare("SELECT rca, COUNT(id) as realizado FROM (SELECT b.rca, a.id FROM $mes a, usuarios b where a.MATERIAL IN ($bisc) AND a.QUANTIDADE>0 and a.vendedor = b.rca group by a.id)SUB GROUP BY rca");
$importBisc->execute();
$result_bisc = $importBisc->fetchAll();

if(empty($result_bisc )){

    $upmeta = $conn->prepare("UPDATE $meta set Rbisc = 0,Rbaton = 0,Rgeral = 0");
    $upmeta->execute();

}


foreach ($result_bisc as $key => $value){

    $upmeta = $conn->prepare("UPDATE $meta set Rbisc = ".$value['realizado']." where Rca = ".$value['rca']."");
    $upmeta->execute();
}


$importBaton= $conn->prepare("SELECT rca, COUNT(id) as realizado FROM (SELECT b.rca, a.id FROM $mes a, usuarios b where a.MATERIAL IN ($bat) AND a.QUANTIDADE>0 and a.vendedor = b.rca group by a.id)SUB GROUP BY rca");
$importBaton->execute();
$result_baton = $importBaton->fetchAll();


foreach ($result_baton as $key => $value){

    $upmeta = $conn->prepare("UPDATE $meta set Rbaton = ".$value['realizado']." where Rca = ".$value['rca']."");
    //var_dump($upmeta);
    $upmeta->execute();
}


$consulta_geral = $conn->prepare("SELECT rca, COUNT(id) as realizado FROM (SELECT b.rca, a.id FROM $mes a, usuarios b where  a.QUANTIDADE>0 and a.vendedor = b.rca group by a.id)SUB GROUP BY rca");
$consulta_geral->execute();
$result_geral= $consulta_geral->fetchAll();


foreach ($result_geral as $key => $value){

    $upmeta = $conn->prepare("UPDATE $meta set Rgeral = ".$value['realizado']." where Rca = ".$value['rca']."");
    $upmeta->execute();
}





//----------------------------------------------------------------------------------------------------------------------------------------------------

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

    if($translate[$data->format('w')] == "Sab"){
        $sabado = $data->format('Y-m-d');
    }

}

$segunda = '2020-04-01';
//$sabado = '2020-03-31';

//echo "<br>";
//echo $segunda;
//echo "<br>";
//echo $sabado;


$upmeta2 = $conn->prepare("UPDATE $meta set flexx_baton = 0, flexx_bisc =0, flexx_geral=0");
$upmeta2->execute();




$consulta_baton_flexx = $conn->prepare("SELECT rca, COUNT(cod_cli) as realizado from (SELECT * FROM `ped_flexx` a where cod_prod in($bat) and data BETWEEN '$segunda' and '$sabado' and a.cod_cli not in (SELECT id FROM $mes where Material in($bat) and QUANTIDADE>0 group by id) group by cod_ped) sub GROUP by rca");
$consulta_baton_flexx->execute();
$result_baton_flexx= $consulta_baton_flexx->fetchAll();


foreach ($result_baton_flexx as $key => $value){

    $upmeta = $conn->prepare("UPDATE $meta set flexx_baton = ".$value['realizado']." where Rca = ".$value['rca']."");
    $upmeta->execute();
}

$consulta_bisc_flexx  = $conn->prepare("SELECT rca, COUNT(cod_cli) as realizado from (SELECT * FROM `ped_flexx` a where cod_prod in($bisc) and data BETWEEN '$segunda' and '$sabado' and a.cod_cli not in (SELECT id FROM $mes where Material in($bisc) and QUANTIDADE>0 group by id) group by cod_ped) sub GROUP by rca");
//var_dump($consulta_bisc_flexx);
$consulta_bisc_flexx ->execute();
$result_bisc_flexx = $consulta_bisc_flexx ->fetchAll();



foreach ($result_bisc_flexx  as $key => $value){

    $upmeta = $conn->prepare("UPDATE $meta set flexx_bisc = ".$value['realizado']." where Rca = ".$value['rca']."");
    $upmeta->execute();
}





$consulta_geral_flexx = $conn->prepare("SELECT rca, COUNT(cod_cli) as realizado from (SELECT * FROM `ped_flexx` a where data BETWEEN '$segunda' and '$sabado' and a.cod_cli not in (SELECT id FROM $mes where QUANTIDADE>0 group by id) group by cod_cli) sub GROUP by rca");
$consulta_geral_flexx->execute();
$result_geral_flexx= $consulta_geral_flexx->fetchAll();


foreach ($result_geral_flexx as $key => $value){

    $upmeta = $conn->prepare("UPDATE $meta set flexx_geral = ".$value['realizado']." where Rca = ".$value['rca']."");
    $upmeta->execute();
}




echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=relatorio_diario.php'>";


?>

