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
?>
<html style="background: #737373;">
    <head>
        <meta charset="UTF-8">
        <title>Importação</title>
        
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
       <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
       <link rel="stylesheet" href="../css/bootstrap-theme.css.map">
       <link rel="stylesheet" href="../css/bootstrap.css.map">
       <link rel="stylesheet" href="../css/menu.css">
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
     $(document).ready(function(){

     $( "#import" ).click(function() {

         $("#form" ).css("display","none");
         $("#title" ).css("display","none");

         $("#painel" ).css("display","block");

     });
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
                        <li role="presentation" ><a href="campanha.php">Cad. Campanhas</a></li>
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
                        <li role="presentation"  id="active"  ><a href="#">Resultados</a></li>
                        <li><a href="posit_baton.php">Posit. Baton</a></li>
                        <li><a href="posit_geral.php">Posit. Geral</a></li>
                        <li role="presentation" ><a href="clientes.php">Clientes</a></li>
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
            <div class="col-md-6" id="title" style="height: 70px; text-align:center; background-color:#045f86; font-family:Oswald; color:#F2FAFD;"> <h2>IMPORTAÇÃO DOS RESULTADOS POSITIVAÇÃO GERAL</h2></div>
               <div class="col-md-3"></div>  
        </div>
        <div class="row"  style="background-color: #737373;">

               <div class="col-md-3"></div>

            <div class="col-md-6 " id="form" style="background-color:#ADADAD; font-family:Oswald; color:#1b6d85;">


   
  
<?php

//Transferir o arquivo
if (isset($_POST['submit'])) {



    $handle = fopen($_FILES['filename']['tmp_name'], "r");

    move_uploaded_file($_FILES["filename"]["tmp_name"], "uploads/" . $_FILES['filename']['name']);

    foreach(($dados2 = fgetcsv($handle, 1000, ";")) as $row):

      $verific = count($dados2);

    endforeach;

    If ($verific == 4){


   $deleterecords = "TRUNCATE TABLE posit_baton"; //Esvaziar a tabela
   $limpa = $conn->prepare($deleterecords);
   $limpa->execute();


    /*if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
        echo "<h1>" . "File ". $_FILES['filename']['name'] ." transferido com sucesso ." . "</h1>";
        echo "<h2>Exibindo o conteúdo:</h2>";
        readfile($_FILES['filename']['tmp_name']);
    }*/
        $name = getcwd().DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR.$_FILES['filename']['name'];

        $name = str_replace("\\","/",$name);

       $nome = $name;
       $tabMes = 'posit_geral';
       $delimiter = ";";
       $linhaDelimiter = "\\n";



       $import= $conn->prepare("LOAD DATA LOCAL INFILE '$nome'
                     INTO TABLE $tabMes FIELDS TERMINATED BY '$delimiter'
                     LINES TERMINATED BY '$linhaDelimiter' IGNORE 1 LINES
          (cod_cli,razao,data_doc,ordem) ");
        // var_dump($import);
       $import->execute();
       $import->closeCursor();



        $delete = "DROP TABLE IF EXISTS p_geral; "; //Esvaziar a tabela
        $limpa2 = $conn->prepare($delete);
        $limpa2->execute();
        $limpa2->closeCursor();




        $import23= $conn->prepare("CREATE TABLE p_geral SELECT a.cod_cli,a.razao,b.rca,b.vendedor,a.ordem,a.data_doc, c.super FROM `posit_geral`a, clientes b, usuarios c where a.cod_cli = b.cod_cli and b.rca = c.Rca");
        // var_dump($import23);
        $import23->execute();
        $import23->closeCursor();









        /*

           //Importar o arquivo transferido para o banco de dados
            while (($dados = fgetcsv($handle, 1000, ";"))!== FALSE ) {

                $dados = array_map("utf8_encode",$dados);
                $dados = str_replace("'","",$dados);

                $valor = str_replace(" ",".",trim($dados[17]));





                $import= $conn->prepare("INSERT INTO ".$mes." (ID, Nome_parceiro, CNPJ, VENDEDOR, Material,Texto_breve_do_produto,Quantidade,UM,Endereco,Cidade,Rg,CEP,Data_doc,N_NF,Liquido,Bruto,Un,Valor_total) Values ('$dados[0]','".trim($dados[1])."','$dados[2]','".trim($dados[3])."','$dados[4]','$dados[5]','".str_replace("." , "" , $dados[6])."','$dados[7]','$dados[8]','$dados[9]','$dados[10]','$dados[11]','$dados[12]','$dados[13]','$dados[14]','$dados[15]','$dados[16]','$valor')");
               // var_dump($import);
                $import->execute();




                 //mysql_query($import) or die(mysql_error());

            }*/

    //fclose($handle);


    echo "<div style='text-align:center;'>";
    print "<h2>Importação Realizada com</h2>";
    print "<h1>Sucesso !!!!</h1> </br>";
    echo '<input type="button" style = "width: 200px"class= "btn-success btn-lg" value="Sair" onclick="javascript:location.href='."'index.php'".'">  ';
    echo "</br>";
    echo "</br>";
    echo "</div>";

//Visualizar formulário de transferência
} elseif ($verific != 18) {
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
    
       
    print "<input id='import' type='submit' name='submit' value='Importar Arquivo'></form>";
    
      echo '</br>';
   echo '</br>';

}
?>
 
</div>
    <div class="col-md-6 " id="painel"  style="background-color:#737373; font-family:Oswald; color:deepskyblue; text-align: center; display: none">

      <!--  <img  src="../images/carrega.gif" />
        <h3>Importando...</h3> -->

        <svg style=" width: 400px; height: 400px; margin: 20px; display:inline-block;"
             version="1.1" id="L7" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">

             <path fill="#ADADAD" d="M31.6,3.5C5.9,13.6-6.6,42.7,3.5,68.4c10.1,25.7,39.2,38.3,64.9,28.1l-3.1-7.9c-21.3,8.4-45.4-2-53.8-23.3
              c-8.4-21.3,2-45.4,23.3-53.8L31.6,3.5z">
                 <animateTransform
                         attributeName="transform"
                         attributeType="XML"
                         type="rotate"
                         dur="2s"
                         from="0 50 50"
                         to="360 50 50"
                         repeatCount="indefinite" />
             </path>
            <path fill="#ADADAD" d="M42.3,39.6c5.7-4.3,13.9-3.1,18.1,2.7c4.3,5.7,3.1,13.9-2.7,18.1l4.1,5.5c8.8-6.5,10.6-19,4.1-27.7
  c-6.5-8.8-19-10.6-27.7-4.1L42.3,39.6z">
                <animateTransform
                        attributeName="transform"
                        attributeType="XML"
                        type="rotate"
                        dur="1s"
                        from="0 50 50"
                        to="-360 50 50"
                        repeatCount="indefinite" />
            </path>
            <path fill="#ADADAD" d="M82,35.7C74.1,18,53.4,10.1,35.7,18S10.1,46.6,18,64.3l7.6-3.4c-6-13.5,0-29.3,13.5-35.3s29.3,0,35.3,13.5
  L82,35.7z">
                <animateTransform
                        attributeName="transform"
                        attributeType="XML"
                        type="rotate"
                        dur="2s"
                        from="0 50 50"
                        to="360 50 50"
                        repeatCount="indefinite" />
            </path>
</svg>


        <div class="loader" style="margin-top: 250px">Importando...</div>


    </div>



 <div class="col-md-3"></div>
        
       </div>

</body>
</html>
