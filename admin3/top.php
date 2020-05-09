<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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

 $id = $usuario ;
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
        'Feb' => 'Fevereiro',
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
// var_dump($mes);
 
 if (isset($_GET['mes'])){
    $meta = $_GET['mes'];
    
    $mes_select = array(
        'meta1' => 'Janeiro',
        'meta2' => 'Fevereiro',
        'meta3' => 'Marco',
        'meta4' => 'Abril',
        'meta5' => 'Maio',
        'meta6' => 'Junho',
        'meta7' => 'Julho',
        'meta8' => 'Agosto',
        'meta11' => 'Novembro',
        'meta9' => 'Setembro',
        'meta10' => 'Outubro',
        'meta12' => 'Dezembro'
    );
    
    $mes = $mes_select["$meta"];
}

$delete = "DROP TABLE IF EXISTS temp_choc; DROP TABLE IF EXISTS temp_bisc; DROP TABLE IF EXISTS t_choc; DROP TABLE IF EXISTS t_bisc; "; //Esvaziar a tabela
$limpa2 = $conn->prepare($delete);
$limpa2->execute();
$limpa2->closeCursor();



$create_temp= $conn->prepare("CREATE table temp_choc
		select rca, vendedor, sum(total) as total from (SELECT rca, vendedor, hierarquia, if(hierarquia=5534716,(total * 4), if(hierarquia=5534705,(total * 5), if(hierarquia=5534707,(total * 7), if(hierarquia=5534706,(total * 6), if(hierarquia=5534708,(total * 4), if(hierarquia=5534712,(total * 7), if(hierarquia=5534714,(total * 7), total ))))))) as total from (SELECT rca, vendedor,hierarquia, COUNT(hierarquia) as total FROM `clientes` where hierarquia in (5534707,5534712,5534714,5534706,5534705,5534716,5534708) GROUP by hierarquia, rca ORDER by rca)sub)sub GROUP by rca
        ");
//var_dump($import24);
$create_temp->execute();
$create_temp->closeCursor();

$create_temp2= $conn->prepare("CREATE table temp_bisc
		select rca, vendedor, sum(total) as total from (SELECT rca, vendedor, hierarquia, if(hierarquia=5534716,(total * 1), if(hierarquia=5534705,(total * 2), if(hierarquia=5534707,(total * 4), if(hierarquia=5534706,(total * 3), if(hierarquia=5534708,(total * 1), if(hierarquia=5534712,(total * 4), if(hierarquia=5534714,(total * 4), total ))))))) as total from (SELECT rca, vendedor,hierarquia, COUNT(hierarquia) as total FROM `clientes` where hierarquia in (5534707,5534712,5534714,5534706,5534705,5534716,5534708) GROUP by hierarquia, rca ORDER by rca)sub)sub GROUP by rca
        ");
//var_dump($import24);
$create_temp2->execute();
$create_temp2->closeCursor();

$delete2 = "DROP TABLE IF EXISTS top_ranking_$mes;"; //Esvaziar a tabela
$limpa = $conn->prepare($delete2);
$limpa->execute();
$limpa->closeCursor();

$delete3= "DROP TABLE IF EXISTS t_bisc_$mes;"; //Esvaziar a tabela
$limpa = $conn->prepare($delete3);
$limpa->execute();
$limpa->closeCursor();



$create_temp3= $conn->prepare("CREATE table top_ranking_$mes select rca, meta_choc, total, round((total/meta_choc)*100) as percent from (
		SELECT b.rca,round((d.total*b.topchoc)) as meta_choc, sum(a.total) as total FROM `hierarquia_$mes` a, $meta b, usuarios c,temp_choc d where a.vendedor = b.Rca and b.Rca =c.Rca and b.Rca = d.rca GROUP BY b.Vendedor)sub ORDER by percent DESC
        ");
//var_dump($import24);
$create_temp3->execute();
$create_temp3->closeCursor();

$create_temp4= $conn->prepare("CREATE table t_bisc_$mes select rca, meta_bisc, total, round((total/meta_bisc)*100) as percent from (
		SELECT b.rca,round((d.total*b.topbisc)) as meta_bisc, sum(a.total) as total FROM `hierarquia_bisc_$mes` a, $meta b, usuarios c,temp_bisc d where a.vendedor = b.Rca and b.Rca =c.Rca and b.Rca = d.rca GROUP BY b.Vendedor)sub ORDER by percent DESC
        ");
//var_dump($import24);
$create_temp4->execute();
$create_temp4->closeCursor();



$delete4= "DROP TABLE IF EXISTS ranking;"; //Esvaziar a tabela
$limpa = $conn->prepare($delete4);
$limpa->execute();
$limpa->closeCursor();



$create_rank= $conn->prepare(" CREATE table ranking SELECT super, rca, nome, 0 as metachoc , 0 as realchoc, 0 as percentchoc, 0 as metabisc, 0 as realbisc, 0 as percentbisc, 0 as choc_flexx, 0 as bisc_flexx FROM `usuarios` where super <> '' ORDER by rca ");
//var_dump($import24);
$create_rank->execute();
$create_rank->closeCursor();



$consulta_geral = $conn->prepare("SELECT *  FROM top_ranking_$mes");
$consulta_geral->execute();
$result_geral = $consulta_geral->fetchAll();



foreach ($result_geral as $key => $value){

    $upmeta = $conn->prepare("UPDATE ranking set metachoc = ".$value['meta_choc'].", realchoc = ".$value['total']." , percentchoc = ".$value['percent']." where rca = ".$value['rca']."");
    $upmeta->execute();
}




$consulta_geralb = $conn->prepare("SELECT *  FROM t_bisc_$mes");
$consulta_geralb->execute();
$result_geralb = $consulta_geralb->fetchAll();



foreach ($result_geralb as $key => $value){

    $upmeta = $conn->prepare("UPDATE ranking set metabisc = ".$value['meta_bisc'].", realbisc = ".$value['total']." , percentbisc= ".$value['percent']." where rca = ".$value['rca']."");
    $upmeta->execute();
}


sleep(0.25);



 //------------------------------------------------------------------------------------------------------------------------------------------------------------


    
    $cli_sap = $conn->prepare("SELECT cod_cli FROM `ped_flexx` WHERE cod_canal = 0");
    $cli_sap ->execute();
    $result_cli_sap  = $cli_sap ->fetchAll();

    foreach ($result_cli_sap as $value){

        $cli_ped = $conn->prepare("SELECT cod_cli, cod_canal FROM `clientes_sap` where cod_cli = $value[0]");
        $cli_ped ->execute();
        $result_cli_ped  = $cli_ped ->fetchAll();

        foreach ($result_cli_ped as $row){

            $up_pedflexx = $conn->prepare("UPDATE `ped_flexx` set cod_canal = $row[1] where cod_canal = 0 and cod_cli = $row[0]");
            $up_pedflexx  ->execute();
            var_dump($up_pedflexx);



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

//echo date("Y-m-01") . "\n";
//echo date("Y-m-d") . "\n";
//echo date("Y-m-t") . "\n"; //data de hoje
$numero_dias = date("t");
$dias_decorrido =  date("d");





$ped_flexx= $conn->prepare("select rca, sum(total) from (
		SELECT rca,COUNT(cod_canal) as total, 'as5' as cod_canal FROM (SELECT * FROM ped_flexx where cod_canal in (5534707,5534712,5534714) and cod_prod in (12415774,12356998,12331542,12312312,11320198,11320367,12416237,12396888,12396921) and data BETWEEN '$segunda' and '$sexta' GROUP by cod_cli, cod_prod) sub GROUP by cod_canal, rca  UNION ALL
        SELECT rca,COUNT(cod_canal) as total, 'as34' as cod_canal from (SELECT * FROM ped_flexx where cod_canal in (5534706) and cod_prod in (12415774,12356998,11320198,11320331,11320367,12416237,12396888) and data BETWEEN '$segunda' and '$sexta' GROUP by cod_cli, cod_prod) sub GROUP by cod_canal, rca UNION ALL
        SELECT rca,COUNT(cod_canal) as total, 'as12' as cod_canal FROM (SELECT * FROM ped_flexx where cod_canal in (5534705) and cod_prod in (12415774,12356998,11320198,11320331,11320367,12416237,12396888) and data BETWEEN '$segunda' and '$sexta' GROUP by cod_cli, cod_prod) sub GROUP by cod_canal, rca  UNION ALL
        SELECT rca,COUNT(cod_canal) as total, 'trad' as cod_canal FROM (SELECT * FROM ped_flexx where cod_canal in (5534716) and cod_prod in (11320198,11320367,11320331,12416237) and data BETWEEN '$segunda' and '$sexta' GROUP by cod_cli, cod_prod) sub GROUP by cod_canal, rca  UNION ALL
        SELECT rca,COUNT(cod_canal) as total, 'conv' as cod_canal FROM (SELECT * FROM ped_flexx where cod_canal in (5534708) and cod_prod in (11320198,11320367,11320331,12416237) and data BETWEEN '$segunda' and '$sexta' GROUP by cod_cli, cod_prod) sub GROUP by cod_canal, rca)sub GROUP by rca");
$ped_flexx->execute();
$result_ped_flexx  = $ped_flexx ->fetchAll();

foreach ($result_ped_flexx as $value){

    $up_ranking = $conn->prepare("UPDATE `ranking` set choc_flexx = $value[1] where rca = $value[0] ");
    $up_ranking   ->execute();

    sleep(0.25);
}


$ped_flexx2= $conn->prepare("select rca, sum(total) from (
		SELECT rca,COUNT(cod_canal) as total, 'as5' as cod_canal FROM (SELECT * FROM ped_flexx where cod_canal in (5534707,5534712,5534714) and cod_prod in (12365150,12365129,12365282,12365128) and data BETWEEN '$segunda' and '$sexta' GROUP by cod_cli, cod_prod) sub GROUP by cod_canal, rca  UNION ALL
        SELECT rca,COUNT(cod_canal) as total, 'as34' as cod_canal from (SELECT * FROM ped_flexx where cod_canal in (5534706) and cod_prod in (12365150,12365129,12365128) and data BETWEEN '$segunda' and '$sexta' GROUP by cod_cli, cod_prod) sub GROUP by cod_canal, rca UNION ALL
        SELECT rca,COUNT(cod_canal) as total, 'as12' as cod_canal FROM (SELECT * FROM ped_flexx where cod_canal in (5534705) and cod_prod in (12365150,12365129) and data BETWEEN '$segunda' and '$sexta' GROUP by cod_cli, cod_prod) sub GROUP by cod_canal, rca  UNION ALL
        SELECT rca,COUNT(cod_canal) as total, 'trad' as cod_canal FROM (SELECT * FROM ped_flexx where cod_canal in (5534716) and cod_prod in (12365150) and data BETWEEN '$segunda' and '$sexta' GROUP by cod_cli, cod_prod) sub GROUP by cod_canal, rca  UNION ALL
        SELECT rca,COUNT(cod_canal) as total, 'conv' as cod_canal FROM (SELECT * FROM ped_flexx where cod_canal in (5534708) and cod_prod in (12365150) and data BETWEEN '$segunda' and '$sexta' GROUP by cod_cli, cod_prod) sub GROUP by cod_canal, rca)sub GROUP by rca");
$ped_flexx2->execute();
$result_ped_flexx2  = $ped_flexx2->fetchAll();

foreach ($result_ped_flexx2 as $value){

    $up_ranking = $conn->prepare("UPDATE `ranking` set bisc_flexx = $value[1] where rca = $value[0] ");
    $up_ranking   ->execute();

    sleep(0.25);
}


$consulta_top = $conn->prepare("SELECT * FROM $meta limit 1");

$consulta_top->execute();
$result_top = $consulta_top->fetchAll();

$topchoc = $result_top[0][10];
$topbisc = $result_top[0][11];





$set_meta = $conn->prepare("SELECT a.rca, a.total as choco, b.total as bisc FROM `temp_choc` a, `temp_bisc` b where a.rca = b.rca");
$set_meta->execute();
$result_set_meta  = $set_meta->fetchAll();

foreach ($result_set_meta as $value){

    $choc = $value[1] * $topchoc;
    $bisc = $value[2] * $topbisc;

    $up_ranking = $conn->prepare("UPDATE `ranking` set metachoc = $choc, metabisc = $bisc where rca = $value[0] ");
    $up_ranking   ->execute();

    sleep(0.25);
}

//_-------------------------------------------------------------------------------------------------------------


$consulta_ranking = $conn->prepare("SELECT super, nome, metachoc, realchoc, (metachoc - realchoc) as difchoc, percentchoc, metabisc, realbisc, (metabisc - realbisc) as difbisc, percentbisc FROM `ranking` ORDER BY `ranking`.`percentchoc` DESC");
$consulta_ranking->execute();
$result_ranking = $consulta_ranking->fetchAll();


$mes_sel = array(
    '1' => 'Janeiro',
    '2' => 'Fevereiro',
    '3' => 'Marco',
    '4' => 'Abril',
    '5' => 'Maio',
    '6' => 'Junho',
    '7' => 'Julho',
    '8' => 'Agosto',
    '11' => 'Novembro',
    '9' => 'Setembro',
    '10' => 'Outubro',
    '12' => 'Dezembro'
);


?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Painel Administrador</title>
        <style type="text/css">
        .link a { color: #000000;}
        .link a:hover {text-decoration: none; font-weight: bold;
        }
        .link:hover{ background: #9ef15c;}

        </style>

         <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="../css/print.css" media="print" />
                <link rel="stylesheet" href="../css/bootstrap-theme.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.css.map">
    <link rel="stylesheet" href="../css/bootstrap.css.map">
    <link rel="stylesheet" href="../css/menu.css">

    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png" />
    <script src="../js/bootstrap.js"></script>
    <script src="../js/calc_total.js"></script>
    <script src="../js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     
     <script>   // aqui eh a base da pagina
         window.onload = function(){
             document.getElementById('regiao').onchange = function(){
                 window.location = '?regiao=' + this.value + '&mes=' + document.getElementById('mes').value;

             }
             document.getElementById('mes').onchange = function(){
                 window.location = '?mes=' + this.value;


             }

         }


$(document).ready( function(){
    
$("#painel").hide(); 
$("#painel").slideDown(1500);


$("tr:even").css("background","rgba(36, 141, 173, 0.73)");
$("tr:first").css("background","#104455");
//$("tr:last").css("background","#820505");


});

jQuery(document).ready(function (e) {
    function t(t) {
        e(t).bind("click", function (t) {
            t.preventDefault();
            e(this).parent().fadeOut()
        })
    }
    e(".dropdown-toggle").click(function () {
        var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(":hidden");
        e(".button-dropdown .dropdown-menu").hide();
        e(".button-dropdown .dropdown-toggle").removeClass("active");
        if (t) {
            e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(".button-dropdown").children(".dropdown-toggle").addClass("active")
        }
    });
    e(document).bind("click", function (t) {
        var n = e(t.target);
        if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-menu").hide();
    });
    e(document).bind("click", function (t) {
        var n = e(t.target);
        if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-toggle").removeClass("active");
    })
});

</script>
     
     
    </head>
    <body>
    <div id="nav" class="col-lg-12"  style="background: #121415;">
        <ul class="nav">
            <li role="presentation"><a href="index.php">Resumo de vendas</a></li>

            <!--          <li class="button-dropdown"><a href="javascript:void(0)" class="dropdown-toggle">  Positivações  <span>▼</span>  </a>-->
            <!--              <ul class="dropdown-menu">-->
            <!--                  <li><a href="trimarca.php">Positivação Geral</a></li>-->
            <!--                  <li><a href="baton.php">Positivação Baton</a></li>-->
            <!--                  <li><a href="jumbos.php">Positivação Biscoitos</a></li>-->
            <!--                  <li><a href="rech.php">Recheados</a></li>-->
            <!--                  <li><a href="cookies.php">Cookies</a></li>-->
            <!---->
            <!--</ul>-->
            <!---->
            <!--</li>-->

            <li class="button-dropdown"><a href="javascript:void(0)" class="dropdown-toggle"> Relatórios <span>▼</span>  </a>
                <ul class="dropdown-menu">
                    <li role="presentation" id="active"><a href="top.php">Ranking Top Obrigatório</a></li>
                    <li role="presentation"><a href="acessos.php">Relat. de Acessos</a></li>
                </ul>
            </li>


            <?php if($usuario =="Julio" || $usuario =="Marciano"){?>


                <li class="button-dropdown"><a href="javascript:void(0)" class="dropdown-toggle"> Cadastros <span>▼</span>  </a>
                    <ul class="dropdown-menu">
                        <li role="presentation" ><a href="cadastrar.php">Cadastrar Metas</a></li>
                        <li role="presentation" ><a href="campanha.php">Cad. Campanhas</a></li>
                        <li role="presentation" ><a href="cadcood.php">Cad. Coordenadores</a></li>
                        <li role="presentation" ><a href="cadvend.php">Cad. Vendedores</a></li>
                        <?php
                        if($usuario =="Julio" || $usuario =="Marciano"){

                            echo '<li role="presentation" ><a href="solicitacao.php">Solic. Cadastros</a></li>';
                        }

                        ?>
                    </ul>

                </li>
                <li class="button-dropdown"><a href="javascript:void(0)" class="dropdown-toggle">Importacao<span>▼</span>  </a>
                    <ul class="dropdown-menu">
                        <li><a href="Importacao.php">Resultados</a></li>
                        <li><a href="clientes.php">Clientes</a></li>
                        <li role="presentation" ><a href="financeiro.php">Financeiro</a></li>
                        <li role="presentation" ><a href="produtos.php">Produtos</a></li>
                        <li role="presentation" ><a href="email/index.php">Venda Diaria</a></li>


                    </ul>

                </li>

            <?php  }  ?>

            <li role="presentation" style="float: right;padding-top: 10px;padding-right: 5px;"><input  class="btn btn-danger btn-xs" type="submit" value="Sair" onclick="location.  href='../index.html'"></li>
            <li role="presentation" style="float: right;"><h5 style="color: #A6CFF3; font-family: sans-serif;padding-top: 4px;">Usuário: <strong><?php print $usuario ; ?></strong> &nbsp&nbsp&nbsp&nbsp</h5></li>

        </ul>
    </div>

    <div class="row" style="padding-top: 50px;background: #737373;">
       
        <div class="col-md-2"></div> 
        <div class="col-md-2" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;height: 50px; padding-top: 5px;"><img src="../images/disnorte.png"></div> 
        <div class="col-md-4" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;height: 50px; padding-top: 5px;"><h4>SISTEMA DE ACOMPANHAMENTO DE METAS</h4></div>
        <div class="col-md-2" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;"><img src="../images/garoto.png"></div> 
        <div class="col-md-2"></div>
        
       </div>     
        

         <div class="row" style="background: #737373;">   
         <div class="col-md-2"></div> 
         <div class="col-md-2" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;height: 32px; padding-top: 5px;"></div> 
        <div class="col-md-4" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;height: 32px;">
        Selecionar Mês: &nbsp&nbsp

            <?php echo' <select id="mes" name="mes"style="height: 30px; background-color: #0C4F63;color: #ffffff; font-family: sans-serif; width: 200px; font-size: 18px;text-align: center; font-weight: bold;" > 
      
';

            $i=1;


            while ($i <= 12) {
                $consulta_mes = $conn->prepare("SELECT data_doc from " . $mes_sel [$i] . " limit 1");
                $consulta_mes->execute();
                $result_mes = $consulta_mes->fetchAll();


                echo '
    
     <option value="meta' . $i . '"';

                if ($i > 9) {
                    if ($i == substr($meta, -2)) {
                        echo 'selected';
                    }
                } else{
                    if ($i == substr($meta, -1)) {
                        echo 'selected';
                    }
                }

                if(empty($result_mes)){

                    echo '>'.$mes.' - '.$ano.'</option>';

                }else{

                    echo '>'.$mes_sel[$i].' - '.substr($result_mes[0][0], -4).'</option>';

                }

                $i++;
            };

            ?>

<?php

echo '         





      </select>


</div>
       
       <div class="col-md-2" style="margin: auto; background-color:#074456;font-family:Oswald; color:#E4F3F7;height: 32px;"> 

</div>
       
        <div class="col-md-2"></div> 
       
    </div>    


<div id="painel" class="row" style="background: #737373;">
<div class="col-md-2"></div> 

<div class="col-md-8" style="text-align:center; padding-top: 15px; background-color:#CED4D6; font-family:Oswald; color:#270301;">

<button class="btn-success btn-lg" type="button" onclick="javascript:location.href=\'relatorio_diarioMix.php\'">Relatório MIX</button>


</div>    
</div> 
    
<div id="baton" class="row" style="background: #737373;">
<div class="col-md-2" ></div>
        <div class="col-md-8" style=" background: #CED4D6; height: 90px; padding-top: 10px ">    

            <div style="height: 90px; padding: 5px; background-color: #333; font-size: 55px ; color: #FFFFFF; text-align: center; font-weight: bold; font-family:Roboto, sans-serif, serif;">RANKING MIX IDEAL</div>

          </div>

<div class="col-md-2"></div>

</div>




    
<div id="painel" class="row" style="background: #737373;">
<div class="col-md-2"></div> 

<div class="col-md-8" style="text-align:center; padding-top: 15px; background-color:#CED4D6; font-family:Oswald; color:#270301;">
<table id="tabela" align="center" cellpadding="5">

<tr style="font-size: 16px;background: #104455 !important; color: #ffffff; font-size:20px;"> 
<td style="width: 70px; text-align: center; border: solid; border-color: #104454;border-right-color: #CED4D6">#</td>
<td style="width: 140px; text-align: center; border: solid; border-color: #104454;border-right-color: #CED4D6;">Supervisor</td>
<td style="width: 140px; text-align: center; border: solid; border-color: #104454;border-right-color: #CED4D6;">Vendedor</td>
<td style="width: 80px; text-align: center; border: solid; border-color: #104454;border-right-color: #CED4D6;">Meta Mix Chocolate</td>
<td style="width: 80px; text-align: center; border: solid; border-color: #104454;border-right-color: #CED4D6;">Realizado</td>
<td style="width: 80px; text-align: center; border: solid; border-color: #104454;border-right-color: #CED4D6;">Falta</td>
<td style="width: 100px; text-align: center; border: solid; border-color: #104454;border-right-color: #CED4D6;">%</td>
<td style="width: 50px; text-align: center; border: solid; border-color: #104454; border-right-color: #CED4D6;"></td>
<td style="width: 80px; text-align: center; border: solid; border-color: #104454;border-right-color: #CED4D6;">Meta Mix Biscoito</td>
<td style="width: 80px; text-align: center; border: solid; border-color: #104454;border-right-color: #CED4D6;">Realizado</td>
<td style="width: 80px; text-align: center; border: solid; border-color: #104454;border-right-color: #CED4D6;">Falta</td>
<td style="width: 100px; text-align: center; border: solid; border-color: #104454;border-right-color: #CED4D6;">%</td>
<td style="width: 50px; text-align: center; border: solid; border-color: #104454;"></td>


</tr>



';
       
       
    
if (count($result_ranking) ) {
       $i=1;
    foreach($result_ranking as $row) {
        

      echo '<tr class="success" style="background:#47a0b959; font-size:20px;">';
      echo '<td style="width: 70px; text-align: center; border: solid; border-color: #104454;border-right-color: #104454;">'.$i.'&deg;</td>';
      echo '<td style="width: 140px; padding-left: 8px; text-align: left; border: solid; border-color: #104454;border-right-color: #104454;">'.ucfirst(strtolower($row[0])).'</td>';
      echo '<td style="width: 140px; padding-left: 8px; text-align: left; border: solid; border-color: #104454;border-right-color: #104454;">'.$row[1].'</td>';
      echo '<td style="width: 80px; text-align: center; border: solid; border-color: #104454;border-right-color: #104454;">'.$row[2].'</td>';
      echo '<td style="width: 80px; text-align: center; border: solid; border-color: #104454;border-right-color: #104454;">'.$row[3].'</td>';
      echo '<td style="width: 80px; text-align: center; border: solid; border-color: #104454;border-right-color: #104454;">'.$row[4].'</td>';
      echo '<td style="width: 100px; text-align: center; border: solid; border-color: #104454; background: #CED4D6">';

if($row[5]>=100){
   echo '<div class="progress" style="margin-bottom: 0px !important;">
  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:'; if($row[5]>100){echo 100;}else{echo $row[5];}; echo '%">
 '.$row[5].'%
  </div>
</div>';
}elseif ($row[5]>50){
    echo '<div class="progress" style="margin-bottom: 0px !important;">
  <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:'; if($row[5]>100){echo 100;}else{echo $row[5];}; echo '%">
'.$row[5].'%
  </div>
</div>';
}else{
    echo '<div class="progress" style="margin-bottom: 0px !important;">
  <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:'; if($row[5]>100){echo 100;}else{echo $row[5];}; echo '%">
'.$row[5].'%
  </div>
</div>';

}


echo '</td>';


        echo '<td style="width: 50px; text-align: center; border: solid; border-color: #104454; background: #CED4D6">';

        if($row[5]>=100){
            echo '<img width="30px" src="../images/1.png">';
        }elseif ($row[5]>50){
            echo '<img width="30px" src="../images/3.png">';
        }else{
            echo '<img width="30px" src="../images/2.png">';

        }


        echo '</td>';




        echo '<td style="width: 80px; text-align: center; border: solid; border-color: #104454;border-right-color: #104454;">'.$row[6].'</td>';
        echo '<td style="width: 80px; text-align: center; border: solid; border-color: #104454;border-right-color: #104454;">'.$row[7].'</td>';
        echo '<td style="width: 80px; text-align: center; border: solid; border-color: #104454;border-right-color: #104454;">'.$row[8].'</td>';


        echo '<td style="width: 100px; text-align: center; border: solid; border-color: #104454; background: #CED4D6">';

        if($row[9]>=100){
            echo '<div class="progress" style="margin-bottom: 0px !important;">
  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:'; if($row[9]>100){echo 100;}else{echo $row[9];}; echo '%">
 '.$row[9].'%
  </div>
</div>';
        }elseif ($row[9]>50){
            echo '<div class="progress" style="margin-bottom: 0px !important;">
  <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:'; if($row[9]>100){echo 100;}else{echo $row[9];}; echo '%">
'.$row[9].'%
  </div>
</div>';
        }else{
            echo '<div class="progress" style="margin-bottom: 0px !important;">
  <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:'; if($row[9]>100){echo 100;}else{echo $row[9];}; echo '%">
'.$row[9].'%
  </div>
</div>';

        }


        echo '</td>';



        echo '<td style="width: 50px; text-align: center; border: solid; border-color: #104454; background: #CED4D6">';

        if($row[9]>=100){
            echo '<img width="30px" src="../images/1.png">';
        }elseif ($row[9]>50){
            echo '<img width="30px" src="../images/3.png">';
        }else{
            echo '<img width="30px" src="../images/2.png">';

        }


        echo '</td>';





      echo "</tr>";
    
      
   $i++;
   
    }  
  } else {
    echo "Nennhum resultado retornado.";
    echo $id;
   
  }

    echo '</table>';


  echo '

</br>

</div>
<div class="col-md-2"></div> 
<div class="col-md-2"></div> 
</div>

';


       
       ?>
        
        
        
    </body>
</html>
