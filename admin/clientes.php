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
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Importação</title>
        
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
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
                        <li role="presentation"><a href="campanha.php">Cad. Campanhas</a></li>
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
                        <li role="presentation"  ><a href="Importacao.php">Resultados</a></li>
                        <li role="presentation"  id="active"  ><a href="#">Clientes</a></li>
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
        <div class="row" style="background-color: #737373;padding-top: 150px;">
        <div class="col-md-3"></div>  
            <div class="col-md-6" style="height: 70px; text-align:center; background-color:#1B6D85; font-family:Oswald; color:#F2FAFD;"> <h2>IMPORTAÇÃO DOS CLIENTES</h2></div>
               <div class="col-md-3"></div>  
        </div>
        <div class="row" style="background-color: #737373;">
        
               <div class="col-md-3"></div>  
            
            <div class="col-md-6"  id="form" style="background-color:#ADADAD; font-family:Oswald; color:#1b6d85;">
                
   
  
<?php

//Transferir o arquivo
if (isset($_POST['submit'])) {    
    $handle = fopen($_FILES['filename']['tmp_name'], "r");
    
    foreach(($dados2 = fgetcsv($handle, 1000, ";")) as $row):
        
      $verific = count($dados2);

    endforeach;
    
    If ($verific == 6){
        

   $deleterecords = "TRUNCATE TABLE clientes" ;//Esvaziar a tabela
   $limpa = $conn->prepare($deleterecords);
   $limpa->execute();
  
  
    /*if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
        echo "<h1>" . "File ". $_FILES['filename']['name'] ." transferido com sucesso ." . "</h1>";
        echo "<h2>Exibindo o conteúdo:</h2>";
        readfile($_FILES['filename']['tmp_name']);
    }*/


         
   //Importar o arquivo transferido para o banco de dados
    while (($dados = fgetcsv($handle, 1000, ";"))!== FALSE ) {
        $dados = array_map("utf8_encode", $dados);


        $consulta_vend = $conn->prepare("SELECT nome FROM usuarios where rca = '$dados[2]'");
        //  var_dump($consulta_vend);
        $consulta_vend-> execute();
        $result_vend= $consulta_vend->fetchAll();

        $vend = $result_vend[0][0];

    
        $import= $conn->prepare("INSERT INTO clientes (Vendedor,Rca, Cod_Cli, razao,hierarquia, cnpj) Values ('$vend','$dados[2]','$dados[0]','$dados[1]','$dados[4]','$dados[5]')");
        var_dump($import);
        $import->execute();
     
                
            
         //mysql_query($import) or die(mysql_error());
      //var_dump($import);
    }
    
    //fclose($handle);
    echo "<div style='text-align:center;'>";
    print "<h2>Importação Realizada com</h2>";
    print "<h1>Sucesso !!!!</h1> </br>";
    echo '<input type="button" value="Voltar" onClick="history.go(-1)"> ';
    echo "</br>";
    echo "</br>";
    echo "</div>";
  
//Visualizar formulário de transferência
} elseif ($verific != 5) {
echo    "<div style='text-align: center'>";
echo "<h1>Verifique arquivo dados Incorretos</h1>";
echo '<input type="button" value="Voltar" onClick="history.go(-1)"> ';
 echo "</br>";
    echo "</br>";
    echo "</div>";
}
}else{
    
    
  //  print "Transferir novos arquivos CSV selecionando o arquivo e clicando no botão Upload<br />\n";
  
    print "<form style='margin-left: 10%; font-size: 20px' enctype='multipart/form-data' action='#' method='post'>";
  
    echo '</br>';
    

    print "<h3>Nome do arquivo para importar:</h3>";
    
        echo '</br>';
  
    print "<input  style='margin-left= 100px; ' size='50' type='file' name='filename'><br />\n";
    
       
    print "<input type='submit' name='submit' value='Importar Arquivo'></form>";
    
      echo '</br>';
   echo '</br>';

}
?>
 
</div> 
 <div class="col-md-3"></div>
        
       </div>
</body>
</html>
