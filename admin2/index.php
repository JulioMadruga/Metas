<?php require_once 'header.php'; ?>

<?php

$biscoito = new PositBisc();
$biscoito->setTabMes($mes);
$biscoito->setBisc($bisc);
$biscoito = $biscoito->PositGeral();

$baton = new PositBaton();
$baton->setTabMes($mes);
$baton->setBaton($bat);
$baton = $baton->PositGeral();


$geral = new PositGeral();
$geral->setTabMes($mes);
$geral = $geral->PositG();

$atuaPosit = new MetaGeral();
$atuaPosit->setMeta($meta);
$atuaVenda = $atuaPosit->AtualizaPosit($baton,$biscoito,$geral);

//-----------------------------------------------------------------------------------------------------

$vendChoc = new Vendachoc();
$vendChoc->setBisc($bisc);
$vendChoc->setTabMes($mes);
$vendChoc = $vendChoc->TotalRcaChoc();

$vendBisc = new Vendabisc();
$vendBisc->setBisc($bisc);
$vendBisc->setTabMes($mes);
$vendBisc = $vendBisc->TotalRcaBisc();

$venda = new Venda();
$venda->setTabMes($mes);
$venda = $venda->TotalRca();


$atuaVenda = $atuaPosit->AtualizaVenda($vendChoc,$vendBisc,$venda);

//-----------------------------------------------------------------------------------------------------

$MetaMixchoc2 = new MixChoc();
$MetaMixchoc2->setTabMes($mes);
$MetaMixchoc = $MetaMixchoc2->TotPontosGeral();

$RmixChoc = $MetaMixchoc2->TotRealPontos();


$MetaMixbisc2 = new MixBisc();
$MetaMixbisc2->setTabMes($mes);
$MetaMixbisc = $MetaMixbisc2->TotPontosGeral();

$RmixBisc = $MetaMixbisc2->TotRealPontos();


$atuaMix = $atuaPosit->AtualizaMix($MetaMixchoc,$MetaMixbisc,$RmixChoc, $RmixBisc);

//-----------------------------------------------------------------------------------------------------


