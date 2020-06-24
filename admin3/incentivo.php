<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.html");
}

include_once '../database/Conexao.php';

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

$mes = "Abril";





$cont_tri = $conn->prepare("select * from trimarca");
$cont_tri->execute();
$result_cont = $cont_tri->fetchAll();

$bat = $result_cont[0][0];
$tal = $result_cont[0][1];
$ser = $result_cont[0][2];
$jum = $result_cont[0][4];
$bisc = $result_cont[0][5];

$sortido = "12415774";
$serenata = "12416237";
$talento25 = "11320197,11320198,11320199,11320209,12277350,11324001";
$talento90 = "12239753,12282740,12311892,12312312,12312330,12285127,12347057,12347058,12347059,12380835,12380836,12370196,12423748";
$pastilha = "11322004";
$pos = "11320040,11320042";





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

   // var_dump($sortidof);

    $sortidof->execute();
    $result_sortidof= $sortidof->fetchAll();

    foreach ($result_sortidof as $item){

        $sortidoV = $item['total'];
        $cood = trim($item['super']);

        $UP= $conn->prepare("UPDATE campanha_super set sortidoF = '$sortidoV'  where supervisor = '$cood ' and mes = '$mes'");
    //var_dump($UP);
      $UP->execute();

     //die();

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

    if($result_serenataf[0][0] !== null){
    foreach ($result_serenataf as $item){

        $serenataV = $item['total'];
        $cood = $item['super'];

        $UP= $conn->prepare("UPDATE campanha_super set serenataF = $serenataV  where supervisor = '$cood ' and mes = '$mes' ");
        $UP->execute();


    }}



}



$serenatat= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.valor, '.', ''), ',', '.') as decimal(10,2))) as total FROM `ped_flexx`a, usuarios b WHERE a.rca = b.rca and a.cod_prod = '$serenata' and a.data BETWEEN '$segunda' and '$sexta' group by b.super ");
$serenatat->execute();
$result_serenatat= $serenatat->fetchAll();


foreach ($result_serenatat as $item){

    $serenataV = $item['total'];
    $cood = $item['super'];

    $UP= $conn->prepare("UPDATE campanha_super set serenataT = $serenataV  where supervisor = '$cood ' and mes = '$mes' ");
    $UP->execute();


}

//----------------------------------------------------BATON--------------------------------------------------------------


foreach ($result_cood as $value){

    $super = $value['super'];

    $batonf= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as total FROM $mes a, usuarios b where a.vendedor = b.Rca and Material in ($bat) and b.super = '$super'");
    $batonf->execute();
    $result_batonf= $batonf->fetchAll();

    foreach ($result_batonf as $item){

        $batonV = $item['total'];
        $cood = $item['super'];

        $UP= $conn->prepare("UPDATE campanha_super set batomF = '$batonV' where supervisor = '$cood ' and mes = '$mes' ");
        $UP->execute();


    }



}



$batont= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.valor, '.', ''), ',', '.') as decimal(10,2))) as total FROM `ped_flexx`a, usuarios b WHERE a.rca = b.rca and a.cod_prod in ($bat) and a.data BETWEEN '$segunda' and '$sexta' group by b.super ");
$batont->execute();
$result_batont= $batont->fetchAll();


foreach ($result_batont as $item){

    $batonV = $item['total'];
    $cood = $item['super'];

    $UP= $conn->prepare("UPDATE campanha_super set batomT = $batonV  where supervisor = '$cood ' and mes = '$mes' ");
    $UP->execute();


}

//--------------------------------------------------BISCOITO------------------------------------------------------------

foreach ($result_cood as $value){

    $super = $value['super'];

    $biscf= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as total FROM $mes a, usuarios b where a.vendedor = b.Rca and Material in ($bisc) and b.super = '$super'");
    $biscf->execute();
    $result_biscf= $biscf->fetchAll();


    if($result_biscf[0][0] !== null){
        foreach ($result_biscf as $item){

            $biscV = $item['total'];
            $cood = $item['super'];

            $UP= $conn->prepare("UPDATE campanha_super set biscF = $biscV  where supervisor = '$cood ' and mes = '$mes' ");
            $UP->execute();


        }

    }





}



