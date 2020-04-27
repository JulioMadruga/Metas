<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Cuiaba');
spl_autoload_register(function ($nomeClasse) {

    if(file_exists("class" . DIRECTORY_SEPARATOR. $nomeClasse.".php") === true){
        require_once ("class" . DIRECTORY_SEPARATOR. $nomeClasse.".php");
    }

});



if (isset($_POST['submit'])) {

    $arquivo = fopen($_FILES['filename']['tmp_name'], "r");

    move_uploaded_file($_FILES["filename"]["tmp_name"], "uploads/" . $_FILES['filename']['name']);


    //var_dump($arquivo);

      $name = getcwd().DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR.$_FILES['filename']['name'];

      $name = str_replace("\\","/",$name);
    //$name = $_FILES['filename']['name'];

    $importar = new ImportarCSV();
    $importar->setArquivo($arquivo);
    $importar->setNome($name);
    $result = $importar->clientes();

    header("Location: impclientes.php");
    die();


}


?>