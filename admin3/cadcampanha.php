<?php

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Cuiaba');
spl_autoload_register(function ($nomeClasse) {

    if(file_exists("../class" . DIRECTORY_SEPARATOR. $nomeClasse.".php") === true){
        require_once ("../class" . DIRECTORY_SEPARATOR. $nomeClasse.".php");
    }

});

$cood = $_GET['cood'];
$mes = $_GET['mes'];

$sortido = str_replace(",",".",str_replace(".","",str_replace("R$ ","",$_POST['sortido'] )));
$serenata = str_replace(",",".",str_replace(".","",str_replace("R$ ","",$_POST['serenata'] )));
$baton = str_replace(",",".",str_replace(".","",str_replace("R$ ","",$_POST['baton'] )));
$bisc = str_replace(",",".",str_replace(".","",str_replace("R$ ","",$_POST['bisc'] )));
$talento25 = str_replace(",",".",str_replace(".","",str_replace("R$ ","",$_POST['talento25'] )));
$talento90 = str_replace(",",".",str_replace(".","",str_replace("R$ ","",$_POST['talento90'] )));
$jumbo = str_replace(",",".",str_replace(".","",str_replace("R$ ","",$_POST['jumbo'])));
$pastilha = str_replace(",",".",str_replace(".","",str_replace("R$ ","",$_POST['pastilha'] )));
$po = str_replace(",",".",str_replace(".","",str_replace("R$ ","",$_POST['po'])));


$meta = new Cood();

$meta->setMes($mes);
$meta->setCood($cood);

$result = $meta->ConsultaMeta();



$meta = new Cood();

$meta->setMes($mes);
$meta->setCood($cood);
$meta->setSortido($sortido);
$meta->setSerenata($serenata);
$meta->setBaton($baton);
$meta->setBisc($bisc);
$meta->setTalento25($talento25);
$meta->setTalento90($talento90);
$meta->setJumbo($jumbo);
$meta->setPastilha($pastilha);
$meta->setPo($po);


if(empty($result)){
    $meta = $meta->Cad_Meta();
    header("Location:cadmeta.php?result=$meta");

}else{

    $meta = $meta->UPmeta();

    header("Location:cadmeta.php?result=$meta");


}








