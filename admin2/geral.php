<?php require_once 'header.php'; ?>

<?php

$Geral =  new MetaGeral();
$Geral->setMeta($meta);
$result = $Geral->ResultGeral();




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
                            <h4 class="panel-title txt-dark">RESULTADO GERAL</h4>
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
                                            <th colspan="7" style="background:#556b49e3;text-align: center ">Positivações</th>
                                            <th style="width: 3px; border: none !important;"></th>
                                            <th colspan="4" style="background:#4c6d6a;text-align: center ">Mix Ideal</th>
                                            <th style="width: 3px; border: none !important;"></th>
                                            <th colspan="7" style="background:#324450;text-align: center ">Valor</th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Meta Geral</th>
                                            <th>Real Geral</th>
                                            <th>Meta Baton</th>
                                            <th>Real Baton</th>
                                            <th>Meta Bisc</th>
                                            <th>Real Bisc</th>
                                            <th style="width: 3px; border: none !important;"></th>
                                            <th>Meta Choc</th>
                                            <th>Real Choc</th>
                                            <th>Meta Bisc</th>
                                            <th>Real Bisc</th>
                                            <th style="width: 3px; border: none !important;"></th>
                                            <th>Meta Choc</th>
                                            <th>Real Choc</th>
                                            <th>Meta Bisc</th>
                                            <th>Real Bisc</th>
                                            <th>Meta Total</th>
                                            <th>Real Total</th>
                                            <th>Devoluções</th>
                                        </tr>
                                        </thead>
                                        <tbody style="font-size: 14px">

                                        <?php foreach ($result as $value): ?>
                                        <tr>
                                            <td>TOTAL</td>
                                            <td><?= $value->Mgeral?></td>

                                            <?php $dif = $value->Mgeral - $value->Rgeral ; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $value->Rgeral  ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $value->Rgeral  ?></span>
                                                </td>
                                            <?php endif;?>


                                            <td><?= $value->Mbaton ?></td>


                                            <?php $dif = $value->Mbaton - $value->Rbaton; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $value->Rbaton ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $value->Rbaton ?></span>
                                                </td>
                                            <?php endif;?>

                                            <td><?= $value->Mbisc ?></td>

                                            <?php $dif = $value->Mbisc - $value->Rbisc; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $value->Rbisc ?></span>
                                                </td>


                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $value->Rbisc ?></span>
                                                </td>
                                            <?php endif;?>





                                            <td style="width: 3px; border: none !important;" ></td>


                                            <?php


                                            $MetaMixchoc2 = new MixChoc();
                                            $MetaMixchoc2->setTabMeta($meta);
                                            $percent = $MetaMixchoc2->MPercentGeral()->media;
                                            $MetaMixC = Round($value->MetaMixChoc * $percent);

                                            ?>


                                            <td><?= $MetaMixC  ?></td>

                                            <?php
                                            $RmixChoc= strlen($value->RmixChoc ) == 0 ? 0 : $value->RmixChoc ;
                                            $dif = $MetaMixC - $RmixChoc;

                                            if($dif<=0):
                                            ?>

                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $RmixChoc  ?></span>
                                                </td>


                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $RmixChoc  ?></span>
                                                </td>
                                            <?php endif;?>


                                            <?php

                                            $MetaMixbisc2 = new MixBisc();
                                            $MetaMixbisc2->setTabMeta($meta);
                                            $percent = $MetaMixbisc2 ->MPercentGeral()->media;
                                            $MetaMixB = Round($value->MetaMixBisc * $percent);

                                            ?>



                                            <td><?= $MetaMixB ?></td>

                                            <?php
                                            $RMixBisc = strlen($value->RMixBisc) == 0 ? 0 : $value->RMixBisc;
                                            $dif = $MetaMixB - $RMixBisc;

                                               if( $dif<=0):

                                                ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $RMixBisc  ?></span>
                                                </td>


                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $RMixBisc  ?></span>
                                                </td>
                                            <?php endif;?>





                                            <td style="width: 3px; border: none !important;" ></td>

                                            <td>R$ <?= number_format($value->valor_choc , 2, ',', '.') ?></td>

                                            <?php
                                           //var_dump(strlen($value->RVendaChoc));
                                                 $RvendaChoc = strlen($value->RVendaChoc) == 0 ? 0 : $value->RVendaChoc;
                                                 $dif = $value->valor_choc - $RvendaChoc;

                                                  if( $dif<=0):

                                            ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px">R$ <?= number_format($RvendaChoc , 2, ',', '.') ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px">R$ <?= number_format($RvendaChoc , 2, ',', '.') ?></span>
                                                </td>
                                            <?php endif;?>

                                            <td>R$ <?= number_format($value->valor_bisc , 2, ',', '.') ?></td>

                                            <?php $RVendaBisc = strlen($value->RVendaBisc) == 0 ? 0 : $value->RVendaBisc;
                                            $dif = $value->valor_bisc- $RVendaBisc; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px">R$ <?= number_format($RVendaBisc , 2, ',', '.') ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px">R$ <?= number_format($RVendaBisc , 2, ',', '.') ?></span>
                                                </td>
                                            <?php endif;?>

                                            <td>R$ <?= number_format($value->Valor , 2, ',', '.') ?></td>

                                            <?php  $RVendaTotal = strlen($value->RVendaTotal) == 0 ? 0 : $value->RVendaTotal;
                                            $dif = $value->Valor - $RVendaTotal ; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px">R$ <?= number_format($RVendaTotal, 2, ',', '.') ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px">R$ <?= number_format($RVendaTotal, 2, ',', '.') ?></span>
                                                </td>
                                            <?php endif;?>




                                            <?php
                                            $dev = new  Devolucoes();
                                            $dev = $dev->totalGeral($mes);
                                           // var_dump($dev);
                                            ?>

                                            <?php if(!empty($dev)): ?>

                                                <td>
                                                    <span class="label label-warning" style="color: black; font-size: 14px">
                                                        R$ <?= number_format($dev->Total, 2, ',', '.') ?>
                                                    </span>
                                                </td>

                                            <?php else: ?>

                                                <td> <span class="label label-default"></span></td>

                                            <?php endif; ?>




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