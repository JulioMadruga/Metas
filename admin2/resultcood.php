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


$coordenadores = new Cood();
$coordenadores = $coordenadores->Cood_all();
//var_dump($coordenadores);


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

          <?php foreach ($coordenadores as $cood) :?>
        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h4 class="panel-title txt-dark"><?= $cood->super ?></h4>
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

                                    <?php

                                    $result = $atuaPosit->ResultCoodGeral($cood->super);

                                    ?>


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
                                            <th>Vendedores</th>
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
                                            <td><?= $value->nome ?></td>
                                            <td><?= $value->tab ?></td>

                                            <?php $dif = $value->tab - $value->Rgeral ; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $value->Rgeral  ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $value->Rgeral  ?></span>
                                                </td>
                                            <?php endif;?>


                                            <td><?= $value->meta_baton ?></td>


                                            <?php $dif = $value->meta_baton - $value->Rbaton; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $value->Rbaton ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $value->Rbaton ?></span>
                                                </td>
                                            <?php endif;?>

                                            <td><?= $value->trimarca ?></td>

                                            <?php $dif = $value->trimarca - $value->Rbisc; if( $dif<=0): ?>
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

                                            $MetaMixchoc2->setTabMeta($meta);
                                            $MetaMixchoc2->setId($value->rca);
                                            $percent = $MetaMixchoc2->MPercent();
                                            $MetaMixC = Round($value->MetaMixChoc * $percent[0]->topchoc);

                                            ?>


                                            <td><?= $MetaMixC  ?></td>

                                            <?php
                                            if(empty($value->RmixChoc)){
                                                $dif = $value->MetaMixChoc ;
                                            }else{
                                                $dif = $value->MetaMixChoc - $value->RmixChoc ;
                                            }
                                            if($dif<=0):
                                            ?>

                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $value->RmixChoc  ?></span>
                                                </td>

                                            <?php elseif(empty($value->RmixChoc )):?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px">0</span>
                                                </td>

                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $value->RmixChoc  ?></span>
                                                </td>
                                            <?php endif;?>


                                            <?php

                                            $MetaMixbisc2->setTabMeta($meta);
                                            $MetaMixbisc2->setId($value->rca);
                                            $percent = $MetaMixbisc2->MPercent();
                                            $MetaMixB = Round($value->MetaMixBisc * $percent[0]->topbisc);

                                            ?>





                                            <td><?= $MetaMixB ?></td>

                                            <?php
                                               if(empty($value->RMixBisc )){
                                                   $dif = $value->MetaMixBisc;
                                               }else{
                                                   $dif = $value->MetaMixBisc - $value->RMixBisc ;
                                                   }
                                               if( $dif<=0):

                                                ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $value->RMixBisc ?></span>
                                                </td>

                                            <?php elseif(empty($value->RMixBisc)):?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px">0</span>
                                                </td>

                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $value->RMixBisc  ?></span>
                                                </td>
                                            <?php endif;?>





                                            <td style="width: 3px; border: none !important;" ></td>

                                            <td>R$ <?= number_format($value->valor_choc , 2, ',', '.') ?></td>

                                            <?php
                                                 $RvendaChoc = (empty($value->RVendaChoc)) ? 0 : $value->RVendaChoc;
                                                 $dif = $value->valor_choc - $RvendaChoc;

                                                  if( $dif<=0):

                                            ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px">R$ <?= number_format($RvendaChoc , 2, ',', '.') ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px">R$ <?= number_format($value->RVendaChoc , 2, ',', '.') ?></span>
                                                </td>
                                            <?php endif;?>

                                            <td>R$ <?= number_format($value->valor_bisc , 2, ',', '.') ?></td>

                                            <?php $dif = $value->valor_bisc- $value->RVendaBisc; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px">R$ <?= number_format($value->RVendaBisc , 2, ',', '.') ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px">R$ <?= number_format($value->RVendaBisc , 2, ',', '.') ?></span>
                                                </td>
                                            <?php endif;?>

                                            <td>R$ <?= number_format($value->valor , 2, ',', '.') ?></td>

                                            <?php $dif = $value->valor- $value->RVendaTotal; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px">R$ <?= number_format($value->RVendaTotal, 2, ',', '.') ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px">R$ <?= number_format($value->RVendaTotal, 2, ',', '.') ?></span>
                                                </td>
                                            <?php endif;?>




                                            <?php
                                            $dev = new  Devolucoes();
                                            $dev = $dev->index($mes,$cood->super,$value->rca);
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

                                        <tfoot style="background: #303030; color: white">

                                        <?php $resultTotal = $atuaPosit->ResultCoodGeralTotal($cood->super); ?>

                                        <?php foreach ($resultTotal as $item): ?>

                                        <td>Total</td>

                                        <td><?= $item->Mgeral?></td>


                                            <?php $dif = $item->Mgeral - $item->Rgeral; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $item->Rgeral?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $item->Rgeral?></span>
                                                </td>
                                            <?php endif;?>


                                        <td><?= $item->Mbaton?></td>


                                            <?php $dif = $item->Mbaton - $item->Rbaton; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $item->Rbaton ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $item->Rbaton ?></span>
                                                </td>
                                            <?php endif;?>


                                        <td><?= $item->Mbisc?></td>

                                            <?php $dif = $item->Mbisc - $item->Rbisc; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $item->Rbisc ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $item->Rbisc ?></span>
                                                </td>
                                            <?php endif;?>



                                        <td style="width: 3px; border: none !important;" ></td>

                                        <?php

                                            $MetaMixchoc2->setTabMeta($meta);
                                            $MetaMixchoc2->setId($value->rca);
                                            $percent = $MetaMixchoc2->MPercent();
                                            $MixChoc = round($item->MetaMixChoc * $percent[0]->topchoc) ?>


                                        <td><?= $MixChoc ?></td>

                                            <?php $dif = $MixChoc - $item->RmixChoc; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $item->RmixChoc ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $item->RmixChoc ?></span>
                                                </td>
                                            <?php endif;?>


                                        <td><?= $item->MetaMixBisc?></td>


                                            <?php $dif = $item->MetaMixBisc - $item->RMixBisc; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $item->RMixBisc ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $item->RMixBisc ?></span>
                                                </td>
                                            <?php endif;?>


                                        <td style="width: 3px; border: none !important;" ></td>

                                        <td>R$ <?= number_format($item->valor_choc, 2, ',', '.') ?></td>

                                            <?php $dif = $item->valor_choc - $item->RVendaChoc; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px">R$ <?= number_format($item->RVendaChoc, 2, ',', '.') ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px">R$ <?= number_format($item->RVendaChoc, 2, ',', '.') ?></span>
                                                </td>
                                            <?php endif;?>


                                        <td>R$ <?= number_format($item->valor_bisc, 2, ',', '.') ?></td>

                                            <?php $dif = $item->valor_bisc - $item->RVendaBisc; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px">R$ <?= number_format($item->RVendaBisc, 2, ',', '.') ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px">R$ <?= number_format($item->RVendaBisc, 2, ',', '.') ?></span>
                                                </td>
                                            <?php endif;?>


                                        <td>R$ <?= number_format($item->Valor, 2, ',', '.') ?></td>

                                            <?php $dif = $item->Valor - $item->RVendaTotal; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px">R$ <?= number_format($item->RVendaTotal, 2, ',', '.') ?></span>
                                                </td>
                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px">R$ <?= number_format($item->RVendaTotal, 2, ',', '.') ?></span>
                                                </td>
                                            <?php endif;?>



                                            <?php
                                            $dev = new  Devolucoes();
                                            $dev = $dev->total($mes,$cood->super);
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





                                       <?php endforeach; ?>

                                        </tfoot>





                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->

             <?php endforeach;?>


    </div>
</div>
<!-- /Main Content -->

<?php require_once 'footer.php'; ?>