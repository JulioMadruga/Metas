<?php require_once 'header.php'; ?>

<?php

$user =  new Users();
$result = $user->UserMixCood($usuario);

if(empty($result)){

    $vendedores = $user->all_Vendedores();

}else{

    $vendedores = $user->VendedoresCood($usuario);

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
?>

<!-- Main Content -->
<div class="page-wrapper">

    <div class="container-fluid">

        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h4 class="panel-title txt-dark">Gerar Relatório de Mix Ideal</h4>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="pull-left inline-block full-screen">
                                <i class="zmdi zmdi-fullscreen"></i>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body row pa-0">
                            <div class="table-wrap">
                                <div class="table-responsive">



                                    <table class="table display product-overview border-none" id="support_table">
                                        <thead>
                                             <tr>

                                                <th>RCA</th>
                                                <th>Vendedor</th>
                                                <th class='text-center'>Gerar Relatório de Mix Ideal</th>

                                            </tr>
                                        </thead>
                                        <tbody style="font-size: 14px">

                                        <?php foreach ($vendedores as $value): ?>
                                            <tr>
                                                <td><?= $value->rca ?></td>
                                                <td><?= $value->nome?></td>
                                                <td class='text-center'><a id='pdf' href='../admin/pdf/mixideal.php?rca=<?= $value->rca ?>'><img width='50px' src='../images/pdf.svg'></a></td>


                                            </tr>
                                        <?php endforeach; ?>

                                        </tbody>



                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->






    </div>

</div>
<!-- /Main Content -->

<?php require_once 'footer.php'; ?>