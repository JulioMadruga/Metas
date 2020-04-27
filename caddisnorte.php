<?php
require_once 'database/conectar2.php';


$M = ['MENTOS','MARILAN','CASAREDO','PEPSICO','BATAVO','RICHS','SANTA AMÁLIA','YASAÍ','BEM BRASIL','FRIMESA','FLEISCHMAN'];

$marcas = array();

foreach ($M as $value){

    $marcas [] = substr($value,0,2).'expositor';
    $marcas [] = substr($value,0,2).'cartaz';
    $marcas [] = substr($value,0,2).'posit';
    $marcas [] = substr($value,0,2).'canal';
    $marcas [] = substr($value,0,2).'QtItens';

}


$itens1 = ['cod_cli','cliente','cod_vend','vend','canal','um','dois','tres','quatro','cinco','seis','sete','oito','nove','dez',
           'onze','doze','treze','quatorze','obs'];

$itensgeral = array_merge($marcas,$itens1);

//$sql = "";

$id_user = $_GET["id"];

foreach ($itensgeral as $itens){


             if(!isset($_POST[$itens])) {

                 $$itens = 'N';

              }elseif ($_POST[$itens]=='on'){

                 $$itens = 'S';

             }else{

                 $$itens = $_POST[$itens];

             }


//echo "<br>";

}




$result = $conn2->query("INSERT INTO ck_disnorte (id_user,cod_cli,cliente,cod_vend,vendedor,canal,MEexpositor,MEcartaz,MEposit,MEcanal,MEQtItens,MAexpositor
                                  ,MAcartaz,MAposit,MAcanal,MAQtItens,CAexpositor,CAcartaz,CAposit,CAcanal,CAQtItens,PEexpositor,PEcartaz,PEposit,PEcanal,PEQtItens,
                                  BAexpositor,BAcartaz,BAposit,BAcanal,BAQtItens,RIexpositor,RIcartaz,RIposit,RIcanal,RIQtItens,SAexpositor,SAcartaz,SAposit,SAcanal,
                                  SAQtItens,YAexpositor,YAcartaz,YAposit,YAcanal,YAQtItens,BEexpositor,BEcartaz,BEposit,BEcanal,BEQtItens,FRexpositor,FRcartaz,FRposit,
                                  FRcanal,FRQtItens,FLexpositor,FLcartaz,FLposit,FLcanal,FLQtItens,um,dois,tres,quatro,cinco,seis,sete,
                                  oito,nove,dez,onze,doze,treze,quatorze,obs,dt_cad)
                                  VALUES ('$id_user','$cod_cli','$cliente','$cod_vend','$vend','$canal','$MEexpositor','$MEcartaz',
                                  '$MEposit','$MEcanal','$MEQtItens','$MAexpositor','$MAcartaz','$MAposit','$MAcanal','$MAQtItens','$CAexpositor','$CAcartaz','$CAposit',
                                  '$CAcanal','$CAQtItens','$PEexpositor','$PEcartaz','$PEposit','$PEcanal','$PEQtItens','$BAexpositor','$BAcartaz','$BAposit','$BAcanal',
                                  '$BAQtItens','$RIexpositor','$RIcartaz','$RIposit','$RIcanal','$RIQtItens','$SAexpositor','$SAcartaz','$SAposit','$SAcanal','$SAQtItens',
                                  '$YAexpositor','$YAcartaz','$YAposit','$YAcanal','$YAQtItens','$BEexpositor','$BEcartaz','$BEposit','$BEcanal','$BEQtItens','$FRexpositor',
                                  '$FRcartaz','$FRposit','$FRcanal','$FRQtItens','$FLexpositor','$FLcartaz','$FLposit','$FLcanal','$FLQtItens','$um','$dois','$tres',
                                  '$quatro','$cinco','$seis','$sete','$oito','$nove','$dez','$onze','$doze','$treze','$quatorze','$obs',NOW())");


header('Location: painel.php?result=ok');
die();