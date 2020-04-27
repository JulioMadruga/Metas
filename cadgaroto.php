<?php
require_once 'database/conectar2.php';

$itensgeral = ['cod_cli','cliente','cod_vend','vend','canal','baton','batonsm','serenata', 'talento25','pastilha',
               'candybar','jumbos','talento100','coberturas','caixas','chocoPo','rech', 'cookies',
               'N_kitkat','N_prestigio','N_charge','N_jumbos','N_caixas','N_chocopo','N_coberturas', 'N_rech','N_cookies',
               'L_sonho','L_bis','L_tab25','L_jumbos','L_tab80','L_caixas','M_snickers','M_twix','M_milkway','M_mm',
               'F_kinder','F_bueno','F_stick','F_bola','A_tortuguita','A_snack','A_jumbos','H_Tablete25','H_Tablete80','H_jumbos',
               'outros', 'merchan','checkout','obs'

];

$sql = "";

$id_user = $_GET["id"];

foreach ($itensgeral as $itens){


             if(!isset($_POST[$itens])) {

                 $$itens = 'N';

              }elseif ($_POST[$itens]=='on'){

                 $$itens = 'S';
             }else{

                 $$itens = $_POST[$itens];
             }



}


$result = $conn2->query("INSERT INTO ck_garoto (cod_cli,id_user,cliente,cod_vend,vendedor,canal,baton,batonsm,serenata,talento25,pastilha,
               candybar,jumbos,talento100,coberturas,caixas,chocoPo,rech,cookies,N_kitkat,N_prestigio,
               N_charge,N_jumbos,N_caixas,N_chocopo,N_coberturas,N_rech,N_cookies,L_sonho,L_bis,L_tab25,
               L_jumbos,L_tab80,L_caixas,M_snickers,M_twix,M_milkway,M_mm,F_kinder,F_bueno,F_stick,F_bola,
               A_tortuguita,A_snack,A_jumbos,H_Tablete25,H_Tablete80,H_jumbos,outros,merchan,checkout,obs,dt_cad)
               VALUES ('$cod_cli','$id_user','$cliente','$cod_vend','$vend','$canal','$baton','$batonsm','$serenata', '$talento25','$pastilha',
               '$candybar','$jumbos','$talento100','$coberturas','$caixas','$chocoPo','$rech', '$cookies',
               '$N_kitkat','$N_prestigio','$N_charge','$N_jumbos','$N_caixas','$N_chocopo','$N_coberturas', '$N_rech','$N_cookies',
               '$L_sonho','$L_bis','$L_tab25','$L_jumbos','$L_tab80','$L_caixas','$M_snickers','$M_twix','$M_milkway','$M_mm',
               '$F_kinder','$F_bueno','$F_stick','$F_bola','$A_tortuguita','$A_snack','$A_jumbos','$H_Tablete25','$H_Tablete80','$H_jumbos',
               '$outros', '$merchan','$checkout','$obs',NOW())");




header('Location: painel.php?result=ok');
die();