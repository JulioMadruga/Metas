<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once '../Database/Conexao.php';
session_start();

if(!isset($_SESSION['user_session']))
{
    header("Location: index.html");
}

//include_once '../Database/conectar.php';

$id = $_SESSION['user_session'];

$dados_user = $conn->prepare("SELECT * FROM usuarios where id = $id");
$dados_user->execute();
$result = $dados_user->fetchAll();

$id_user = $result[0]['id'];
$usuario = $result[0]['nome'];

date_default_timezone_set('America/Cuiaba'); 
$id = $usuario;
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
 
          $check0 = $check1 = $check2 = $check3 = $check4 = $check5 = $check6 = $check7 = $check8 = $check9 = $check10 = $check11 ="";       
          switch ($meta) {
  case "meta1": {
    $check0 = "selected";
    break;
  }
  case "meta2": {
    $check1 = "selected";
    break;
  }
  case "meta3": {
    $check2 = "selected";
    break;
  }
  case "meta4": {
    $check3 = "selected";
    break;
  }
  case "meta5": {
    $check4 = "selected";
    break;
  }
  case "meta6": {
    $check5 = "selected";
    break;
  }
  case "meta7": {
    $check6 = "selected";
    break;
  }
  case "meta8": {
    $check7 = "selected";
    break;
  }
  case "meta9": {
    $check8= "selected";
    break;
  }
  case "meta10": {
    $check9 = "selected";
    break;
  }
  case "meta11": {
    $check10 = "selected";
    break;
  }
  case "meta12": {
    $check11 = "selected";
    break;
  }
}



 $consulta_camp= $conn->prepare("select * from trimarca");
 $consulta_camp->execute();
 $result_camp= $consulta_camp->fetchAll();

$consulta_top= $conn->prepare("select * from $meta limit 1");
$consulta_top->execute();
$result_top= $consulta_top->fetchAll();



 
  
 