$result = new MetaGeral();
$result->setMeta($meta);
$result = $result->ResultGeral();




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

        <?php foreach ($result as $value): ?>

        <!-- Row -->
        <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">
                            <span class="uppercase-font weight-500 font-20 block text-center txt-dark">Positivação Geral</span>
                            <div class="cus-sat-stat weight-500 txt-success text-center mt-5">

                                <?php

                                   $percentGeral = round(($value->Rgeral/$value->Mgeral)*100,2)

                                ?>

                                <span class="counter-anim"><?= $percentGeral ?></span><span>%</span>
                            </div>
                            <div class="progress-anim mt-20">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success wow animated progress-animated" role="progressbar" aria-valuenow="<?= $percentGeral ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <ul class="flex-stat mt-5">
                                <li>
                                    <span class="block">Meta</span>
                                    <span class="block txt-dark weight-500 font-15"><?= $value->Mgeral ?></span>
                                </li>
                                <li>
                                    <span class="block">Realizado</span>
                                    <span class="block txt-dark weight-500 font-15"><?= $value->Rgeral ?></span>
                                </li>
                                <li>

                                    <span class="block">
												<i class="zmdi zmdi-trending-up txt-success" style="font-size: 30px"></i>
											</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">
                            <span class="uppercase-font weight-500 font-20 block text-center txt-dark">Positivação Baton</span>
                            <div class="cus-sat-stat weight-500 txt-success text-center mt-5">

                                <?php

                                $percentBaton = round(($value->Rbaton/$value->Mbaton)*100,2)

                                ?>

                                <span class="counter-anim"><?= $percentBaton ?></span><span>%</span>
                            </div>
                            <div class="progress-anim mt-20">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success wow animated progress-animated" role="progressbar" aria-valuenow="<?= $percentBaton ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <ul class="flex-stat mt-5">
                                <li>
                                    <span class="block">Meta</span>
                                    <span class="block txt-dark weight-500 font-15"><?= $value->Mbaton ?></span>
                                </li>
                                <li>
                                    <span class="block">Realizado</span>
                                    <span class="block txt-dark weight-500 font-15"><?= $value->Rbaton ?></span>
                                </li>
                                <li>

                                    <span class="block">
												<i class="zmdi zmdi-trending-up txt-success" style="font-size: 30px"></i>
											</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">
                            <span class="uppercase-font weight-500 font-20 block text-center txt-dark">Positivação Biscoito</span>
                            <div class="cus-sat-stat weight-500 txt-success text-center mt-5">

                                <?php

                                $percentBisc = round(($value->Rbisc/$value->Mbisc)*100,2)

                                ?>

                                <span class="counter-anim"><?= $percentBisc ?></span><span>%</span>
                            </div>
                            <div class="progress-anim mt-20">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success wow animated progress-animated" role="progressbar" aria-valuenow="<?= $percentBisc ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <ul class="flex-stat mt-5">
                                <li>
                                    <span class="block">Meta</span>
                                    <span class="block txt-dark weight-500 font-15"><?= $value->Mbisc ?></span>
                                </li>
                                <li>
                                    <span class="block">Realizado</span>
                                    <span class="block txt-dark weight-500 font-15"><?= $value->Rbisc ?></span>
                                </li>
                                <li>

                                    <span class="block">
												<i class="zmdi zmdi-trending-up txt-success" style="font-size: 30px"></i>
											</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">
                            <span class="uppercase-font weight-500 font-20 block text-center txt-dark">Pontos Mix Chocolate</span>
                            <div class="cus-sat-stat weight-500 txt-success text-center mt-5">
                                <span class="counter-anim">93.13</span><span>%</span>
                            </div>
                            <div class="progress-anim mt-20">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success wow animated progress-animated" role="progressbar" aria-valuenow="93.12" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <ul class="flex-stat mt-5">
                                <li>
                                    <span class="block">Meta</span>
                                    <span class="block txt-dark weight-500 font-15">50</span>
                                </li>
                                <li>
                                    <span class="block">Realizado</span>
                                    <span class="block txt-dark weight-500 font-15">40</span>
                                </li>
                                <li>

                                    <span class="block">
												<i class="zmdi zmdi-trending-up txt-success" style="font-size: 30px"></i>
											</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>



            <!-- ------------------------------------------------------------------------------------------------------------------------------- -->

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">
                            <span class="uppercase-font weight-500 font-20 block text-center txt-dark">Ponto Mix Biscoitos</span>
                            <div class="cus-sat-stat weight-500 txt-warning text-center mt-5">
                                <span class="counter-anim">93.13</span><span>%</span>
                            </div>
                            <div class="progress-anim mt-20">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning wow animated progress-animated" role="progressbar" aria-valuenow="93.12" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <ul class="flex-stat mt-5">
                                <li>
                                    <span class="block">Meta</span>
                                    <span class="block txt-dark weight-500 font-15">50</span>
                                </li>
                                <li>
                                    <span class="block">Realizado</span>
                                    <span class="block txt-dark weight-500 font-15">40</span>
                                </li>
                                <li>

                                    <span class="block">
												<i class="zmdi zmdi-trending-up txt-warning" style="font-size: 30px"></i>
											</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">
                            <span class="uppercase-font weight-500 font-20 block text-center txt-dark">Valor Chocolate</span>
                            <div class="cus-sat-stat weight-500 txt-warning text-center mt-5">
                                <span class="counter-anim">93.13</span><span>%</span>
                            </div>
                            <div class="progress-anim mt-20">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning wow animated progress-animated" role="progressbar" aria-valuenow="93.12" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <ul class="flex-stat mt-5">
                                <li>
                                    <span class="block">Meta</span>
                                    <span class="block txt-dark weight-500 font-15">50</span>
                                </li>
                                <li>
                                    <span class="block">Realizado</span>
                                    <span class="block txt-dark weight-500 font-15">40</span>
                                </li>
                                <li>

                                    <span class="block">
												<i class="zmdi zmdi-trending-up txt-warning" style="font-size: 30px"></i>
											</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">
                            <span class="uppercase-font weight-500 font-20 block text-center txt-dark">Valor Biscoito</span>
                            <div class="cus-sat-stat weight-500 txt-warning text-center mt-5">
                                <span class="counter-anim">93.13</span><span>%</span>
                            </div>
                            <div class="progress-anim mt-20">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning wow animated progress-animated" role="progressbar" aria-valuenow="93.12" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <ul class="flex-stat mt-5">
                                <li>
                                    <span class="block">Meta</span>
                                    <span class="block txt-dark weight-500 font-15">50</span>
                                </li>
                                <li>
                                    <span class="block">Realizado</span>
                                    <span class="block txt-dark weight-500 font-15">40</span>
                                </li>
                                <li>

                                    <span class="block">
												<i class="zmdi zmdi-trending-up txt-warning" style="font-size: 30px"></i>
											</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">
                            <span class="uppercase-font weight-500 font-20 block text-center txt-dark">Valor Total</span>
                            <div class="cus-sat-stat weight-500 txt-warning text-center mt-5">
                                <span class="counter-anim">93.13</span><span>%</span>
                            </div>
                            <div class="progress-anim mt-20">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning wow animated progress-animated" role="progressbar" aria-valuenow="93.12" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <ul class="flex-stat mt-5">
                                <li>
                                    <span class="block">Meta</span>
                                    <span class="block txt-dark weight-500 font-15">50</span>
                                </li>
                                <li>
                                    <span class="block">Realizado</span>
                                    <span class="block txt-dark weight-500 font-15">40</span>
                                </li>
                                <li>

                                    <span class="block">
												<i class="zmdi zmdi-trending-up txt-warning" style="font-size: 30px"></i>
											</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <!-- /Row -->

    <?php endforeach; ?>


    </div>
</div>
<!-- /Main Content -->

<?php require_once 'footer.php'; ?>