$bisct= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.valor, '.', ''), ',', '.') as decimal(10,2))) as total FROM `ped_flexx`a, usuarios b WHERE a.rca = b.rca and a.cod_prod in ($bisc) and a.data BETWEEN '$segunda' and '$sexta' group by b.super ");
$bisct->execute();
$result_bisct= $bisct->fetchAll();


foreach ($result_bisct as $item){

    $biscV = $item['total'];
    $cood = $item['super'];

    $UP= $conn->prepare("UPDATE campanha_super set biscT = $biscV  where supervisor = '$cood ' and mes = '$mes' ");
    $UP->execute();


}



//--------------------------------------------------TALENTO 25G------------------------------------------------------------

foreach ($result_cood as $value){

    $super = $value['super'];

    $talento25f= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as total FROM $mes a, usuarios b where a.vendedor = b.Rca and Material in ($talento25) and b.super = '$super'");
    $talento25f->execute();
    $result_talento25f= $talento25f->fetchAll();


    if($result_talento25f[0][0] !== null){
        foreach ($result_talento25f as $item){

            $talento25V = $item['total'];
            $cood = $item['super'];

            $UP= $conn->prepare("UPDATE campanha_super set talento25F = '$talento25V' where supervisor = '$cood ' and mes = '$mes' ");
            $UP->execute();


        }

    }





}



$talento25t= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.valor, '.', ''), ',', '.') as decimal(10,2))) as total FROM `ped_flexx`a, usuarios b WHERE a.rca = b.rca and a.cod_prod in ($talento25) and a.data BETWEEN '$segunda' and '$sexta' group by b.super ");
$talento25t->execute();
$result_talento25t= $talento25t->fetchAll();


foreach ($result_talento25t as $item){

    $talento25V = $item['total'];
    $cood = $item['super'];

    $UP= $conn->prepare("UPDATE campanha_super set talento25T = $talento25V  where supervisor = '$cood ' and mes = '$mes' ");
    $UP->execute();


}

//--------------------------------------------------TALENTO 90G------------------------------------------------------------

foreach ($result_cood as $value){

    $super = $value['super'];

    $talento90f= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as total FROM $mes a, usuarios b where a.vendedor = b.Rca and Material in ($talento90) and b.super = '$super'");
    $talento90f->execute();
    $result_talento90f= $talento90f->fetchAll();


    if($result_talento90f[0][0] !== null){
        foreach ($result_talento90f as $item){

            $talento90V = $item['total'];
            $cood = $item['super'];

            $UP= $conn->prepare("UPDATE campanha_super set talento90F = $talento90V  where supervisor = '$cood ' and mes = '$mes' ");
            $UP->execute();


        }

    }





}



$talento90t= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.valor, '.', ''), ',', '.') as decimal(10,2))) as total FROM `ped_flexx`a, usuarios b WHERE a.rca = b.rca and a.cod_prod in ($talento90) and a.data BETWEEN '$segunda' and '$sexta' group by b.super ");
$talento90t->execute();
$result_talento90t= $talento90t->fetchAll();


foreach ($result_talento90t as $item){

    $talento90V = $item['total'];
    $cood = $item['super'];

    $UP= $conn->prepare("UPDATE campanha_super set talento90T = $talento90V  where supervisor = '$cood ' and mes = '$mes' ");
    $UP->execute();


}


//-------------------------------------------------- JUMBO ------------------------------------------------------------