?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Painel Administrador</title>
        <style type="text/css">
          .link a { color: #000000;}  
          .link a:hover {text-decoration: none; font-weight: bold;
          background: #9ef15c;
          }  
          .link2 a { color: #000000;}  
          .link2 a:hover {text-decoration: none; font-weight: bold;
                  }  
            table, th, td {
   border: none;  border-bottom:solid; border-collapse: collapse; border-color: #245269; padding: 3px;
}  </style>
        
        
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
    <script src="../js/calc_total.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     
     <script>   // aqui eh a base da pagina



$(document).ready( function(){
$("#painel").hide(); 
$("#painel").slideDown(1500);  

$("tr:even").css("background","#97ACB3");


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
            <li role="presentation" ><a href="index.php">Resumo de vendas</a></li>

            <!--          <li class="button-dropdown"><a href="javascript:void(0)" class="dropdown-toggle">  Positivações  <span>▼</span>  </a>-->
            <!--              <ul class="dropdown-menu">-->
            <!--                  <li><a href="trimarca.php">Positivação Geral</a></li>-->
            <!--                  <li><a href="baton.php">Positivação Baton</a></li>-->
            <!--                  <li><a href="jumbos.php">Positivação Biscoitos</a></li>-->
            <!--                  <li><a href="rech.php">Recheados</a></li>-->
            <!--                  <li><a href="cookies.php">Cookies</a></li>-->
            <!---->
            <!--              </ul>-->
            <!---->
            <!--          </li>-->

            <li class="button-dropdown"><a href="javascript:void(0)" class="dropdown-toggle"> Relatórios <span>▼</span>  </a>
                <ul class="dropdown-menu">
                    <li role="presentation"><a href="top.php">Ranking Mix Ideal</a></li>
                    <li role="presentation"><a href="acessos.php">Relat. de Acessos</a></li>
                    <!--                   <li role="presentation"><a href="inadimplencia.php">Financeiro</a></li>-->
                </ul>
            </li>


            <?php
            if($usuario=="Julio" || $usuario=="Marciano"){?>


                <li class="button-dropdown"><a href="javascript:void(0)" class="dropdown-toggle"> Cadastros <span>▼</span>  </a>
                    <ul class="dropdown-menu">
                        <li role="presentation" ><a href="cadastrar.php">Cadastrar Metas</a></li>
                        <li role="presentation"  id="active"  ><a href="#">Cad. Campanhas</a></li>
                        <li role="presentation" ><a href="cadcood.php">Cad. Coordenadores</a></li>
                        <li role="presentation" ><a href="cadvend.php">Cad. Vendedores</a></li>
                        <?php
                        if($usuario=="Julio" || $usuario=="Marciano"){

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
            <li role="presentation" style="float: right;"><h5 style="color: #A6CFF3; font-family: sans-serif;padding-top: 4px;">Usuário: <strong><?php print $usuario; ?></strong> &nbsp&nbsp&nbsp&nbsp</h5></li>

        </ul>
    </div>
     <div class="row" style="padding-top: 50px; background: #737373;">
       
        <div class="col-md-2"></div> 
        <div class="col-md-2" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;height: 60px; padding-top: 5px; "><img src="../images/disnorte.png" style="margin-top: 5px;"></div>
        <div class="col-md-4" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;height: 60px; padding-top: 5px; "><h4 style="margin-top: 18px;">SISTEMA DE ACOMPANHAMENTO DE METAS</h4></div>
        <div class="col-md-2" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;height: 60px;  "><img src="../images/garoto.png" style="margin-top: 5px;"></div>
        <div class="col-md-2"></div>
        
       </div>     
        

    
<div class="row" style="background: #737373; height:30px;">
<div class="col-md-2"></div>

    <div class="col-md-8" style="background: #CED4D6; text-align: center;"><h2 style="background-color: #45595f; height: 30px; size: 18px; color: #FFFFFF; margin-top: 15px">Trimarca</h2>

        <div class="col-md-12" style="background: #CED4D6; text-align: center;">
            <form class="form-horizontal" action="atualizar2.php?mes=<?php echo $meta ?>" method="post" name="form[]">
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label" for="formGroupInputLarge">Baton</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="formGroupInputLarge" name="baton" placeholder="Digite codigos dos produtos" value="<?php echo $result_camp[0][0]; ?>">
                    </div>
                </div>

                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label" for="formGroupInputLarge">Talento</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="formGroupInputLarge" name="talento" placeholder="Digite codigos dos produtos" value="<?php echo $result_camp[0][1]; ?>">
                    </div>
                </div>


            </div>


        <div class="col-md-12" style="background: #CED4D6; text-align: center;"><h2 style="background-color: #d8252f; height: 30px; size: 18px; color: #FFFFFF; margin-top: 15px">Baton</h2>

                <div class="col-md-12" style="background: #CED4D6; text-align: center;">
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label" for="formGroupInputLarge">Baton</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="formGroupInputLarge" name="baton2" placeholder="Digite codigos dos produtos" value="<?php echo $result_camp[0][3]; ?>">
                            </div>
                        </div>


                    </div>
        </div>

            <div class="col-md-12" style="background: #CED4D6; text-align: center;"><h2 style="background-color: #f0ad4e; height: 30px; size: 18px; color: #FFFFFF; margin-top: 15px">Jumbos</h2>

                <div class="col-md-12" style="background: #CED4D6; text-align: center;">
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label" for="formGroupInputLarge">Jumbos</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="formGroupInputLarge" name="jumbos" placeholder="Digite codigos dos produtos" value="<?php echo $result_camp[0][4]; ?>" >
                            </div>
                        </div>



                   </div>





              </div>


        <div class="col-md-12" style="background: #CED4D6; text-align: center;"><h2 style="background-color: #528298; height: 30px; size: 18px; color: #FFFFFF; margin-top: 15px">Biscoitos Recheados</h2>

            <div class="col-md-12" style="background: #CED4D6 ; text-align: center;">
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label" for="formGroupInputLarge">Recheados</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="formGroupInputLarge" name="rech" placeholder="Digite codigos dos produtos" value="<?php echo $result_camp[0][5]; ?>" >
                    </div>
                </div>

                </div>





        </div>


        <div class="col-md-12" style="background: #CED4D6; text-align: center;"><h2 style="background-color: #528298; height: 30px; size: 18px; color: #FFFFFF; margin-top: 15px">Mix Ideal</h2>

            <div class="col-md-12" style="background: #CED4D6 ; text-align: center;">
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label" for="formGroupInputLarge">Mix Ideal</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="formGroupInputLarge" name="mix" placeholder="Digite codigos dos produtos" value="<?php echo $result_camp[0][7]; ?>" >
                    </div>
                </div>


                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label" for="formGroupInputLarge">Mix Ideal2</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" type="text" id="formGroupInputLarge" name="mix2"> <?php echo $result_camp[0][8]; ?></textarea>
                    </div>
                </div>

            </div>





        </div>






        <div class="col-md-12" style="background: #CED4D6; text-align: center;"><h2 style="background-color: #528298; height: 30px; size: 18px; color: #FFFFFF; margin-top: 15px">Percentual Top</h2>

            <div class="col-md-12" style="background: #CED4D6 ; text-align: center;">

                <h4 class="col-sm-2" for="formGroupInputLarge">Top Chocolate</h4>
                <div class="col-sm-4">
                    <input class="form-control" type="text" id="formGroupInputLarge" name="topchoc" placeholder="Digite codigos dos produtos" value="<?php echo ($result_top[0][10]*100); ?>" >
                </div>

            <h4 class="col-sm-2" for="formGroupInputLarge">Top Biscoito</h4>
            <div class="col-sm-4">
                <input class="form-control" type="text" id="formGroupInputLarge" name="topbisc" placeholder="Digite codigos dos produtos" value="<?php echo ($result_top[0][11]*100); ?>" >
            </div>

            </div>





        </div>


            <div class="col-md-12" style="background: #CED4D6 ; text-align: center;">


                <div class="row" style="background: #CED4D6; height:30px; text-align: center">

                    <div class="col-md-12" style="margin-top: 30px"> <input type="submit" name="campanha" class='btn btn-default btn-lg' value="Cadastrar" style="text-align: center">  </div>

                    <div class="col-md-12" style="height: 40px"> </div>

                </div>


                </form></div>





       
       
       

        
        
        
    </body>
</html>
