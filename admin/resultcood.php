<?php require_once 'header.php'; ?>

<?php

$positivacao = new Positivacoes();
$positivacao->setTabMes($mes);
$positivacao->setProd($bisc);
$biscoito = $positivacao->PositGeral();


$positivacao->setTabMes($mes);
$positivacao->setProd($bat);
$baton = $positivacao->PositGeral();

$positivacao->setTabMes($mes);
$positivacao->setProd($jum);
$jumbos = $positivacao->PositGeral();

$positivacao->setTabMes($mes);
$positivacao->setProd($tal);
$talento25 = $positivacao->PositGeral();

$positivacao->setTabMes($mes);
$positivacao->setProd($ser);
$serenata = $positivacao->PositGeral();


$positivacao->setTabMes($mes);
$geral = $positivacao->PositG();





$atuaPosit = new MetaGeral();
$atuaPosit->setMeta($meta);
$atuaVenda = $atuaPosit->AtualizaPosit($baton,$biscoito,$geral,$jumbos,$talento25,$serenata);

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


$user =  new Users();
$result = $user->UserMixCood($usuario);
$coordenadores = new Cood();

if(empty($result)){


    $coordenadores = $coordenadores->Cood_all();

}else{

     $coordenadores = $coordenadores->index($usuario);

}




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

        <?php
        $mixtotalsuper = array();
        $mixtotalsuperBisc = array();

        ?>
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

                                    //var_dump($result);


                                    ?>


                                    <table class="table display product-overview border-none" id="support_table" style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th colspan="20" style="background:#556b49e3;">Positivações</th>
                                            </tr>

                                            <tr>
                                                <th colspan="2" style="text-align: left ">Vendedores</th>
                                                <th>Meta Geral</th>
                                                <th>Real Geral</th>
                                                <th>Meta Baton</th>
                                                <th>Real Baton</th>
                                                <th>Meta Bisc</th>
                                                <th>Real Bisc</th>
                                                <th>Meta Jumbos</th>
                                                <th>Real Jumbos</th>
                                                <th>Meta Talento 25g</th>
                                                <th>Real Talento 25g</th>
                                                <th>Meta Serenata</th>
                                                <th>Real Serenata</th>
                                            </tr>
                                        </thead>

                                        <tbody style="font-size: 14px">
                                        <?php foreach ($result as $value): ?>
                                        <tr>
                                            <td colspan="2" style="text-align: left "><?= $value->nome ?></td>
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


                                            <td><?= $value->posit_jumbos ?></td>

                                            <?php $dif = $value->posit_jumbos - $value->RJumbos; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $value->RJumbos ?></span>
                                                </td>


                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $value->RJumbos?></span>
                                                </td>
                                            <?php endif;?>

                                            <td><?= $value->posit_talento ?></td>

                                            <?php $dif = $value->posit_talento - $value->RTalento; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $value->RTalento ?></span>
                                                </td>


                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $value->RTalento?></span>
                                                </td>
                                            <?php endif;?>

                                            <td><?= $value->posit_serenata ?></td>

                                            <?php $dif = $value->posit_serenata - $value->RSerenata; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $value->RSerenata?></span>
                                                </td>


                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $value->RSerenata?></span>
                                                </td>
                                            <?php endif;?>



                                        </tr>
                                        </tbody>

                                        <?php endforeach; ?>

                                        <tbody style="background: #303030; color: white">
                                        <?php $resultTotal = $atuaPosit->ResultCoodGeralTotal($cood->super); ?>

                                         <?php foreach ($resultTotal as $item): ?>

                                        <td colspan="2">Total</td>

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

                                             <td><?= $item->Mjumbos?></td>

                                             <?php $dif = $item->Mjumbos - $item->Rjumbos; if( $dif<=0): ?>
                                                 <td>
                                                     <span class="label label-success" style="color: black; font-size: 14px"><?= $item->Rjumbos ?></span>
                                                 </td>
                                             <?php else:?>
                                                 <td>
                                                     <span class="label label-danger" style="color: black; font-size: 14px"><?= $item->Rjumbos ?></span>
                                                 </td>
                                             <?php endif;?>
                                             <td><?= $item->Mtalento?></td>

                                             <?php $dif = $item->Mtalento - $item->Rtalento; if( $dif<=0): ?>
                                                 <td>
                                                     <span class="label label-success" style="color: black; font-size: 14px"><?= $item->Rtalento?></span>
                                                 </td>
                                             <?php else:?>
                                                 <td>
                                                     <span class="label label-danger" style="color: black; font-size: 14px"><?= $item->Rtalento ?></span>
                                                 </td>
                                             <?php endif;?>

                                             <td><?= $item->Mserenata?></td>

                                             <?php $dif = $item->Mserenata - $item->Rserenata; if( $dif<=0): ?>
                                                 <td>
                                                     <span class="label label-success" style="color: black; font-size: 14px"><?= $item->Rserenata ?></span>
                                                 </td>
                                             <?php else:?>
                                                 <td>
                                                     <span class="label label-danger" style="color: black; font-size: 14px"><?= $item->Rserenata ?></span>
                                                 </td>
                                             <?php endif; endforeach;?>


                                        </tbody>




                                        <thead>
                                        <tr>
                                            <th colspan="6" style="background:#4c6d6a;text-align: center ">Mix Ideal</th>
                                            <th style="width: 3px; border: none !important;"></th>
                                            <th colspan="7" style="background:#324450;text-align: center ">Valor</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="text-align: left ">Vendedores</th>

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


                                        <?php foreach ($result as $value): ?>

                                        <tbody style="font-size: 14px">


                                        <tr>
                                            <td colspan="2"  style="text-align: left "><?= $value->nome ?></td>



                                            <?php

                                            $MetaMixchoc2->setTabMeta($meta);
                                            $MetaMixchoc2->setId($value->rca);
                                            $percent = $MetaMixchoc2->MPercent();
                                            $MetaMixC = Round($value->MetaMixChoc * $percent[0]->topchoc);

                                            $mixtotalsuper [] = $MetaMixC;
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

                                            $MetaMixbisc2->setTabMeta($meta);
                                            $MetaMixbisc2->setId($value->rca);
                                            $percent = $MetaMixbisc2->MPercent();
                                            $MetaMixB = Round($value->MetaMixBisc * $percent[0]->topbisc);

                                            $mixtotalsuperBisc [] = $MetaMixB;

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

                                            <td>R$ <?= number_format($value->valor , 2, ',', '.') ?></td>

                                            <?php  $RVendaTotal = strlen($value->RVendaTotal) == 0 ? 0 : $value->RVendaTotal;
                                            $dif = $value->valor - $RVendaTotal ; if( $dif<=0): ?>
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


                                        <td style="width: 3px; border: none !important;" ></td>

                                        <?php

                                            $totalMetaMix = array_sum($mixtotalsuper);

                                            $mixtotalsuper = [];

                                            $totalMetaMixBisc = array_sum($mixtotalsuperBisc);

                                            $mixtotalsuperBisc = [];

                                         ?>


                                        <td><?= $totalMetaMix ?></td>

                                            <?php $dif = $totalMetaMix  - $item->RmixChoc; if( $dif<=0): ?>
                                                <td>
                                                    <span class="label label-success" style="color: black; font-size: 14px"><?= $item->RmixChoc ?></span>
                                                </td>

                                            <?php else:?>
                                                <td>
                                                    <span class="label label-danger" style="color: black; font-size: 14px"><?= $item->RmixChoc ?></span>
                                                </td>
                                            <?php endif;?>



                                        <td><?= $totalMetaMixBisc ?></td>


                                            <?php $dif = $totalMetaMixBisc  - $item->RMixBisc; if( $dif<=0): ?>
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