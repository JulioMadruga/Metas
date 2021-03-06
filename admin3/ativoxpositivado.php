<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
require_once '../usuario.php';
require_once '../sessao.php';
require_once '../autenticador.php';
require_once '../Database/Conexao.php';

$aut = Autenticador::instanciar();

$usuario = null;
if ($aut->esta_logado()) {
    $usuario = $aut->pegar_usuario();
}
else {
    $aut->expulsar();
     
}
date_default_timezone_set('America/Cuiaba'); 
 
 $id = $usuario->getNome();
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


if(isset($_GET['regiao'])){

     $regiao = $_GET['regiao'];

     $consulta_base= $conn->prepare("SELECT b.nome, a.rca, COUNT(a.Cod_Cliente) as clientes FROM clientes a, usuarios b 
                                       where a.Rca = b.Rca and a.status = 'S' and b.Regiao ='$regiao' GROUP by Rca");
     $consulta_base->execute(array('id' => $id));
     $result_base= $consulta_base->fetchAll();


    $consulta_base_total= $conn->prepare("SELECT COUNT(a.Cod_Cliente) as clientes FROM clientes a, usuarios b 
                                       where a.Rca = b.Rca and a.status = 'S' and b.Regiao ='$regiao'");
    $consulta_base_total->execute(array('id' => $id));
    $result_base_total= $consulta_base_total->fetchAll();





     $consulta_posit= $conn->prepare("SELECT nome, vendedor, COUNT(id) as clientes from(SELECT b.nome, a.VENDEDOR, a.id
               FROM $mes a, usuarios b WHERE a.VENDEDOR = b.Rca and b.Regiao = '$regiao' group by ID)sub GROUP BY vendedor");
    // var_dump($consulta_posit);
     $consulta_posit->execute(array('id' => $id));
     $result_posit= $consulta_posit->fetchAll();

    $consulta_posit_total= $conn->prepare("SELECT COUNT(id) as clientes from(SELECT b.nome, a.VENDEDOR, a.id
               FROM $mes a, usuarios b WHERE a.VENDEDOR = b.Rca and b.Regiao = '$regiao' group by ID)sub");
    // var_dump($consulta_posit);
    $consulta_posit_total->execute(array('id' => $id));
    $result_posit_total= $consulta_posit_total->fetchAll();








 }
if(!isset($_GET['regiao'] )|| $regiao == 'Todos'){

 $consulta_base= $conn->prepare("SELECT b.nome, a.rca, COUNT(a.Cod_Cliente) as clientes
                                     FROM clientes a, usuarios b where a.Rca = b.Rca and a.status = 'S' GROUP by Rca");
 $consulta_base->execute(array('id' => $id));
 $result_base= $consulta_base->fetchAll();


    $consulta_base_total= $conn->prepare("SELECT COUNT(a.Cod_Cliente) as clientes
                                     FROM clientes a, usuarios b where a.Rca = b.Rca and a.status = 'S' ");
    $consulta_base_total->execute(array('id' => $id));
    $result_base_total= $consulta_base_total->fetchAll();



    $consulta_posit= $conn->prepare("SELECT nome, vendedor, COUNT(id) as clientes from(SELECT b.nome, a.VENDEDOR, a.id
               FROM $mes a, usuarios b WHERE a.VENDEDOR = b.Rca group by ID)sub GROUP BY vendedor");
   // var_dump($consulta_posit);
    $consulta_posit->execute(array('id' => $id));
    $result_posit= $consulta_posit->fetchAll();



    $consulta_posit_total= $conn->prepare("SELECT COUNT(id) as clientes from(SELECT b.nome, a.VENDEDOR, a.id
               FROM $mes a, usuarios b WHERE a.VENDEDOR = b.Rca group by ID)sub");
    // var_dump($consulta_posit);
    $consulta_posit_total->execute(array('id' => $id));
    $result_posit_total= $consulta_posit_total->fetchAll();



}


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
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/npm.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>

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

$("tr:even").css("background","#CFEBF5");
$("tr:first").css("background","#074456");
$("tr:last").css("background","#074456");

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
                     <li role="presentation"><a href="index.php">Parcial</a></li>
                     <li role="presentation"><a href="resumo.php">Resumo de vendas</a></li>
                     <li role="presentation"><a href="vendasflex.php">Venda Transmitida</a></li>
                     <li role="presentation"  ><a href="metas.php">Metas</a></li>
                     <li class="button-dropdown"><a href="javascript:void(0)" class="dropdown-toggle">  Positivações  <span>▼</span>  </a>
                         <ul class="dropdown-menu">
                             <li role="presentation"><a href="trimarca.php">Bi-Marca</a></li>
                             <li role="presentation"><a href="baton.php">Baton</a></li>
                             <li role="presentation"><a href="jumbos.php">Jumbos</a></li>
                             <li role="presentation" id="active" ><a href="#">Clientes Ativos X Clientes Positivados</a></li>


                         </ul>

                     </li>
                     <li role="presentation"><a href="acessos.php">Relat. de Acessos</a></li>
                     <li class="button-dropdown"  ><a href="javascript:void(0)" class="dropdown-toggle"> Cadastros <span>▼</span>  </a>
                         <ul class="dropdown-menu">
                             <li role="presentation" ><a href="cadastrar.php">Cadastrar Metas</a></li>
                             <li role="presentation" ><a href="campanha.php">Cad. Campanhas</a></li>
                             <li role="presentation" ><a href="cadvend.php">Cad. Vendedores</a></li>
                             <li role="presentation" ><a href="solicitacao.php">Solic. Cadastros</a></li>

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
                     <li role="presentation" style="float: right;padding-top: 10px;padding-right: 5px;"><input  class="btn btn-danger btn-xs" type="submit" value="Sair" onclick="location.  href='../controle.php?tipo=sair'"></li>
                     <li role="presentation" style="float: right;"><h5 style="color: #A6CFF3; font-family: sans-serif;padding-top: 4px;">Usuário: <strong><?php print $usuario->getNome(); ?></strong> &nbsp&nbsp&nbsp&nbsp</h5></li>

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
                     <?php echo' <select id="mes" name="mes"style="height: 30px; background-color: #0C4F63;color: #ffffff; font-family: sans-serif;  font-size: 18px;text-align: center; font-weight: bold;" > 
      
';

                     $i=1;

                     while ($i <= 12) {

                         $consulta_mes = $conn->prepare("SELECT data_doc from " . $mes_sel [$i] . " limit 1");

                         $consulta_mes->execute();
                         $result_mes = $consulta_mes->fetchAll();


                         echo '<option value="meta' . $i . '"';

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

<label style="font-size: 18px">Selecionar Região:&nbsp&nbsp&nbsp</label><select id="regiao"  name="regiao " style="height: 30px; background-color: #0C4F63;color: #ffffff; font-family: sans-serif; width: 280px; font-size: 18px;text-align: center; font-weight: bold;">

<option id="todos" selected>Todos</option>
<option id="norte">Norte</option>
<option id="sul">Sul</option>

</select> 

</div>

<div class="col-md-2"></div> 
</div>
    
    
<div id="painel" class="row" style="background: #737373;">
<div class="col-md-2"></div> 

<div class="col-md-8" style="text-align:center; padding-top: 20px; background-color:#CED4D6; font-family:Oswald; color:#074456;">
<table align="center" cellpadding="5">

<tr style="font-size: 16px;background: #074456;color: aliceblue;"> 
<td style="width: 180px; text-align: center;  border: solid; border-color: #245269;">Vendedor</td>
<td style="width: 130px; text-align: center; border: solid; border-color: #245269;">Clientes ativos</td>
<td style="width: 140px; text-align: center; border: solid; border-color: #245269;">Clientes Positivados</td>
<td style="width: 140px; text-align: center; border: solid; border-color: #245269;">Não Positivados</td>


</tr>



';
       
       
    
if (count($result_base) ) {

    $i =0;
      
    foreach($result_base as $row) {

        extract($row);


        $verific = true;

        echo '<tr class="success" style="background: #91D5E8;font-size: 16px;">';
        echo '<td style="width: 180px; text-align: left; padding-left: 10px; border: solid; border-color: #245269;">' . $row[0] . '</td>';
        echo '<td style="width: 130px; text-align: center; border: solid; border-color: #245269;">' . $row[2] . '</td>';


        foreach ($result_posit as $row2) {
            If ($row[1] == $row2[1]) {

                echo '<td style="width: 130px; text-align: center; border: solid; border-color: #245269;">' . $row2[2] . '</td>';
                echo '<td style="width: 130px; text-align: center; border: solid; border-color: #245269;">'; echo $cal = ($row[2]-$row2[2]); echo '</td>';

                $verific = false;

            }
        }

        If ($verific == true) {

            echo '<td style="width: 130px; text-align: center; border: solid; border-color: #245269;">0</td>';
            echo '<td style="width: 130px; text-align: center; border: solid; border-color: #245269;">' . $row[2] . '</td>';


        }


        echo "</tr>";

        $i++;


   
    }  
  } else {
    echo "Nennhum resultado retornado.";
    echo $id;
   
  }

   

  echo '
</table>';
                     echo '</br>';
                     echo '<table align="center" cellpadding="5">';



                     echo '<tr class="success" style="background: #074456; font-size:16px;color: aliceblue;height: 40px;">';
                     echo'<td style="width: 180px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">Total</td>';
                     echo '<td id="kgmeta" style="width: 130px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.$result_base_total[0][0].'</td>';
                     echo '<td id="Rkg" style="width: 140px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'. $result_posit_total[0][0].'</td>';
                     echo '<td id="metav" style="width: 140px; text-align: center; border: solid; border-color: #074456;border-right-color: #CED4D6;">'.($result_base_total[0][0] - $result_posit_total[0][0]).'</td>';






                     echo '
</table>


</div>
<div class="col-md-2"></div> 
<div class="col-md-2"></div> 
</div>

';

       echo '<script>
 
 
  function getUrlVars() {
             var vars = {};
             var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                 vars[key] = value;
             });
             return vars;
         }
 
 
           teste = getUrlVars()["regiao"];
           
           if(teste == "Sul"){
                     document.getElementById("sul").selected = "true";
                      
                 }
                 if(teste == "Norte"){
                     document.getElementById("norte").selected = "true";
                     
                 }
             if(teste == "Todos"){
                 document.getElementById("todos").selected = "true";}
            
           


</script>';
               
       
       
       
       ?>
        
            
        
    </body>
</html>
