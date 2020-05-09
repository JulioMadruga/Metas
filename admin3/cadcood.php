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
 
 $id = $usuario ;
 $date = date('Ymd' );



 $consulta_acessos= $conn->prepare("SELECT * FROM cad_super order by nome");
 $consulta_acessos->execute(array('id' => $id));
 $result_acessos= $consulta_acessos->fetchAll();


 $consulta_ved = $conn->prepare("SELECT nome FROM supervisor GROUP by nome ORDER BY nome");
 $consulta_ved-> execute();
 $result2= $consulta_ved->fetchAll();


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


        $(document).ready( function(){

$("#painel").hide(); 
$("#painel").slideDown(1500);  

$("tr:even").css("background","#CFEBF5");
$("tr:first").css("background","#074456");

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
    <body style="background-image:radial-gradient(circle,#ff1200,#560101)">
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
                        <li role="presentation" ><a href="campanha.php">Cad. Campanhas</a></li>
                        <li role="presentation" id="active"  ><a href="#">Cad. Coordenadores</a></li>
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
                      <div class="row" style="padding-top: 50px;background: #737373;">

                          <div class="col-md-2"></div>
                          <div class="col-md-2" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;height: 50px; padding-top: 5px;"><img src="../images/disnorte.png"></div>
                          <div class="col-md-4" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;height: 50px; padding-top: 5px;"><h4>SISTEMA DE ACOMPANHAMENTO DE METAS</h4></div>
                          <div class="col-md-2" style="text-align:center; background-color:#074456; font-family:Oswald; color:#E4F3F7;"><img src="../images/garoto.png"></div>
                          <div class="col-md-2"></div>

                      </div>
        
       <?php
echo '  
    
    
<div id="painel" class="row" style="background: #737373;">
<div class="col-md-2"></div> 

<div class="col-md-8" style="text-align:center; padding-top: 20px; background-color:#CED4D6; font-family:Oswald; color:#074456;">
<table align="center" cellpadding="5">

<tr style="font-size: 16px;background: #074456;color: aliceblue;"> 
<td style="width: 50px; text-align: center;border: solid; border-color: #737373;">Exluir</td>
<td style="width: 180px; text-align: center; border: solid; border-color: #245269;">Nome</td>
<td style="width: 250px; text-align: center; border: solid; border-color: #245269;">Email</td>
<td style="width: 100px; text-align: center; border: solid; border-color: #245269;">Edição</td>



</tr>



';
       
       
    
if (count($result_acessos) ) {
      
    foreach($result_acessos as $row) {
        
        extract($row);
       
                 do {
                           echo '<tr class="success" style="background: #91D5E8; height:30px; font-size: 16px; height: 45px;">';
                           echo "<td style='width: 50px; text-align: center; font-weight: bold; border: solid; border-color: #737373'><input type='checkbox' name='excluir[]' value='".$row[0]."'></td>";
                           echo '<td style="width: 180px; padding-left:5px; text-align: left; border: solid; border-color: #245269;">'.$row[1].'</td>';
                           echo '<td style="width: 250px; padding-left:5px; text-align: left; border: solid; border-color: #245269;">'.$row[2].'</td>';

                             echo "<td id ='editar' style='width: 100px; text-align: center; border: solid; border-color: #245269; font-size: 15px'>
                              <button type='button' class ='btn btn-primary btn-xs' data-toggle='modal' data-target='#exampleModal' 
                              data-vendedor='$row[1]' data-email='$row[2]'  data-vend = '$row[0]'
                              style='width: 95px;font-size: 15px; height: 35px;'>Editar</button></td>";

       } while ($row= null);
      echo "</tr>"; 
    
      
   
   
    }  
  } else {
    echo "Nennhum resultado retornado.";
    echo $id;
   
  }

  ?>


</table>
</br>

</div>
<div class="col-md-2"></div> 
<div class="col-md-2"></div> 
</div>



 <div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Cadastrar Vendedor</h4>
                </div>
                <div class="modal-body">
                    <form id="form" action="" method="post" name="form">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Cod. Coodenador:</label>
                            <input type="text" class="form-control" id="vend" name="vend" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Nome Coordenador:</label>
                            <input type="text" class="form-control" id="vendedor" name="vendedor" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" value='Alterar' >Alterar</button>
                </div>
                </form>
            </div>
        </div>
    </div>


                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                      <script src="../js/bootstrap.min.js"></script>


                      <script>

                          $('#exampleModal').on('show.bs.modal', function (event) {
                              var button = $(event.relatedTarget) // Button that triggered the modal
                              var recipient = button.data('vendedor') // Extract info from data-* attributes
                              // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                              // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                              var vendedor = button.data('vendedor')

                              var email =  button.data('email')

                              var vend = button.data('vend')


                              var modal = $(this)
                              modal.find('.modal-title').text('Alterar Cadastro do Coordenador(a): ' + recipient +'  -  ' + 'Cod. Coordenador: ' + vend )
                              modal.find('.modal-body #vendedor').val(vendedor)
                              modal.find('.modal-body #email').val(email)
                              modal.find('.modal-body #vend').val(vend)

                              modal.find('.modal-body #form').attr('action', 'upcoord.php?cod_ved=' + vend + '&vend='+ vendedor);


                          })


                      </script>

                      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
       
       
       

        
            
        
    </body>
</html>
