<?php require_once 'header.php'; ?>
<?php

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

$cliente = new ClientesBase();
$cliente->setRca($rca);
$clientes = $cliente->index();

//var_dump($clientes)


?>

<div class="page has-sidebar-left">
    <header class="my-1">
        <div class="container-fluid" style="margin-top: 80px;">
            <div class="row">
                <div class="col">
                    <h1 class="s-24">
                        <i class="icon-people"></i>
                        Nestle<span class="s-14"> Até Vc</span>
                    </h1>
                </div>
            </div>
        </div>
    </header>

    <!-- Progress Widget Start -->
    <div class="col-md-12">
        <div class="card">
            <!--            <div class="card-header dark-blue text-white s-18" style="text-align: center; padding: 20px; margin-bottom: 5px">-->
            <!--                <strong> CHECK LIST REALIZADOS - --><?//= strtoupper($usuario) ?><!-- </strong>-->
            <!--            </div>-->
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">

                            <?php foreach($clientes as $value): ?>

                           <a href="nestleatevc.php?id=<?= $value->cod_cli ?>"

                                <li class="list-group-item" style=" display: grid; grid-template-columns: 1fr 3fr 3fr; align-content: center; padding: 10px; height:80px; background:#c3d1e6; border: solid 1.5px #f5f8fa; color: #3b5561">

                                    <div style="grid-column: 1; width: 52px "><img style="width: 80px" src="assets/img/pdv.png"/></div>
                                    <div style="grid-column: 2"><strong class="font-weight-bold"> Cod.: <?= $value->cod_cli ?></strong><br><strong> <?= $value->razao ?></strong></div>
                                    <div style="grid-column: 3; color: #084813; font-size: 12.5px; text-align: right"><strong class="font-weight-bold"> CNPJ: <?= $value->cnpj ?></strong><br><strong> <?= $value->cidade ?></strong></div>


                                </li>
                           </a>

                             <?php endforeach; ?>


                </ul>
            </div>



        </div>
    </div>
    <!-- Progress Widget End -->

</div>

<?php
if(isset($_GET['result'])){

    if ($_GET['result'] == 'ok'){



        echo "<script>window.setTimeout(function(){
        document.getElementById('btnexcluido').click();
    }, 100);
    $('#solicitar').show()
    </script>";

        echo'<button id="btnexcluido" style="display: none" class="btn btn-success btn-lg toast-action"
                 data-title="Tudo Certo '.$usuario .'!"
                 data-message="Solicitação de cadastro Enviado!."
                 data-type="success"
                 data-position-class="toast-bottom-right"
>Success Toast
</button>
   
';



    }

}
?>



<?php require_once 'footer.php'?>