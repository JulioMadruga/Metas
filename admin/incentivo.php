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

$sortido = "12415774";
$serenata = "124";





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




$cood= $conn->prepare("SELECT DISTINCT super FROM usuarios where super <> '' ORDER by super");
$cood->execute();
$result_cood = $cood->fetchAll();


//--------------------------------------------------SORTIDO------------------------------------------------------------


foreach ($result_cood as $value){

    $super = $value['super'];

    $sortidof= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as total FROM $mes a, usuarios b where a.vendedor = b.Rca and Material = '$sortido' and b.super = '$super'");
    $sortidof->execute();
    $result_sortidof= $sortidof->fetchAll();

    foreach ($result_sortidof as $item){

        $sortidoV = $item['total'];
        $cood = $item['super'];

        $UP= $conn->prepare("UPDATE campanha_super set sortidoF = $sortidoV  where supervisor = '$cood ' and mes = '$mes' ");
        $UP->execute();


    }



}



$sortidot= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.valor, '.', ''), ',', '.') as decimal(10,2))) as total FROM `ped_flexx`a, usuarios b WHERE a.rca = b.rca and a.cod_prod = '$sortido' and a.data BETWEEN '$segunda' and '$sexta' group by b.super ");
$sortidot->execute();
$result_sortidot= $sortidot->fetchAll();


foreach ($result_sortidot as $item){

    $sortidoV = $item['total'];
    $cood = $item['super'];

    $UP= $conn->prepare("UPDATE campanha_super set sortidoT = $sortidoV  where supervisor = '$cood ' and mes = '$mes' ");
    $UP->execute();


}

//--------------------------------------------------SERENATA ------------------------------------------------------------


foreach ($result_cood as $value){

    $super = $value['super'];

    $serenataf= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as total FROM $mes a, usuarios b where a.vendedor = b.Rca and Material = '$serenata' and b.super = '$super'");
    $serenataf->execute();
    $result_serenataf= $serenataf->fetchAll();

    foreach ($result_serenataf as $item){

        $serenataV = $item['total'];
        $cood = $item['super'];

        $UP= $conn->prepare("UPDATE campanha_super set serenataF = $serenataV  where supervisor = '$cood ' and mes = '$mes' ");
        $UP->execute();


    }



}



$serenatat= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.valor, '.', ''), ',', '.') as decimal(10,2))) as total FROM `ped_flexx`a, usuarios b WHERE a.rca = b.rca and a.cod_prod = '$serenata' and a.data BETWEEN '$segunda' and '$sexta' group by b.super ");
$serenatat->execute();
$result_serenatat= $serenatat->fetchAll();


foreach ($result_serenatat as $item){

    $serenataV = $item['total'];
    $cood = $item['super'];

    $UP= $conn->prepare("UPDATE campanha_super set sortidoT = $serenataV  where supervisor = '$cood ' and mes = '$mes' ");
    $UP->execute();


}