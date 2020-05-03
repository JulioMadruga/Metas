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

//----------------------------VENDA CHOCOLATE------------------------------------
$vendChoc = new Vendachoc();
$vendChoc->setId($rca);
$vendChoc->setBisc($bisc);
$vendChoc->setTabMes($mes);
$vendChoc->setTabMeta($meta);

$vendChoc = $vendChoc->index();

if(isset($vendChoc[0]->Tot)){
    $vendaChocM = $vendChoc[0]->meta;
    $vendaChocR = $vendChoc[0]->Tot;
    $vendaChocPercent = round((($vendaChocR / $vendaChocM)*100),2);
}else{

    $vendaChocM = $vendChoc[0]->valor_choc;
    $vendaChocR = 0;
    $vendaChocPercent = 0;

}


//-----------------------------VENDA BISCOITO-----------------------------------

$vendBisc = new Vendabisc();
$vendBisc->setId($rca);
$vendBisc->setBisc($bisc);
$vendBisc->setTabMes($mes);
$vendBisc->setTabMeta($meta);

$vendBisc = $vendBisc->index();

if(isset($vendBisc[0]->Tot)){
    $vendaBiscM = $vendBisc[0]->meta;
    $vendaBiscR = $vendBisc[0]->Tot;
    $vendaBiscPercent = round((($vendaBiscR / $vendaBiscM)*100),2);
}else{

    $vendaBiscM = $vendBisc[0]->valor_bisc;
    $vendaBiscR = 0;
    $vendaBiscPercent = 0;

}


//-------------------------------POSITIVAÇÃO GERAL ---------------------------------

$contamedalha =0;


$Pgeral = new PositGeral();
$Pgeral->setTabMes($mes);
$Pgeral->setTabMeta($meta);
$Pgeral->setId($rca);

$Pgeral = $Pgeral->index();
if(isset($Pgeral[0]->realizado)) {

    $PgeralM = $Pgeral[0]->tab;
    $PgeralR = $Pgeral[0]->realizado;
    $PgeralPercent = round((($PgeralR / $PgeralM) * 100), 2);

    if($PgeralPercent>=100){

        $contamedalha ++;
    }

}else{

    $PgeralM = $Pgeral[0]->tab;
    $PgeralR = 0;
    $PgeralPercent = 0;

}


//-------------------------------POSITIVAÇÃO BATON ---------------------------------

$Pbaton= new PositBaton();
$Pbaton->setTabMes($mes);
$Pbaton->setTabMeta($meta);
$Pbaton->setId($rca);
$Pbaton->setBaton($bat);


$Pbaton = $Pbaton->index();

if(isset($Pbaton[0]->realizado)) {
    $PbatonM = $Pbaton[0]->meta_baton;
    $PbatonR = $Pbaton[0]->realizado;
    $PbatonPercent = round((($PbatonR / $PbatonM) * 100), 2);

    if($PbatonPercent>=100){

        $contamedalha ++;
    }
}else{
    $PbatonM = $Pbaton[0]->meta_baton;
    $PbatonR = 0;
    $PbatonPercent = 0;
}


//-------------------------------POSITIVAÇÃO BISCOITOS ---------------------------------

$Pbisc= new PositBisc();
$Pbisc->setTabMes($mes);
$Pbisc->setTabMeta($meta);
$Pbisc->setId($rca);
$Pbisc->setBisc($bisc);


$Pbisc = $Pbisc->index();

if(isset($Pbisc[0]->realizado)){
    $PbiscM = $Pbisc[0]->trimarca;
    $PbiscR = $Pbisc[0]->realizado;
    $PbiscPercent = round((($PbiscR / $PbiscM)*100),2);

    if($PbiscPercent>=100){

        $contamedalha ++;
    }

}else{

    $PbiscM = $Pbisc[0]->trimarca;
    $PbiscR = 0;
    $PbiscPercent = 0;

}



//-------------------------------MIX CHOCOLATE ---------------------------------

$MixChoc = new  MixChoc();
$MixChoc->setId($rca);
$MixChoc->setTabMes($mes);
$MixChoc->setTabMeta($meta);

