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
?>

<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">

        <form>
            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label mb-10">Selecionar Mês:</label>
                        <select id="mes" style="border-radius: 8px" class="form-control" data-placeholder="Choose a Category" tabindex="1">
                            <option <?=$check0?>>Janeiro</option>
                            <option <?=$check1?>>Fevereiro</option>
                            <option <?=$check2?>>Março</option>
                            <option <?=$check3?>>Abril</option>
                            <option <?=$check4?>>Maio</option>
                            <option <?=$check5?>>Junho</option>
                            <option <?=$check6?>>Julho</option>
                            <option <?=$check7?>>Agosto</option>
                            <option <?=$check8?>>Setembro</option>
                            <option <?=$check9?>>Outubro</option>
                            <option <?=$check10?>>Novembro</option>
                            <option <?=$check11?>>Dezembro</option>
                        </select>
                    </div>
                </div>

            </div>
        </form>


        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">customer support</h6>
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
                                            <th>ticket ID</th>
                                            <th>Customer</th>
                                            <th>issue</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>#85457898</td>
                                            <td>Jens Brincker</td>
                                            <td>Jetson chart</td>
                                            <td>Oct 27</td>
                                            <td>
                                                <span class="label label-success">done</span>
                                            </td>
                                            <td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>#85457897</td>
                                            <td>Mark Hay</td>
                                            <td>PSD resolution</td>
                                            <td>Oct 26</td>
                                            <td>
                                                <span class="label label-warning ">Pending</span>
                                            </td>
                                            <td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>#85457896</td>
                                            <td>Anthony Davie</td>
                                            <td>Cinnabar</td>
                                            <td>Oct 25</td>
                                            <td>
                                                <span class="label label-success ">done</span>
                                            </td>
                                            <td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>#85457895</td>
                                            <td>David Perry</td>
                                            <td>Felix PSD</td>
                                            <td>Oct 25</td>
                                            <td>
                                                <span class="label label-danger">pending</span>
                                            </td>
                                            <td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>#85457894</td>
                                            <td>Anthony Davie</td>
                                            <td>Beryl iphone</td>
                                            <td>Oct 25</td>
                                            <td>
                                                <span class="label label-success ">done</span>
                                            </td>
                                            <td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>#85457893</td>
                                            <td>Alan Gilchrist</td>
                                            <td>Pogody button</td>
                                            <td>Oct 22</td>
                                            <td>
                                                <span class="label label-warning ">Pending</span>
                                            </td>
                                            <td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>#85457892</td>
                                            <td>Mark Hay</td>
                                            <td>Beavis sidebar</td>
                                            <td>Oct 18</td>
                                            <td>
                                                <span class="label label-success ">done</span>
                                            </td>
                                            <td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>#85457891</td>
                                            <td>Sue Woodger</td>
                                            <td>Pogody header</td>
                                            <td>Oct 17</td>
                                            <td>
                                                <span class="label label-danger">pending</span>
                                            </td>
                                            <td><a href="javascript:void(0)" class="pr-10" data-toggle="tooltip" title="completed" ><i class="zmdi zmdi-check"></i></a> <a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete"></i></a></td>
                                        </tr>
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