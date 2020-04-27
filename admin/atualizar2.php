<?php

require_once '../Database/Conexao.php';


$baton = $_POST['baton'];
$talento = $_POST['talento'];
$baton2 =  $_POST['baton2'];
$jumbos =  $_POST['jumbos'];
$rech = $_POST['rech'];
$mix = $_POST['mix'];
$mix2 = $_POST['mix2'];

$topchoc = ($_POST['topchoc']/100);
$topbisc = ($_POST['topbisc']/100);


$mes = $_GET['mes'];




$atuaBaton = $conn->prepare('UPDATE trimarca set baton = "'.$baton.'"');
 $atuaBaton-> execute();


$atuaTalento = $conn->prepare('UPDATE trimarca set talento = "'.$talento.'"');
$atuaTalento-> execute();


$atuaBaton2 = $conn->prepare('UPDATE trimarca set baton2 = "'.$baton2.'"');
$atuaBaton2-> execute();


$atuaJumbos = $conn->prepare('UPDATE trimarca set jumbos = "'.$jumbos.'"');
$atuaJumbos-> execute();



$atuaRech = $conn->prepare('UPDATE trimarca set rech = "'.$rech.'"');
$atuaRech-> execute();

$atuaRech = $conn->prepare('UPDATE trimarca set mix = "'.$mix.'"');
$atuaRech-> execute();

$atuaRech = $conn->prepare('UPDATE trimarca set mixtotal = "'.$mix2.'"');
$atuaRech-> execute();

$atuaTopChoc = $conn->prepare('UPDATE '.$mes.' set topchoc = "'.$topchoc.'"');
$atuaTopChoc -> execute();

$atuaTopBisc = $conn->prepare('UPDATE '.$mes.' set topbisc = "'.$topbisc.'"');
$atuaTopBisc -> execute();





echo ("<script>alert('Dados Atualizado com Sucesso!!!');window.history.go(-1);</script>"); die;

      
      
      ?>