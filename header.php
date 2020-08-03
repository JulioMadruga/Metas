<?php
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.html");
}

include_once 'database/conectar.php';

$id = $_SESSION['user_session'];

$usuario =  $_SESSION['name_session'];
$rca =  $_SESSION['rca_session'];

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Cuiaba');
spl_autoload_register(function ($nomeClasse) {

    if(file_exists("class" . DIRECTORY_SEPARATOR. $nomeClasse.".php") === true){
        require_once ("class" . DIRECTORY_SEPARATOR. $nomeClasse.".php");
    }

});




$data = date('D');
$mes = date('M');
$dia = date('d');
$ano = date('Y');
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

$mes_meta= array(
    'Janeiro' => 'meta1',
    'Fevereiro' => 'meta2',
    'Marco' => 'meta3',
    'Abril' => 'meta4',
    'Maio' => 'meta5',
    'Junho' => 'meta6',
    'Julho' => 'meta7',
    'Agosto' => 'meta8',
    'Setembro' => 'meta9',
    'Outubro' => 'meta10',
    'Novembro' => 'meta11',
    'Dezembro' => 'meta12',
    ''    => ''
);

if(isset($_GET['mes'])){
    if ($_GET['mes'] == 'Março'){
        $mes = 'Marco';
    }else{
        $mes = $_GET['mes'];
    }

}else{
    $mes = $mes_extenso["$mes"];
}



$meta = $mes_meta["$mes"];

$kpis = new Kpis();
$kpis = $kpis->all();
//var_dump($kpis);
$bisc = $kpis[0]->rech;
$bat = $kpis[0]->baton;
$jum = $kpis[0]->jumbos;
$tal = $kpis[0]->talento;
$ser = $kpis[0]->serenata;


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/icon/icon.png" type="image/png" />
    <title>Objetivos Chocolates Garoto</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/style.css?a=1">
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }

        table {
            width: 100%;
            overflow-x: scroll;

        }
        .titulo {
            background-color: #363742;
            color: white;
        }
        thead, tbody {
            display: block;
            width: 100%;
        }
        tbody {
            overflow-y: scroll;
            overflow-x: hidden;
            height: 600px;
        }
        tfoot{
            display: block;
            width: 100%;
            height: 40px;

        }

        .linha {
            width: 24% !important;
            height: 25px;
            font-size: 12px;

        }
        .linha2 {
            width: 3% !important;
            height: 25px;
            font-size: 12px;
            text-align: right;

        }


        .linha3 {
            width: 24.8% !important;
            height: 25px;
            font-size: 12px;

        }


    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



    <?php

    $url1 =strtolower($_SERVER["REQUEST_URI"]);
    $url = str_replace("/metas/","",$url1);
 //echo $url;

    if($url !== "clienteatevc.php" && $url !== "clienteatevc" && $url !== "clienteatevc.php?result=ok"){

        echo "

        <script>   // aqui eh a base da pagina
        window.onload = function(){
            document.getElementById('mes').onchange = function(){
                window.location = '?mes=' + this.value;
            }

            };



    </script>
        
        ";

    }

    ?>






</head>
<body class="light" >
<!-- Pre loader -->
<div id="loader" class="loader">
    <div class="plane-container">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>

            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>

            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>

            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="app">
    <aside class="main-sidebar fixed offcanvas shadow">
        <section class="sidebar">
                <div class="w-80px mt-3 mb-3 ml-3" style="width: 180px">
                    <img src="assets/img/basic/logo5.svg" alt="">
                </div>
                <div class="relative">
                    <a data-toggle="collapse" href="#userSettingsCollapse" role="button" aria-expanded="false"
                       aria-controls="userSettingsCollapse" class="btn-fab btn-fab-sm fab-right fab-top btn-primary shadow1 ">
                        <i class="icon icon-cogs"></i>
                    </a>
                    <div class="user-panel p-3 light mb-2">
                        <div>
                            <div class="float-left image">
                                <img class="user_avatar" src="assets/img/dummy/u1.png" alt="User Image">
                            </div>
                            <div class="float-left info">
                                <h6 class="font-weight-light mt-2 mb-1"><?=$usuario?></h6>
                                <a href="#"><i class="icon-circle text-primary blink"></i> Online</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="collapse multi-collapse" id="userSettingsCollapse">
                            <div class="list-group mt-3 shadow">

                                <a href="#" class="list-group-item list-group-item-action"><i
                                            class="mr-2 icon-security text-purple"></i>Alterar a Senha</a>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li class="header"><strong>Menu de Navegação</strong></li>

                    <li><a href="painel.php"><i class="icon icon-analytics blue-grey-text  s-24"></i>Objetivos</a>
                    </li>

                    <li><a href="vendames.php"><i class="icon icon-investment-3 green-text  s-24"></i>Venda do Mês</a>
                    </li>

                    <li class="treeview"><a href="#">
                            <i class="icon icon icon-people blue-text s-24"></i> <span>Positivações</span> <i
                                    class="icon icon-angle-left s-18 pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