$MixChocM = $MixChoc->TotPontos()[0]->total;
$Mpercent = $MixChoc->MPercent()[0]->topchoc;

$MixChocM = ROUND(($MixChocM * $Mpercent ),0);

if(empty($MixChoc->RealPontos()[0]->total)){
    $MixChocR = 0;
}else{
    $MixChocR = $MixChoc->RealPontos()[0]->total;
}


$MixPercent = ROUND(($MixChocR / $MixChocM)*100,2);

if($MixPercent>=100){

    $contamedalha ++;
}


//-------------------------------MIX Bisc---------------------------------

$MixBisc = new  MixBisc();
$MixBisc->setId($rca);
$MixBisc->setTabMes($mes);
$MixBisc->setTabMeta($meta);

$MixBiscM = $MixBisc->TotPontos()[0]->total;
$Mpercent2 = $MixBisc->MPercent()[0]->topbisc;

$MixBiscM = ROUND(($MixBiscM * $Mpercent2 ),0);

if(empty($MixBisc->RealPontos()[0]->total)){
    $MixBiscR = 0;
}else{
    $MixBiscR = $MixBisc->RealPontos()[0]->total;
}


$MixPercent2 = ROUND(($MixBiscR / $MixBiscM)*100,2);

if($MixPercent2>=100){

    $contamedalha ++;
}



