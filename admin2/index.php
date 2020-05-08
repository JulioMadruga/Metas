<?php require_once 'header.php'; ?>

<?php

$biscoito = new PositBisc();
$biscoito->setTabMes($mes);
$biscoito->setBisc($bisc);
$biscoito2 = $biscoito->PositGeral();

$baton = new PositBaton();
$baton->setTabMes($mes);
$baton->setBaton($bat);
$baton2 = $baton->PositGeral();


$geral = new PositGeral();
$geral->setTabMes($mes);
$geral2 = $geral->PositG();

$atuaPosit = new MetaGeral();
$atuaPosit->setMeta($meta);
$atuaVenda = $atuaPosit->AtualizaPosit($baton2,$biscoito2,$geral2);

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


$coordenadores = new Cood();
$coordenadores2 = $coordenadores->Cood_all();


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
                    <div class="panel-heading">
                        <div class="pull-left">
                            <span class="panel-title txt-dark" style="font-size: 24px">Positivação Geral</span>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="pull-left inline-block full-screen ">
                                <i class="zmdi zmdi-fullscreen"></i>
                            </a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">

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
                    <div class="panel-heading">
                        <div class="pull-left">
                            <span class="panel-title txt-dark" style="font-size: 24px">Positivação Baton</span>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="pull-left inline-block full-screen ">
                                <i class="zmdi zmdi-fullscreen"></i>
                            </a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">

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
                    <div class="panel-heading">
                        <div class="pull-left">
                            <span class="panel-title txt-dark" style="font-size: 24px">Positivação Biscoito</span>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="pull-left inline-block full-screen ">
                                <i class="zmdi zmdi-fullscreen"></i>
                            </a>

                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">

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
                    <div class="panel-heading">
                        <div class="pull-left">
                            <span class="panel-title txt-dark" style="font-size: 24px">Pontos Mix Chocolate</span>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="pull-left inline-block full-screen ">
                                <i class="zmdi zmdi-fullscreen"></i>
                            </a>

                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">

                            <div class="cus-sat-stat weight-500 txt-success text-center mt-5">

                                <?php

                                $MetaMixchoc2->setTabMeta($meta);
                                $percentM = $MetaMixchoc2->MPercentGeral()->media;

                                $MixChoc = Round($value->MetaMixChoc * $percentM,0);

                                $percentMixChoc =  round(($value->RmixChoc / $MixChoc) * 100,2)



                                ?>


                                <span class="counter-anim"><?= $percentMixChoc ?></span><span>%</span>
                            </div>
                            <div class="progress-anim mt-20">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success wow animated progress-animated" role="progressbar" aria-valuenow="<?= $percentMixChoc ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <ul class="flex-stat mt-5">
                                <li>
                                    <span class="block">Meta</span>
                                    <span class="block txt-dark weight-500 font-15"><?= $MixChoc ?></span>
                                </li>
                                <li>
                                    <span class="block">Realizado</span>
                                    <span class="block txt-dark weight-500 font-15"><?= $value->RmixChoc ?></span>
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
                    <div class="panel-heading">
                        <div class="pull-left">
                            <span class="panel-title txt-dark" style="font-size: 24px">Pontos Mix Biscoitos</span>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="pull-left inline-block full-screen ">
                                <i class="zmdi zmdi-fullscreen"></i>
                            </a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">

                            <div class="cus-sat-stat weight-500 txt-warning text-center mt-5">

                                <?php

                                $MetaMixbisc2->setTabMeta($meta);
                                $percentM = $MetaMixbisc2->MPercentGeral()->media;

                                $MixBisc = Round($value->MetaMixBisc * $percentM,0);

                                $percentMixBisc =  round(($value->RMixBisc / $MixBisc) * 100,2)



                                ?>



                                <span class="counter-anim"><?= $percentMixBisc ?></span><span>%</span>
                            </div>
                            <div class="progress-anim mt-20">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning wow animated progress-animated" role="progressbar" aria-valuenow="<?= $percentMixBisc ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <ul class="flex-stat mt-5">
                                <li>
                                    <span class="block">Meta</span>
                                    <span class="block txt-dark weight-500 font-15"><?= $MixBisc ?></span>
                                </li>
                                <li>
                                    <span class="block">Realizado</span>
                                    <span class="block txt-dark weight-500 font-15"><?= $value->RMixBisc ?></span>
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
                    <div class="panel-heading">
                        <div class="pull-left">
                            <span class="panel-title txt-dark" style="font-size: 28px">Valor Chocolate</span>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="pull-left inline-block full-screen ">
                                <i class="zmdi zmdi-fullscreen"></i>
                            </a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">

                            <div class="cus-sat-stat weight-500 txt-warning text-center mt-5">

                                <?php

                                  $percentChoc = round(($value->RVendaChoc / $value->valor_choc)*100,2);

                                ?>

                                <span class="counter-anim"><?= $percentChoc ?></span><span>%</span>
                            </div>
                            <div class="progress-anim mt-20">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning wow animated progress-animated" role="progressbar" aria-valuenow="<?= $percentChoc ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <ul class="flex-stat mt-5">
                                <li>
                                    <span class="block">Meta</span>
                                    <span class="block txt-dark weight-500 font-13">R$ <?= number_format($value->valor_choc , 2, ',', '.')  ?></span>
                                </li>
                                <li>
                                    <span class="block">Realizado</span>
                                    <span class="block txt-dark weight-500 font-13">R$ <?= number_format($value->RVendaChoc , 2, ',', '.')  ?></span>
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
                    <div class="panel-heading">
                        <div class="pull-left">
                            <span class="panel-title txt-dark" style="font-size: 28px">Valor Biscoito</span>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="pull-left inline-block full-screen ">
                                <i class="zmdi zmdi-fullscreen"></i>
                            </a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">

                            <div class="cus-sat-stat weight-500 txt-warning text-center mt-5">

                                <?php

                                $percentBisc= round(($value->RVendaBisc / $value->valor_bisc)*100,2);

                                ?>

                                <span class="counter-anim"><?= $percentBisc ?></span><span>%</span>
                            </div>
                            <div class="progress-anim mt-20">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning wow animated progress-animated" role="progressbar" aria-valuenow="<?= $percentBisc ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <ul class="flex-stat mt-5">
                                <li>
                                    <span class="block">Meta</span>
                                    <span class="block txt-dark weight-500 font-15">R$ <?= number_format($value->valor_bisc , 2, ',', '.')  ?></span>
                                </li>
                                <li>
                                    <span class="block">Realizado</span>
                                    <span class="block txt-dark weight-500 font-15">R$ <?= number_format($value->RVendaBisc , 2, ',', '.')  ?></span>
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
                    <div class="panel-heading">
                        <div class="pull-left">
                            <span class="panel-title txt-dark" style="font-size: 28px">Valor Total</span>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="pull-left inline-block full-screen ">
                                <i class="zmdi zmdi-fullscreen"></i>
                            </a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body sm-data-box-1">

                            <div class="cus-sat-stat weight-500 txt-warning text-center mt-5">

                                <?php

                                $percentTotal= round(($value->RVendaTotal / $value->Valor)*100,2);

                                ?>

                                <span class="counter-anim"><?= $percentTotal ?></span><span>%</span>
                            </div>
                            <div class="progress-anim mt-20">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning wow animated progress-animated" role="progressbar" aria-valuenow="<?= $percentTotal ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <ul class="flex-stat mt-5">
                                <li>
                                    <span class="block">Meta</span>
                                    <span class="block txt-dark weight-500 font-13">R$ <?= number_format($value->Valor , 2, ',', '.')  ?></span>
                                </li>
                                <li>
                                    <span class="block">Realizado</span>
                                    <span class="block txt-dark weight-500 font-13">R$ <?= number_format($value->RVendaTotal , 2, ',', '.')  ?></span>
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

        <!-- Row -->
        <div class="row">


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Resultados por Coordenadores</h6>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="pull-left inline-block full-screen ">
                                <i class="zmdi zmdi-fullscreen"></i>
                            </a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body row pa-0">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">

                                        <thead>

                                        <tr>
                                            <th>Coordenador</th>
                                            <th>Positivações</th>
                                            <th>Mix ideal</th>
                                            <th>Valor</th>
                                        </tr>

                                        </thead>
                                        <tbody>

                                        <?php foreach ($coordenadores2 as $value): ?>
                                        <tr>
                                            <td><?= $value->super?></td>

                                           <?php

                                           $batonCoodR = $baton->PositCoodBat($value->super)->total;
                                           If($batonCoodR <= 0){$batonCoodR=0.01;}
                                           $biscCoodR =$biscoito->PositCoodBisc($value->super)->total;
                                           If($biscCoodR <= 0){$biscCoodR=0.01;}
                                           $geralCoodR = $geral->PositCoodGeral($value->super)->total;
                                           If($geralCoodR <= 0){$geralCoodR=0.01;}




                                           $coordenadores->setCood($value->super);
                                           $PositCoodM = $coordenadores->MetaPosit($meta);

                                           $batonCoodM = $PositCoodM[0]->baton;
                                           $biscCoodM = $PositCoodM[0]->bisc;
                                           $geralCoodM = $PositCoodM[0]->geral;



                                          $calcPosit = ((( $batonCoodR / $batonCoodM )*100) + (( $biscCoodR/$biscCoodM )*100) + (( $geralCoodR/$geralCoodM )*100))/3;

                                           $calcPosit = Round($calcPosit);

                                           if($calcPosit< 33){
                                               $color = "danger";
                                           }elseif ($calcPosit >33 && $calcPosit< 66){
                                               $color = "warning";
                                           }else{
                                               $color = "success";
                                           }


                                           ?>



                                            <td>
                                                <span class="badge weight-500 txt-<?= $color ?>" style="margin-bottom: 5px; background: #1e2021 !important;"><?= $calcPosit ?>%</span>
                                                <div class="progress progress-xs mb-0 ">
                                                    <div class="progress-bar progress-bar-<?= $color ?>" style="width: <?= $calcPosit ?>%"></div>
                                                </div>
                                            </td>


                                            <?php



                                            $MixChocCoodR = $atuaPosit->ResultCoodGeral2($value->super)->RmixChoc;
                                            If($MixChocCoodR <= 0){$MixChocCoodR=0.01;}

                                            $MixBiscCoodR = $atuaPosit->ResultCoodGeral2($value->super)->RMixBisc;
                                            If($MixBiscCoodR <= 0){$MixBiscCoodR=0.01;}

                                            $MixChocCood = $atuaPosit->ResultCoodGeral2($value->super)->MetaMixChoc;
                                            $percent = $MetaMixchoc2->MPercentGeral()->media;
                                            $MixChocCood = $MixChocCood * $percent;
                                            If($MixChocCood <= 0){$MixChocCood=0.01;}

                                            $MixBiscCood = $atuaPosit->ResultCoodGeral2($value->super)->MetaMixBisc;
                                            $percent = $MetaMixbisc2->MPercentGeral()->media;
                                            $MixBiscCood = $MixBiscCood * $percent;
                                            If($MixBiscCood <= 0){$MixBiscCood=0.01;}




                                            $calcMix = ((( $MixChocCoodR / $MixChocCood )*100) + (( $MixBiscCoodR/$MixBiscCood )*100) )/2;

                                            $calcMix= Round($calcMix);

                                            if($calcMix< 33){
                                                $color = "danger";
                                            }elseif ($calcMix >33 && $calcMix< 66){
                                                $color = "warning";
                                            }else{
                                                $color = "success";
                                            }


                                            ?>



                                            <td>
                                                <span class="badge weight-500 txt-<?= $color ?>" style="margin-bottom: 5px; background: #1e2021 !important;"><?= $calcMix ?>%</span>
                                                <div class="progress progress-xs mb-0 ">
                                                    <div class="progress-bar progress-bar-<?= $color ?>" style="width: <?= $calcMix ?>%"></div>
                                                </div>
                                            </td>



                                            <?php



                                            $RVendaChocR = $atuaPosit->ResultCoodGeral2($value->super)->RVendaChoc;
                                            If($RVendaChocR <= 0){$RVendaChocR=0.01;}

                                            $RVendaBiscR = $atuaPosit->ResultCoodGeral2($value->super)->RVendaBisc;
                                            If($RVendaBiscR <= 0){$RVendaBiscR=0.01;}

                                            $RVendaTotalR = $atuaPosit->ResultCoodGeral2($value->super)->RVendaTotal;
                                            If($RVendaTotalR <= 0){$RVendaTotalR=0.01;}



                                            $Mvalor_choc = $atuaPosit->ResultCoodGeral2($value->super)->valor_choc;
                                            If($Mvalor_choc <= 0){$Mvalor_choc=0.01;}

                                            $Mvalor_bisc = $atuaPosit->ResultCoodGeral2($value->super)->valor_bisc;
                                            If($Mvalor_bisc <= 0){$Mvalor_bisc=0.01;}

                                            $Mvalor = $atuaPosit->ResultCoodGeral2($value->super)->Valor;
                                            If($Mvalor<= 0){$Mvalor=0.01;}




                                            $calcTot= ( $RVendaTotalR/$Mvalor)*100;

                                            $calcTot= Round($calcTot);

                                            if($calcTot< 33){
                                                $color = "danger";
                                            }elseif ($calcTot >33 && $calcTot< 66){
                                                $color = "warning";
                                            }else{
                                                $color = "success";
                                            }


                                            ?>



                                            <td>
                                                <span class="badge weight-500 txt-<?= $color ?>" style="margin-bottom: 5px; background: #1e2021 !important;"><?= $calcTot?>%</span>
                                                <div class="progress progress-xs mb-0 ">
                                                    <div class="progress-bar progress-bar-<?= $color ?>" style="width: <?= $calcTot ?>%"></div>
                                                </div>
                                            </td>





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
        <!-- Row -->




    </div>
</div>
<!-- /Main Content -->

<?php require_once 'footer.php'; ?>