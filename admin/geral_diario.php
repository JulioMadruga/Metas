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




    $consulta_baton = $conn->prepare("SELECT super, rca, vendedor, COUNT(cod_cli) as posit FROM `p_geral` GROUP by vendedor Order by super, vendedor");
    $consulta_baton->execute();
    $result_baton = $consulta_baton->fetchAll();





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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     
     <script>   // aqui eh a base da pagina


$(document).ready( function(){
    
$("#painel").hide(); 
$("#painel").slideDown(1500);  

$("tr:even").css("background","#6292bb");
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

        </ul>
    </div>

    <div class="row" style="padding-top: 50px;background: #737373;">
       
        <div class="col-md-2"></div> 
        <div class="col-md-2" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;height: 50px; padding-top: 5px;"><img src="../images/disnorte.png"></div> 
        <div class="col-md-4" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;height: 50px; padding-top: 5px;"><h4>SISTEMA DE ACOMPANHAMENTO DE METAS</h4></div>
        <div class="col-md-2" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;"><img src="../images/garoto.png"></div> 
        <div class="col-md-2"></div>
        
       </div>     
        



<div class="row" style="background: #737373; height:15px;">
<div class="col-md-2"></div>
<div class="col-md-8" style="background: #CED4D6; height: 15px;"></div>
<div class="col-md-2"></div>

</div>
    
<div id="baton" class="row" style="background: #737373;">
<div class="col-md-2" ></div>
<div class="col-md-1" style="background: #CED4D6; height: 90px;"></div>
<div class="col-md-6" style=" background: #CED4D6; height: 90px;">    
<table align="center" cellpadding="5"> 
           <tr style="background-color: #0f3f6f; color: #FFFFFF; font-weight: bold; font-family:Dosis; " >
               <td colspan="4" style="width: 680px; height: 90px; text-align: center; font-size: 25px;background: #FF2012;"><img src="../images/trimarca.png"></td>
           </tr>
</table>
           </div>
<div class="col-md-1" style="background: #CED4D6; height: 90px;"></div>
<div class="col-md-2"></div>

</div>

<div id="painel" class="row" style="background: #737373;">
<div class="col-md-2"></div> 

<div class="col-md-8" style="text-align:center; padding-top: 15px; background-color:#CED4D6; font-family:Oswald; color:#270301;">


<?php

 echo '


</div>

<div class="col-md-2"></div> 
</div>


    
<div id="painel" class="row" style="background: #737373;">
<div class="col-md-2"></div> 

<div class="col-md-8" style="text-align:center; padding-top: 15px; background-color:#CED4D6; font-family:Oswald; color:#270301;">
<table id="tabela" align="center" cellpadding="5">

<tr style="font-size: 16px;background: #083f6f;color: aliceblue; font-size:20px;"> 
<!-- <td style="width: 150px; text-align: center; border: solid; border-color: #0f3f6f;border-right-color: aliceblue;">Supervisor</td> -->
<td style="width: 100px; text-align: center; border: solid; border-color: #0f3f6f;border-right-color: aliceblue;">Rca</td>
<td style="width: 300px; text-align: center; border: solid; border-color: #0f3f6f;border-right-color: aliceblue;">Vendedor</td>
<td style="width: 100px; text-align: center; border: solid; border-color: #0f3f6f;">Posit.</td>




</tr>



';
       
       
    
if (count($result_baton) ) {

    foreach($result_baton as $row) {
        

       

                           echo '<tr class="success" style="background: #9cbac5; font-size:20px;">';
                         //  echo'<td class="link" style="width: 150px; text-align: center; border: solid; border-color: #245269;">'.$row[0].'</td>';
                           echo '<td style="width: 100px; text-align: center; border: solid; border-color: #4B5F65;">'.$row[1].'</td>';


                           echo '<td style="width: 300px; text-align: left; padding-left: 15px; border: solid; border-color: #4B5F65;">'.$row[2].'</td>';
                           echo '<td style="width: 100px; text-align: center; border: solid; border-color: #4B5F65;">'.$row[3].'</td>';

                                                                                         

                           

      echo "</tr>"; 
    
      

   
    }  
  } else {
    echo "Nennhum resultado retornado.";
    echo $id;
   
  }



  echo '
</table>
</br>

</div>
<div class="col-md-2"></div> 
<div class="col-md-2"></div> 
</div>




        
        
    </body>
</html>
';