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


date_default_timezone_set('America/Cuiaba');

//$id = $usuario;
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
    'Feb' => 'fevereiro',
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


$consulta_sup = $conn->prepare("SELECT DISTINCT super FROM usuarios where super = '$usuario' ORDER by regiao, super");

$consulta_sup->execute();
$result_sup = $consulta_sup->fetchAll();


if(empty($result_sup)){
    $vendedores = $conn->prepare("SELECT rca,nome FROM usuarios where super <> '' ORDER by nome");
//var_dump($dados_user);
    $vendedores ->execute();
    $result_Vend = $vendedores ->fetchAll();

}else{


    $vendedores = $conn->prepare("SELECT rca,nome FROM usuarios where super = '$usuario' order by nome");
//var_dump($dados_user);
    $vendedores ->execute();
    $result_Vend = $vendedores ->fetchAll();

}



//$vendedores = $conn->prepare("SELECT rca,nome FROM usuarios where super = '$usuario' order by nome");
////var_dump($dados_user);
//$vendedores ->execute();
//$result_Vend = $vendedores ->fetchAll();


//var_dump($result_Vend);







?>


<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Importação de Aquivos Flexx</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>

        function fechar(){
            document.getElementById('painel').style.display = 'none';
        }

        function abrir(){
            document.getElementById('painel').style.display = 'block';
            setTimeout ("fechar()", 18000);
        }

    </script>

</head>
<body>

<div style="  position: fixed;  z-index: 1000; left: 10px;  top: 15px;">
    <a href="load.php"> <img width="85px" src="../images/voltar.png"></a>
</div>

<div class="col align-self-center" style=" background:#FFC107!important; border-radius:25px; width: 80%; margin: auto; text-align: center; top:15px">

    <h1 style="font-family: 'Roboto', serif; font-weight: bold; color:#ff2c33; padding: 20px">Relatório de Mix Ideal</h1>


</div>


<div style="margin: 20px auto 20px auto; padding: 50px; width: 90%">
<?php
    echo '<table id="tblExport"  class="table table-striped">';

        // echo "<h1 style='background: '>".$value['super']."</h1>";


                        echo '
                       
                        
                        <thead class="thead-dark">
                        <tr>
                            <th class="text-center" scope="col">Rca</th>
                            <th style="margin-left: 10px; font-weight: bold" scope="col">Vendedor</th>
                            <th class="text-center" scope="col">Ação</th>
                         
                
                        </tr>
                        </thead>
                        <tbody> ';

                foreach ($result_Vend as $row){

                    echo '<tr style="line-height: 40px;">';


                    echo" <td class='text-center'>$row[0]</td>
                          <td style='margin-left: 10px; font-weight: bold'>$row[1]</td>
                          <td class='text-center'><a id='pdf' onclick='abrir()' href='pdf/mixideal.php?rca=".$row[0]."'><img width='50px' src='../images/pdf.svg'></a></td>";


                    }







                    echo '</tr>';







echo '</tbody>';







      echo '</tbody>
        </table>';


 ?>

</div>


<div class="col align-self-center" id="painel" style=" display: none; background: #ffffffc4;position: absolute;width: 100%;height: 100%;margin: 0;text-align: center;top: 0px;">

    <img style="margin-top: 25%" src="email/image/spinner.gif">


</div>




</body>
</html>