<!--                            <li><a href="disnorte.php"><i class="icon icon-notebook-list s-24 text-blue"></i>Disnorte</a>-->
<!--                            </li>-->
                            <li>
                                <a href="geral.php"><i class="icon icon-people_outline s-24 text-light-blue "></i>Geral</a>
                            </li>
                            <li>
                                <a href="baton.php"><i class="icon icon-people_outline s-24 text-red "></i>Baton</a>
                            </li>
                            <li>
                                <a href="biscoito.php"><i class="icon icon-people_outline s-24 text-yellow "></i>Biscoito</a>
                            </li>
                            <li>
                                <a href="jumbos.php"><i class="icon icon-people_outline s-24 text-success "></i>Jumbos</a>
                            </li>
                            <li>
                                <a href="talento25.php"><i class="icon icon-people_outline s-24 text-info"></i>Talento 25g</a>
                            </li>
                            <li>
                                <a href="serenata.php"><i class="icon icon-people_outline s-24 text-warning "></i>Serenata</a>
                            </li>

                        </ul>
                    </li>

                    <li><a href="admin/pdf/mixideal2.php?rca=<?= $rca ?>"><i class="icon icon-document-file-pdf2 red-text  s-24"></i>Mix Ideal</a>
                    </li>

                    <li><a href="cadastro.php"><i class="icon icon-users text-warning s-24"></i>Cadastro de Cliente </a>
                    </li>

                    <li><a href="clienteatevc.php"><i class="icon icon-tablet text-blue s-24"></i>Nestle até Vc </a>
                    </li>




<!---->
<!--                    <li class="treeview"><a href="#">-->
<!--                            <i class="icon icon icon-list text-warning s-24"></i> <span>Mix Ideal</span> <i-->
<!--                                    class="icon icon-angle-left s-18 pull-right"></i>-->
<!--                        </a>-->
<!--                        <ul class="treeview-menu">-->
                            <!--                            <li><a href="disnorte.php"><i class="icon icon-notebook-list s-24 text-blue"></i>Disnorte</a>-->
                            <!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="mchoco.php"><i class="icon icon-notebook-list s-24 brown-text "></i>Chocolates</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="mbisc.php"><i class="icon icon-notebook-list s-24 text-yellow "></i>Biscoitos</a>-->
<!--                            </li>-->
<!---->
<!--                        </ul>-->
<!--                    </li>-->



                    </li>
                </ul>
            </section>
    </aside>
    <!--Sidebar End-->
    <div class="has-sidebar-left">
        <div class="pos-f-t">
            <div class="collapse" id="navbarToggleExternalContent">
                <div class="bg-dark pt-2 pb-2 pl-4 pr-2">
                    <div class="search-bar">
                        <input class="transparent s-24 text-white b-0 font-weight-lighter w-128 height-50" type="text"
                               placeholder="start typing...">
                    </div>
                    <a href="#" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-expanded="false"
                       aria-label="Toggle navigation" class="paper-nav-toggle paper-nav-white active "><i></i></a>
                </div>
            </div>
        </div>
        <div class="sticky">
            <div class="navbar navbar-expand navbar-dark d-flex justify-content-between bd-navbar blue accent-3" style="position: fixed; width: 100%">
                <div class="relative">
                    <a href="#" data-toggle="offcanvas" class="paper-nav-toggle pp-nav-toggle">
                        <i></i>
                    </a>
                </div>
                <!--Top Menu Start -->
                <div class="navbar-custom-menu p-t-10">
                    <h5 style="position: absolute;right: 90px; top: 23px;color: white;"><?=$usuario?></h5>
                    <ul class="nav navbar-nav">

                        <!-- User Account-->
                        <li class="dropdown custom-dropdown user user-menu">
                            <a href="#" class="nav-link" data-toggle="dropdown">
                                <img src="assets/img/dummy/u1.png" class="user-image" alt="User Image">
                                <i class="icon-more_vert "></i>
                            </a>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

