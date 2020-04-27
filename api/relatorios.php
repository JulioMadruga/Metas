<?php

include_once "../database/conectar.php";

//$res = array('error' => false);

$action = 'read';

if(isset($_GET['action'])){
    $action = $_GET['action'];
}


if($action == 'read'){


    $result = $conn->query("SELECT (mentos1 + mentos2)/2 as MENTOS,(marilan1 + marilan2)/2 as MARILAN,(casaredo1 + casaredo2)/2 as CASAREDO,(pepsico1 + pepsico2)/2 as PEPSICO,(batavo1 + batavo2)/2 as BATAVO,(rich1 + rich2)/2 as RICHS,(sta1 + sta2)/2 as SANTA_AMALIA,(yasai1 + yasai2)/2 as YASAI,(bbrasil1 + bbrasil2)/2 as BEM_BRASIL,(frimesa1 + frimesa2)/2 as FRIMESA,(fleshmann1 + fleshmann2)/2 as FLEISHMANN from(SELECT sum(if(MEexpositor = 'S',1,0))as mentos1, sum(if(MEcartaz = 'S',1,0))as mentos2, sum(if(MAexpositor = 'S',1,0))as marilan1, sum(if(MAcartaz = 'S',1,0))as marilan2, sum(if(CAexpositor = 'S',1,0))as casaredo1, sum(if(CAcartaz = 'S',1,0))as casaredo2, sum(if(PEexpositor = 'S',1,0))as pepsico1, sum(if(PEcartaz = 'S',1,0))as pepsico2,
sum(if(BAexpositor = 'S',1,0))as batavo1, sum(if(RIcartaz = 'S',1,0))as batavo2, sum(if(RIexpositor = 'S',1,0))as rich1, sum(if(BAcartaz = 'S',1,0))as rich2,sum(if(SAexpositor = 'S',1,0))as sta1, sum(if(SAcartaz = 'S',1,0))as sta2, sum(if(YAexpositor = 'S',1,0))as yasai1, sum(if(YAcartaz = 'S',1,0))as yasai2, sum(if(BEexpositor = 'S',1,0))as bbrasil1, sum(if(Becartaz = 'S',1,0))as bbrasil2,  sum(if(FRexpositor = 'S',1,0))as frimesa1, sum(if(FRcartaz = 'S',1,0))as frimesa2,sum(if(Flexpositor = 'S',1,0))as fleshmann1, sum(if(Flcartaz = 'S',1,0))as fleshmann2 FROM `ck_disnorte`)sub");



    $relMerchan= array();
    $relMerchan2= array();


    while($row = $result->fetch_assoc()){

        array_push( $relMerchan, array_values($row));
        array_push( $relMerchan2, array_keys($row));

    }

    $res['relMerchan'] = $relMerchan;
    $res2['relMerchan2'] = $relMerchan2;

    $res3 = array_merge($res,$res2);
//    var_dump($relMerchan);
//    var_dump($relMerchan2);
}


