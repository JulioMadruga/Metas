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

//$segunda = "2020-04-01";

//echo date("Y-m-01") . "\n";
//echo date("Y-m-d") . "\n";
//echo date("Y-m-t") . "\n"; //data de hoje
 $numero_dias = date("t");
 $dias_decorrido =  date("d");


$cli= $conn->prepare("SELECT a.cod_cli, a.rca, b.nome FROM `clientes_flexx` a , usuarios b where a.rca = b.rca");
$cli->execute();
$result_cli = $cli->fetchAll();



//foreach ($result_cli as $key => $value){
//    $nome = $value['nome'];
//
//    $upvenda = $conn->prepare("UPDATE clientes set rca = ".$value['rca'].", vendedor ='$nome' where cod_cli = ".$value['cod_cli']."");
// var_dump($upvenda);
//    $upvenda->execute();
//
//    $upvenda2 = $conn->prepare("UPDATE $mes set vendedor = ".$value['rca']." where ID = ".$value['cod_cli']."");
//    //var_dump($upvenda);
//    $upvenda2->execute();
//}


$zeratabela = $conn->prepare("Truncate table venda_diaria");
$zeratabela ->execute();



$consulta_meta = $conn->prepare("SELECT b.super, a.rca, b.nome, a.valor FROM $meta a, usuarios b where a.rca = b.Rca");
$consulta_meta->execute();
$result_meta= $consulta_meta->fetchAll();


foreach ($result_meta as $key => $value){

    $inserttab = $conn->prepare("INSERT INTO venda_diaria (super,rca,vendedor,meta,realizado,seg,ter,qua,qui,sex,realfat,tendenciafecha,tendencia,gap) VALUES  ('".$value['super']."','".$value['rca']."','".$value['nome']."','".$value['valor']."',0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ) ");
   // var_dump($inserttab );
    $inserttab->execute();

}

$consulta_venda = $conn->prepare("SELECT a.VENDEDOR, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2)))as Total FROM abril a group by a.VENDEDOR");
$consulta_venda->execute();
$result_venda= $consulta_venda->fetchAll();


foreach ($result_venda as $key => $value){

    $total = $value['Total'];
    $vendedor = $value['VENDEDOR'];

    if($vendedor != "#N/D"){
        $upvenda = $conn->prepare("UPDATE venda_diaria set realizado = $total where Rca = $vendedor");
        var_dump($upvenda);
        $upvenda->execute();
    }




}
//
//------------------------------------------------- dias ------------------------------------------------------------------------------------


$upseg= $conn->prepare("SELECT rca, sum(total) as Total from(SELECT sum(cast(replace(replace(a.valor, '.', ''), ',', '.') as decimal(10,2))) as total, a.* FROM `ped_flexx` a where data = '$segunda' GROUP BY cod_ped) sub GROUP by rca");
$upseg->execute();
$result_seg= $upseg->fetchAll();


foreach ($result_seg as $key => $value){

    $upvenda = $conn->prepare("UPDATE venda_diaria set seg = ".$value['Total']." where Rca = ".$value['rca']."");
    //var_dump($upvenda);
    $upvenda->execute();
}

$upter = $conn->prepare("SELECT rca, sum(total) as Total from(SELECT sum(cast(replace(replace(a.valor, '.', ''), ',', '.') as decimal(10,2))) as total, a.* FROM `ped_flexx` a where data = '$terca' GROUP BY cod_ped) sub GROUP by rca");
$upter->execute();
$result_ter= $upter->fetchAll();


foreach ($result_ter as $key => $value){

    $upvenda = $conn->prepare("UPDATE venda_diaria set ter = ".$value['Total']." where Rca = ".$value['rca']."");
    //var_dump($upvenda);
    $upvenda->execute();
}

$upqua = $conn->prepare("SELECT rca, sum(total) as Total from(SELECT sum(cast(replace(replace(a.valor, '.', ''), ',', '.') as decimal(10,2))) as total, a.* FROM `ped_flexx` a where data = '$quarta' GROUP BY cod_ped) sub GROUP by rca");
$upqua->execute();
$result_qua= $upqua->fetchAll();


foreach ($result_qua as $key => $value){

    $upvenda = $conn->prepare("UPDATE venda_diaria set qua = ".$value['Total']." where Rca = ".$value['rca']."");
    //var_dump($upvenda);
    $upvenda->execute();
}

$upqui = $conn->prepare("SELECT rca, sum(total) as Total from(SELECT sum(cast(replace(replace(a.valor, '.', ''), ',', '.') as decimal(10,2))) as total, a.* FROM `ped_flexx` a where data = '$quinta' GROUP BY cod_ped) sub GROUP by rca");
$upqui->execute();
$result_qui = $upqui->fetchAll();


foreach ($result_qui as $key => $value){

    $upvenda = $conn->prepare("UPDATE venda_diaria set qui = ".$value['Total']." where Rca = ".$value['rca']."");
    //var_dump($upvenda);
    $upvenda->execute();
}

$upsex = $conn->prepare("SELECT rca, sum(total) as Total from(SELECT sum(cast(replace(replace(a.valor, '.', ''), ',', '.') as decimal(10,2))) as total, a.* FROM `ped_flexx` a where data = '$sexta' GROUP BY cod_ped) sub GROUP by rca");
$upsex->execute();
$result_sex = $upsex->fetchAll();


foreach ($result_sex as $key => $value){

    $upvenda = $conn->prepare("UPDATE venda_diaria set sex = ".$value['Total']." where Rca = ".$value['rca']."");
    //var_dump($upvenda);
    $upvenda->execute();
}


//----------------------------------------------------- dias ------------------------------------------------------------------------------------


$uprealfat = $conn->prepare("SELECT rca, realizado, round((realizado+seg+ter+qua+qui+sex),2) as Total FROM `venda_diaria`");
$uprealfat->execute();
$result_realfat = $uprealfat->fetchAll();


foreach ($result_realfat as $key => $value){

    $upvenda = $conn->prepare("UPDATE venda_diaria set realfat = ".$value['Total']." where Rca = ".$value['rca']."");
    //var_dump($upvenda);
    $upvenda->execute();
}


$valor_tendencia = $conn->prepare("SELECT rca, realfat as Total FROM `venda_diaria`");
$valor_tendencia->execute();
$result_valor_tendencia = $valor_tendencia->fetchAll();


foreach ($result_valor_tendencia as $key => $value){

    $vtendencia = round((($value['Total'] / $dias_decorrido)*30), 2);

    $upvenda = $conn->prepare("UPDATE venda_diaria set tendenciafecha = ".$vtendencia." where Rca = ".$value['rca']."");
    //var_dump($upvenda);
    $upvenda->execute();
}


$tendencia = $conn->prepare("SELECT rca, round(((tendenciafecha/meta)*100),0) as percent FROM `venda_diaria`");
$tendencia->execute();
$result_tendencia = $tendencia->fetchAll();


foreach ($result_tendencia as $key => $value){

    $upvenda = $conn->prepare("UPDATE venda_diaria set tendencia = ".$value['percent']." where Rca = ".$value['rca']."");
    //var_dump($upvenda);
    $upvenda->execute();
}


$gap= $conn->prepare("SELECT rca, round((meta-realfat),2) as gap FROM `venda_diaria`");
$gap->execute();
$result_gap = $gap->fetchAll();


foreach ($result_gap as $key => $value){

    $upvenda = $conn->prepare("UPDATE venda_diaria set gap = ".$value['gap']." where Rca = ".$value['rca']."");
    //var_dump($upvenda);
    $upvenda->execute();
}







echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=relatorio_diariovenda.php'>";


?>

