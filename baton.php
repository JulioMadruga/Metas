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

$positivados2 = new Positivacoes();
$positivados2->setId($rca);
$positivados2->setTabMes($mes);
$positivados2->setProd($bat);

$positivados = $positivados2->PositAll();
$notPosit = $positivados2->NotPosit();

//var_dump($positivados);


?>

    <div class="page has-sidebar-left">
        <header class="my-1">
            <div class="container-fluid" style="margin-top: 80px;">
                <div class="row">
                    <div class="col">
                        <h1 class="s-24">
                            <i class="icon-people"></i>
                            POSITIVAÇÃO DE BATON<span class="s-14"> Mês de <?=$mes?></span>
                        </h1>
                    </div>
                </div>
            </div>
        </header>

        <form>
            <div class="col">
                <div class="form-group">
                    <label for="inputState" class="col-form-label-sm ">Mês</label>
                    <select id="mes" class="form-control r-10" name="mes">
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
        </form>

        <!-- Progress Widget Start -->
        <div class="col-md-12">
            <div class="card">
                <!--            <div class="card-header dark-blue text-white s-18" style="text-align: center; padding: 20px; margin-bottom: 5px">-->
                <!--                <strong> CHECK LIST REALIZADOS - --><?//= strtoupper($usuario) ?><!-- </strong>-->
                <!--            </div>-->
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">

                        <?php foreach($positivados as $value): ?>

                            <li class="list-group-item" style=" display: grid; grid-template-columns: 1fr 6fr 1fr; align-content: center; padding: 10px; height:80px; background:#d6ecbd; border: solid 1px #f5f8fa">

                               <div style="grid-column: 1; width: 52px "><img style="width: 80px" src="assets/img/pdv.png"/></div>
                                <div style="grid-column: 2"><strong class="font-weight-bold"> Cod.: <?= $value->ID ?></strong><br><strong> <?= $value->razao ?></strong></div>
                                <i style="grid-column: 3"class="s-36 icon icon-check green-text" style="float: right"></i>

                            </li>

                        <?php endforeach; ?>


                    </ul>
                </div>

                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">

                        <?php foreach($notPosit as $value): ?>

                            <li class="list-group-item" style="display: grid; grid-template-columns: 1fr 6fr 1fr; align-content: center; padding: 10px; height:80px; background:#ffd1cc; border: solid 1px #f5f8fa">

                                <div style="grid-column: 1; width: 52px "><img style="width: 80px" src="assets/img/pdv.png"/></div>
                                <div style="grid-column: 2"><strong class="font-weight-bold"> Cod.: <?= $value->Cod_Cli ?></strong><br><strong> <?= $value->razao ?></strong></div>
                                <i style="grid-column: 3"class="s-36 icon icon-remove red-text" style="float: right"></i>

                            </li>

                        <?php endforeach; ?>


                    </ul>
                </div>



            </div>
        </div>
        <!-- Progress Widget End -->

    </div>

<?php require_once 'footer.php'?>