if($action == 'merchan'){

    $id = $_POST['id'];

    $result = $conn->query("SELECT (mentos1 + mentos2)/2 as MENTOS,(marilan1 + marilan2)/2 as MARILAN,(casaredo1 + casaredo2)/2 as CASAREDO,(pepsico1 + pepsico2)/2 as PEPSICO,(batavo1 + batavo2)/2 as BATAVO,(rich1 + rich2)/2 as RICHS,(sta1 + sta2)/2 as SANTA_AMALIA,(yasai1 + yasai2)/2 as YASAI,(bbrasil1 + bbrasil2)/2 as BEM_BRASIL,(frimesa1 + frimesa2)/2 as FRIMESA,(fleshmann1 + fleshmann2)/2 as FLEISHMANN from(SELECT sum(if(MEexpositor = 'S',1,0))as mentos1, sum(if(MEcartaz = 'S',1,0))as mentos2, sum(if(MAexpositor = 'S',1,0))as marilan1, sum(if(MAcartaz = 'S',1,0))as marilan2, sum(if(CAexpositor = 'S',1,0))as casaredo1, sum(if(CAcartaz = 'S',1,0))as casaredo2, sum(if(PEexpositor = 'S',1,0))as pepsico1, sum(if(PEcartaz = 'S',1,0))as pepsico2,
sum(if(BAexpositor = 'S',1,0))as batavo1, sum(if(RIcartaz = 'S',1,0))as batavo2, sum(if(RIexpositor = 'S',1,0))as rich1, sum(if(BAcartaz = 'S',1,0))as rich2,sum(if(SAexpositor = 'S',1,0))as sta1, sum(if(SAcartaz = 'S',1,0))as sta2, sum(if(YAexpositor = 'S',1,0))as yasai1, sum(if(YAcartaz = 'S',1,0))as yasai2, sum(if(BEexpositor = 'S',1,0))as bbrasil1, sum(if(Becartaz = 'S',1,0))as bbrasil2,  sum(if(FRexpositor = 'S',1,0))as frimesa1, sum(if(FRcartaz = 'S',1,0))as frimesa2,sum(if(Flexpositor = 'S',1,0))as fleshmann1, sum(if(Flcartaz = 'S',1,0))as fleshmann2 FROM `ck_disnorte` where id_user in ($id))sub");



   $relMerchan= array();
   $relMerchan2= array();


    while($row = $result->fetch_assoc()){

      array_push( $relMerchan, array_values($row));
      array_push( $relMerchan2, array_keys($row));

    }

    $res['relMerchan'] = $relMerchan;
    $res2['relMerchan2'] = $relMerchan2;

    $res3 = array_merge($res,$res2);
//    var_dump($relMerchan);
//    var_dump($relMerchan2);
}


if($action == 'presenca'){

    $id = $_POST['id'];

    $result = $conn->query("SELECT (mentos1 + mentos2)/2 as MENTOS,(marilan1 + marilan2)/2 as MARILAN,(casaredo1 + casaredo2)/2 as CASAREDO,(pepsico1 + pepsico2)/2 as PEPSICO,(batavo1 + batavo2)/2 as BATAVO,(rich1 + rich2)/2 as RICHS,(sta1 + sta2)/2 as SANTA_AMALIA,(yasai1 + yasai2)/2 as YASAI,(bbrasil1 + bbrasil2)/2 as BEM_BRASIL,(frimesa1 + frimesa2)/2 as FRIMESA,(fleshmann1 + fleshmann2)/2 as FLEISHMANN from(SELECT sum(if(MEexpositor = 'S',1,0))as mentos1, sum(if(MEcartaz = 'S',1,0))as mentos2, sum(if(MAexpositor = 'S',1,0))as marilan1, sum(if(MAcartaz = 'S',1,0))as marilan2, sum(if(CAexpositor = 'S',1,0))as casaredo1, sum(if(CAcartaz = 'S',1,0))as casaredo2, sum(if(PEexpositor = 'S',1,0))as pepsico1, sum(if(PEcartaz = 'S',1,0))as pepsico2,
sum(if(BAexpositor = 'S',1,0))as batavo1, sum(if(RIcartaz = 'S',1,0))as batavo2, sum(if(RIexpositor = 'S',1,0))as rich1, sum(if(BAcartaz = 'S',1,0))as rich2,sum(if(SAexpositor = 'S',1,0))as sta1, sum(if(SAcartaz = 'S',1,0))as sta2, sum(if(YAexpositor = 'S',1,0))as yasai1, sum(if(YAcartaz = 'S',1,0))as yasai2, sum(if(BEexpositor = 'S',1,0))as bbrasil1, sum(if(Becartaz = 'S',1,0))as bbrasil2,  sum(if(FRexpositor = 'S',1,0))as frimesa1, sum(if(FRcartaz = 'S',1,0))as frimesa2,sum(if(Flexpositor = 'S',1,0))as fleshmann1, sum(if(Flcartaz = 'S',1,0))as fleshmann2 FROM `ck_disnorte` where id_user in ($id))sub");



    $relMerchan= array();
    $relMerchan2= array();


    while($row = $result->fetch_assoc()){

        array_push( $relMerchan, array_values($row));
        array_push( $relMerchan2, array_keys($row));

    }

    $res['relMerchan'] = $relMerchan;
    $res2['relMerchan2'] = $relMerchan2;

    $res3 = array_merge($res,$res2);
//    var_dump($relMerchan);
//    var_dump($relMerchan2);
}


$conn->close();

header("Content-type: application/json");
echo json_encode($res3);
//echo json_encode($res2);
die();