foreach ($result_cood as $value){

    $super = $value['super'];

    $jumbof= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as total FROM $mes a, usuarios b where a.vendedor = b.Rca and Material in ($jum) and b.super = '$super'");
    $jumbof->execute();
    $result_jumbof= $jumbof->fetchAll();


    if($result_jumbof[0][0] !== null){
        foreach ($result_jumbof as $item){

            $jumboV = $item['total'];
            $cood = $item['super'];

            $UP= $conn->prepare("UPDATE campanha_super set jumboF = $jumboV  where supervisor = '$cood ' and mes = '$mes' ");
            $UP->execute();


        }

    }




}



$jumbot= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.valor, '.', ''), ',', '.') as decimal(10,2))) as total FROM `ped_flexx`a, usuarios b WHERE a.rca = b.rca and a.cod_prod in ($jum) and a.data BETWEEN '$segunda' and '$sexta' group by b.super ");
$jumbot->execute();
$result_jumbot= $jumbot->fetchAll();


foreach ($result_jumbot as $item){

    $jumboV = $item['total'];
    $cood = $item['super'];

    $UP= $conn->prepare("UPDATE campanha_super set jumboT = $jumboV  where supervisor = '$cood ' and mes = '$mes' ");
    $UP->execute();


}

//-------------------------------------------------- PASTILHA ------------------------------------------------------------


foreach ($result_cood as $value){

    $super = $value['super'];

    $pastilhaf= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as total FROM $mes a, usuarios b where a.vendedor = b.Rca and Material = '$pastilha' and b.super = '$super'");
    $pastilhaf->execute();
    $result_pastilhaf= $pastilhaf->fetchAll();

    if($result_pastilhaf[0][0] !== null){
        foreach ($result_pastilhaf as $item){

            $pastilhaV = $item['total'];
            $cood = $item['super'];

            $UP= $conn->prepare("UPDATE campanha_super set pastilhaF = $pastilhaV  where supervisor = '$cood ' and mes = '$mes' ");
            $UP->execute();


        }}



}



$pastilhat= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.valor, '.', ''), ',', '.') as decimal(10,2))) as total FROM `ped_flexx`a, usuarios b WHERE a.rca = b.rca and a.cod_prod = '$pastilha' and a.data BETWEEN '$segunda' and '$sexta' group by b.super ");
$pastilhat->execute();
$result_pastilhat= $pastilhat->fetchAll();


foreach ($result_pastilhat as $item){

    $pastilhaV = $item['total'];
    $cood = $item['super'];

    $UP= $conn->prepare("UPDATE campanha_super set pastilhaT = $pastilhaV  where supervisor = '$cood ' and mes = '$mes' ");
    $UP->execute();


}

//-------------------------------------------------- Pos ------------------------------------------------------------

foreach ($result_cood as $value){

    $super = $value['super'];

    $posf= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.Valor_total, '.', ''), ',', '.') as decimal(10,2))) as total FROM $mes a, usuarios b where a.vendedor = b.Rca and Material in ($pos) and b.super = '$super'");
    $posf->execute();
    $result_posf= $posf->fetchAll();


    if($result_posf[0][0] !== null){
        foreach ($result_posf as $item){

            $posV = $item['total'];
            $cood = $item['super'];

            $UP= $conn->prepare("UPDATE campanha_super set posF = $posV  where supervisor = '$cood ' and mes = '$mes' ");
            $UP->execute();


        }

    }





}



$post= $conn->prepare("SELECT b.super, sum(cast(replace(replace(a.valor, '.', ''), ',', '.') as decimal(10,2))) as total FROM `ped_flexx`a, usuarios b WHERE a.rca = b.rca and a.cod_prod in ($pos) and a.data BETWEEN '$segunda' and '$sexta' group by b.super ");
$post->execute();
$result_post= $post->fetchAll();


foreach ($result_post as $item){

    $posV = $item['total'];
    $cood = $item['super'];

    $UP= $conn->prepare("UPDATE campanha_super set posT = $posV  where supervisor = '$cood ' and mes = '$mes' ");
    $UP->execute();


}