<?php require_once 'header.php'; ?>
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


}


?>

<div class="page has-sidebar-left">
    <header class="my-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="s-24">
                        <i class="icon-group"></i>
                        Importação de clientes
                    </h1>
                </div>
            </div>
        </div>
    </header>

    <div class="card-body b-b">
        <form action="#" method="post" enctype="multipart/form-data" >
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4" class="col-form-label">Arquivo CSV</label>
                    <input type="file" name="filename" class="form-control" id="inputEmail4">
                </div>

            <button type="submit" name="submit" class="btn btn-primary" style="margin: auto; width: 200px;">Atualizar</button>
        </form>
    </div>

    <br>

    <?php  if($result == "atualizado"){

            echo'<div role="alert" class="alert alert-success"><strong>Lista de Clientes Atualizado</strong>
            </div>';

            }else if ($result == "erro"){
                echo ' <div role="alert" class="alert alert-danger"><strong>Não foi possível atualizar verifique o arquivo.</strong>
            </div>'; }

        ?>





<?php require_once 'footer.php'?>