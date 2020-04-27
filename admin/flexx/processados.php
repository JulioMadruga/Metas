<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Importação de Aquivos Flexx</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>

<script>

    $(document).ready(function(){

        $( "#sair" ).click(function() {

            $("#principal" ).css("display","none");
            $("#principal2" ).css("display","none");


            $("#painel" ).css("display","block");

        });
    });



</script>


<body>




<?php

$directory = realpath('./arquivos/processados');
$pasta = $directory;

if(is_dir($pasta))
{ $diretorio = dir($pasta);

$i=0;
    echo '<div class="col align-self-center" id="principal2"  style="width: 500px; margin: auto; text-align: center; top:20px"> ' ;
    echo '<h1 class="btn btn-primary btn-lg btn-block"> Arquivos Processados </h1>';
    echo '<ul class="list-group">' ;

while(($arquivo = $diretorio->read()) !== false)
{





    if($i>1){

        echo ' <li class="list-group-item d-flex justify-content-between align-items-center">';
        echo $arquivo;
        echo '<span class="oi oi-check" style="color: #48c208"></span>';
        echo ' </li>';
       // echo $arquivo.'<br/>';

    }




$i++;


}
$diretorio->close();

    echo '</ul>';
    echo '</div>';

}else{
echo 'A pasta não existe.';
}



?>
<div class="col align-self-center" id="principal" style="width: 500px; margin: auto ; margin-top: 50px; text-align: center;">

    <a href="../posit_diario.php" id="sair" class="btn btn-danger btn-lg active"  style="width: 200px" role="button" aria-pressed="true">Sair</a>

</div>

<div class="col align-self-center" id="painel" style=" display:none; width: 800px; margin: auto; text-align: center; top:250px">

    <img src="image/spinner.gif">


</div>


</body>
</html>