?>

    <div class="page has-sidebar-left">
        <header class="my-3">
            <div class="container-fluid" style="margin-top: 80px;">
                <div class="row">
                    <div class="col">
                        <h1 class="s-24 center">
                            <i class="icon-bar-chart"></i>
                            Objetivos <span class="s-14">Chocolates Garoto</span>
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



        <div class="card no-b shadow">
            <div class="card-body p-0">
                <div class="lightSlider" data-item="4" data-item-xl="4" data-item-md="1" data-item-sm="1" data-pause="7000" data-pager="false" data-auto="true"
                     data-loop="true">
                    <div class="brown lighten-2 text-center text-white">
                        <?php
                             if($vendaChocPercent >=100){
                                echo '<div class="p-1"><img src="assets/img/medalha.png" style="width: 80px; float: right"> </div>';
                             }
                        ?>
                        <div class="p-5">
                        <h5 class="font-weight-normal s-14">Valor Chocolate</h5>
                        <p class="s-36 p-t-10 font-weight-lighter text-primary">R$ <?= number_format($vendaChocM, 2, ',', '.') ?></p>
                        <span class="s-12 font-weight-normal" style="color:#3b1d0d !important;">Realizado</span>
                        <p class="s-18 font-weight-normal" style="color:#3b1d0d !important;">R$ <?= number_format($vendaChocR, 2, ',', '.') ?></p>
                        <p class="p-t-10"><?= $vendaChocPercent ?>% Realizado</p>

                        <div class="progress" style="height: 3px;">

                            <div class="progress-bar bg-brown" role="progressbar" style="width: <?= $vendaChocPercent ?>%;" aria-valuenow="45"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>

                    <div class="yellow lighten-5 text-center text-warning">
                        <?php
                        if($vendaBiscPercent >=100){
                            echo '<div class="p-1"><img src="assets/img/medalha.png" style="width: 80px; float: right"> </div>';
                        }
                        ?>
                        <div class="p-5">
                        <h5 class="font-weight-normal s-14 " style="color:#ff9800 !important">Valor Biscoitos</h5>
                        <p class="s-36 p-t-10 font-weight-lighter" style="color:#ff9800 !important">R$ <?= number_format($vendaBiscM, 2, ',', '.') ?></p>
                        <span class="s-12 font-weight-normal" style="color:#3b1d0d !important;">Realizado</span>
                        <p class="s-18 font-weight-normal" style="color:#3b1d0d !important;">R$ <?= number_format($vendaBiscR, 2, ',', '.') ?></p>
                        <p class="p-t-10" style="color:#ff9800 !important"><?= $vendaBiscPercent ?>% Realizado</p>
                        <div class="progress" style="height: 3px;">

                            <div class="progress-bar bg-deep-orange" role="progressbar" style="width: <?= $vendaBiscPercent ?>%;" aria-valuenow="45"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>

                    <div class="blue darken-3 text-center text-white">
                        <?php
                        if($PgeralPercent >=100){
                            echo '<div class="p-1"><img src="assets/img/medalha.png" style="width: 80px; float: right"> </div>';
                        }
                        ?>
                        <div class="p-5">
                        <h5 class="font-weight-normal s-14 ">Positivação Geral</h5>
                        <p class="s-48 p-t-10 font-weight-lighter"><?= $PgeralM ?></p>
                        <span class="s-12 font-weight-normal" style="color:#0f2548 !important;">Realizado</span>
                        <p class="s-18 font-weight-normal" style="color:#0f2548 !important;"><?= $PgeralR ?></p>
                        <p class="p-t-10 "><?= $PgeralPercent ?>% Realizado</p>
                        <div class="progress" style="height: 3px;">

                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $PgeralPercent ?>%;" aria-valuenow="45"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        </div>
                    </div>

                    <div class="red lighten-4 text-center text-red">
                        <?php
                        if($PbatonPercent >=100){
                            echo '<div class="p-1"><img src="assets/img/medalha.png" style="width: 80px; float: right"> </div>';
                        }
                        ?>
                        <div class="p-5">
                        <h5 class="font-weight-normal s-14 " style="color:red !important;">Positivação Baton</h5>
                        <p class="s-48 p-t-10 font-weight-lighter"><?= $PbatonM ?></p>
                        <span class="s-12 font-weight-normal" style="color:darkred !important;">Realizado</span>
                        <p class="s-18 font-weight-normal" style="color:darkred !important;"><?= $PbatonR ?></p>
                        <p class="p-t-10 "><?= $PbatonPercent ?>% Realizado</p>
                        <div class="progress" style="height: 3px;">

                            <div class="progress-bar bg-red" role="progressbar" style="width: <?= $PbatonPercent ?>%;" aria-valuenow="45"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        </div>
                    </div>


                    <div class="yellow lighten-4 text-center text-warning">
                        <?php
                        if($PbiscPercent >=100){
                            echo '<div class="p-1"><img src="assets/img/medalha.png" style="width: 80px; float: right"> </div>';
                        }
                        ?>
                        <div class="p-5">
                        <h5 class="font-weight-normal s-14 " style="color:#ff9800 !important">Positivação Biscoitos</h5>
                        <p class="s-48 p-t-10 font-weight-lighter" style="color:#ff9800 !important"><?= $PbiscM ?></p>
                        <span class="s-12 font-weight-normal" style="color:#3b1d0d !important;">Realizado</span>
                        <p class="s-18 font-weight-normal" style="color:#3b1d0d !important;"><?= $PbiscR ?></p>
                        <p class="p-t-10" style="color:#ff9800 !important"><?= $PbiscPercent ?>% Realizado</p>
                        <div class="progress" style="height: 3px;">

                            <div class="progress-bar bg-brown" role="progressbar" style="width: <?= $PbiscPercent ?>%;" aria-valuenow="45"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        </div>
                    </div>

                    <div class="dark-blue darken-2 text-center text-white">
                        <?php
                        if($MixPercent >=100){
                            echo '<div class="p-1"><img src="assets/img/medalha.png" style="width: 80px; float: right"> </div>';
                        }
                        ?>
                        <div class="p-5">
                        <h5 class="font-weight-normal s-14 ">Mix Ideal Chocolate</h5>
                        <p class="s-48 p-t-10 font-weight-lighter"><?= $MixChocM ?></p>
                        <span class="s-12 font-weight-normal" style="color:#7dc855 !important;">Realizado</span>
                        <p class="s-18 font-weight-normal" style="color:#7dc855 !important;"><?= $MixChocR ?></p>
                        <p class="p-t-10 "><?= $MixPercent ?>% Realizado</p>
                        <div class="progress" style="height: 3px;">

                            <div class="progress-bar bg-success" role="progressbar" style="width: <?= $MixPercent ?>%;" aria-valuenow="45"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        </div>
                    </div>

                    <div class="green lighten-5 text-center text-success">
                        <?php
                        if($MixPercent2 >=100){
                            echo '<div class="p-1"><img src="assets/img/medalha.png" style="width: 80px; float: right"> </div>';
                        }
                        ?>
                        <div class="p-5">
                        <h5 class="font-weight-normal s-14 " style="color:#6fc335 !important" >Mix Ideal Biscoito</h5>
                        <p class="s-48 p-t-10 font-weight-lighter"><?= $MixBiscM ?></p>
                        <span class="s-12 font-weight-normal" style="color:#032705 !important;">Realizado</span>
                        <p class="s-18 font-weight-normal" style="color:#032705 !important;"><?= $MixBiscR ?></p>
                        <p class="p-t-10 "><?= $MixPercent2 ?>% Realizado</p>
                        <div class="progress" style="height: 3px;">

                            <div class="progress-bar bg-dark-green" role="progressbar" style="width: <?= $MixPercent2 ?>%;" aria-valuenow="45"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        </div>
                    </div>




                </div>
            </div>
        </div>

        <!-- Progress Widget Start -->
        <div class="col-md-12" style="margin-top: 10px">
            <div class="card bg-dark">
                <div class="card-header s-18 font-weight-normal text-white" style="background: #1b2027;text-align: center;">
                    <strong> Desempenho Percentual </strong>
                </div>
                <div class="card-body pt-0">

                    <div class="my-3">
                        <label class="font-weight-bold brown-text">Venda Chocolate</label>
                        <i class="icon icon-arrow-right s-12 brown-text "></i>
                        <small class="brown-text"><?= $vendaChocPercent ?>% desempenho</small>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-brown" role="progressbar" style="width: <?= $vendaChocPercent ?>%;"
                                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="my-3">
                        <label class="font-weight-bold text-warning">Venda Biscoito</label>
                        <i class="icon icon-arrow-right s-12 text-warning "></i>
                        <small class="text-warning"><?= $vendaBiscPercent ?>% desempenho</small>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $vendaBiscPercent ?>%;"
                                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="my-3">
                        <label class="font-weight-bold text-blue">Positivação Geral</label>
                        <i class="icon icon-arrow-right s-12 text-blue"></i>
                        <small class="text-blue"><?= $PgeralPercent ?>% desempenho</small>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $PgeralPercent ?>%;"
                                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="my-3">
                        <label class="font-weight-bold text-red">Positivação Baton</label>
                        <i class="icon icon-arrow-right s-12 text-red"></i>
                        <small class="text-red"><?= $PbatonPercent ?>% desempenho</small>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-red" role="progressbar" style="width: <?= $PbatonPercent ?>%;"
                                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="my-3">
                        <label class="font-weight-bold text-warning">Positivação Biscoito</label>
                        <i class="icon icon-arrow-right s-12 text-warning "></i>
                        <small class="text-warning"><?= $PbiscPercent ?>% desempenho</small>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $PbiscPercent ?>%;"
                                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="my-3">
                        <label class="font-weight-bold brown-text">Mix Ideal Chocolate</label>
                        <i class="icon icon-arrow-right s-12 brown-text"></i>
                        <small class="brown-text"><?= $MixPercent ?>% desempenho</small>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-brown" role="progressbar" style="width: <?= $MixPercent ?>%;"
                                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="my-3">
                        <label class="font-weight-bold text-success">Mix Ideal Biscoitos</label>
                        <i class="icon icon-arrow-right s-12 text-success"></i>
                        <small class="text-success"><?= $MixPercent2 ?>% desempenho</small>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?= $MixPercent2 ?>%;"
                                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="bonus">
                <div class="titlebonus">BONUS</div>

                <?php $i =1; while ($i<=5): ?>

                    <div class="medalha<?= $i ?>">

                      <?php if ($i<=$contamedalha): ?>
                        <img src="assets/img/medalha.png"/>
                      <?php else :?>
                        <img src="assets/img/sem_medalha.png"/>
                      <?php endif;?>

                    </div>

                <?php $i++; endwhile;?>

            </div>



        </div>



    </div>
    </div>


<?php require_once 'footer.php'?>