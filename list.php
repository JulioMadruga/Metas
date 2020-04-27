<?php require_once 'header.php'; ?>
<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Cuiaba');
spl_autoload_register(function ($nomeClasse) {

    if(file_exists("class" . DIRECTORY_SEPARATOR. $nomeClasse.".php") === true){
        require_once ("class" . DIRECTORY_SEPARATOR. $nomeClasse.".php");
    }

});

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $tipo = $_GET['tipo'];

    $checklist = New ListCk();
    $checklist = $checklist->find_List($id,$tipo);

  //  var_dump($checklist);


    if($_GET['tipo'] == 'G'){

        $itensgeral = ['cod_cli','cliente','cod_vend','vend','canal','baton','batonsm','serenata', 'talento25','pastilha',
            'candybar','jumbos','talento100','coberturas','caixas','chocoPo','rech', 'cookies',
            'N_kitkat','N_prestigio','N_charge','N_jumbos','N_caixas','N_chocopo','N_coberturas', 'N_rech','N_cookies',
            'L_sonho','L_bis','L_tab25','L_jumbos','L_tab80','L_caixas','M_snickers','M_twix','M_milkway','M_mm',
            'F_kinder','F_bueno','F_stick','F_bola','A_tortuguita','A_snack','A_jumbos','H_Tablete25','H_Tablete80','H_jumbos',
            'outros', 'merchan','checkout','obs'

        ];


        $prod = ['cod_cli','cliente','cod_vend','vend','canal','Baton DP','Baton Sm','Serenata', 'Talento 25g','Pastilha',
            'CandyBar','Jumbos','Talento 100g','Coberturas','Caixa Bombons Sortidos','Chocolate em Pó','Biscoitos Recheado', 'Biscoitos Cookies',
            'Kitkat','Prestigio','Charge','Jumbos','Caixa Bombons Sortidos','Chocolate em Pó','Coberturas','Biscoitos Recheado','Biscoitos Cookies',
            'Sonho de Valsa','BIZ','tabletes 25g','Jumbos','Tabletes 80g','Caixas Bombons Sortido','Snickers','Twix','Milkway','M&M',
            'Kinder Ovo','Kinder Bueno','Kinder Stick','Bombons Bola','Tortuguita','Snack','Jumbos','Tabletes 25g','Tabletes 80g','Jumbos',
            'outros', 'merchan','checkout','obs'];


    }else{

        $M = ['MENTOS','MARILAN','CASAREDO','PEPSICO','BATAVO','RICHS','SANTA AMÁLIA','YASAÍ','BEM BRASIL','FRIMESA','FLEISCHMAN'];

        $marcas = array();

        foreach ($M as $value){

            $marcas [] = substr($value,0,2).'expositor';
            $marcas [] = substr($value,0,2).'cartaz';
            $marcas [] = substr($value,0,2).'posit';
            $marcas [] = substr($value,0,2).'canal';
            $marcas [] = substr($value,0,2).'QtItens';

        }


        $itens1 = ['cod_cli','cliente','cod_vend','vend','canal','um','dois','tres','quatro','cinco','seis','sete','oito','nove','dez',
            'onze','doze','treze','quatorze','obs'];

        $itensgeral = array_merge($marcas,$itens1);
        //var_dump($itensgeral);
    }


}






?>


<div class="page has-sidebar-left">
    <header class="my-3">
        <div class="container-fluid" style="background: #212833; padding: 16px; margin-top: 70px">
            <div class="row">
                <div class="col-10">
                    <h1 style="font-size: 20px">
                        <i class="icon-list"></i>
                        <?=$checklist[0]->cliente;?>
                    </h1>
                    <h6 class="s-14"><strong style="font-weight: bold">Vendedor:</strong> <span><?=$checklist[0]->vendedor;?></span></h6>
                    <?php $date = date_create($checklist[0]->dt_cad);?>
                    <strong>Data da realização: </strong><?php echo date_format($date, 'm/d/Y');?>
                </div>
                <div class="col-2" style="margin-top: 15px;">
                    <div style="float: right" >

                       <a href="#exampleModal" data-toggle='modal' data-target='#exampleModal' > <figure class="avatar avatar-lg" style="background: #212833">
                            <img src="assets/img/dummy/send.png" alt="">
                        </figure></a>
                    </div>

                </div>

            </div>
        </div>
    </header>

    <?php if($_GET['tipo'] == 'D'){?>

    <div class="container-fluid my-12">

      <?php foreach ($M as $value2):?>

        <div class="card" style="margin-top: 10px">
            <!--            <div class="card-header dark-blue text-white s-18" style="text-align: center; padding: 20px; margin-bottom: 5px">-->
            <!--                <strong> CHECK LIST REALIZADOS - --><?//= strtoupper($usuario) ?><!-- </strong>-->
            <!--            </div>-->
            <div class="card-body p-0" style="box-shadow: 1px 2px 15px 1px;">
                <ul class="list-group list-group-flush">


                    <?php foreach ($itensgeral as $value):?>

                    <?php if($value == substr($value2,0,2).'expositor'){?>

                            <li class="list-group-item" style=" height:50px; padding: 0;  text-align: center; color: white; background: #2d4975">

                                   <strong style="font-size: 38px"><?=$value2?></strong>

                            </li>




                        <?php  $i = 1; } if($i<= 5){?>



                        <li class="list-group-item" style=" height:40px;">

                            <i class="icon icon-lists-24"></i>

                            <strong style="float: left; font-size: 18px; color: #22326b; font-weight: bold"><?php
                                if(substr($value,2,15) == 'expositor'){
                                    echo 'Expositores:';
                                }elseif (substr($value,2,15) == 'cartaz'){
                                    echo 'Cartaz:';
                                }elseif (substr($value,2,15) == 'posit'){
                                    echo 'Presença no cliente:';
                                }elseif (substr($value,2,15) == 'canal'){
                                    echo 'Atendimento:';
                                }elseif (substr($value,2,15) == 'QtItens'){
                                    echo 'Quantidade de Itens:';
                                }
                                ?></strong>

                            <strong style="float: right; font-size: 18px"><?php
                                if($checklist[0]->$value == 'S'){
                                    echo 'Sim';
                                }elseif ($checklist[0]->$value == 'N'){
                                    echo 'Não';
                                }elseif ($checklist[0]->$value == 'D'){
                                    echo 'DISNORTE';
                                }elseif ($checklist[0]->$value == 'A'){
                                    echo 'ATACADO';
                                }elseif ($checklist[0]->$value == 'C'){
                                    echo 'ATACADO+DISNORTE';
                                }elseif ( is_numeric($checklist[0]->$value)== true ){
                                    echo $checklist[0]->$value;
                                }

                                    ?>
                                </strong>
                        </li>

                          <?php }$i++;?>



                    <?php endforeach; ?>

                </ul>
            </div>

        </div>


      <?php endforeach; ?>



        <div class="card" style="margin-top: 10px">
            <!--            <div class="card-header dark-blue text-white s-18" style="text-align: center; padding: 20px; margin-bottom: 5px">-->
            <!--                <strong> CHECK LIST REALIZADOS - --><?//= strtoupper($usuario) ?><!-- </strong>-->

     </div>


   <?php }else{?>


   <!-- ***************************************************GAROTO************************************************************************************ -->


        <div class="container-fluid my-12">



                <div class="card" style="margin-top: 10px">
                    <!--            <div class="card-header dark-blue text-white s-18" style="text-align: center; padding: 20px; margin-bottom: 5px">-->
                    <!--                <strong> CHECK LIST REALIZADOS - --><?//= strtoupper($usuario) ?><!-- </strong>-->
                    <!--            </div>-->
                    <div class="card-body p-0" style="box-shadow: 1px 2px 15px 1px;">
                        <ul class="list-group list-group-flush">


                            <?php $i=0; foreach ($itensgeral as $value):?>

                                   <?php if($i==5){?>

                                    <li class="list-group-item" style=" height:50px; font-weight: 400; padding: 0px; text-align: center; color: #d62020; background: #f3c314">

                                        <strong style="font-size: 38px">Garoto</strong>

                                    </li>

                                  <?php }elseif ($i==18){?>

                                    <li class="list-group-item" style=" height:50px; padding: 0px; text-align: center; color: white; background: #bc0c15">

                                        <strong style="font-size: 38px">Nestle</strong>

                                    </li>


                                   <?php }elseif ($i==27){?>

                                    <li class="list-group-item" style=" height:50px; padding: 0px; text-align: center; color: white; background: #0c1f7b;">

                                        <strong style="font-size: 38px">Lacta</strong>

                                    </li>



                                   <?php }elseif ($i==33){?>

                                    <li class="list-group-item" style=" height:50px; padding: 0px; text-align: center; color: white; background: #0c1f7b;">

                                        <strong style="font-size: 38px">Mars</strong>

                                    </li>



                                   <?php }elseif ($i==37){?>

                                    <li class="list-group-item" style=" height:50px; padding: 0px; text-align: center; color: white; background: #0c1f7b;">

                                        <strong style="font-size: 38px">Ferrero</strong>

                                    </li>



                                   <?php }elseif ($i==41){?>

                                    <li class="list-group-item" style=" height:50px; padding: 0px; text-align: center; color: white; background: #0c1f7b;">

                                        <strong style="font-size: 38px">Arcor</strong>

                                    </li>



                                   <?php }elseif ($i==44){?>

                                    <li class="list-group-item" style=" height:50px; padding: 0px; text-align: center; color: white; background: #0c1f7b;">

                                        <strong style="font-size: 38px">Hersheys</strong>

                                    </li>

                                   <?php  } ?>




                                    <?php if($i>4 && $i<18){?>



                                    <li class="list-group-item" style=" height:50px;">

                                        <i class="icon icon-lists-24"></i>

                                        <strong style="float: left; font-size: 18px; color: #22326b; font-weight: bold"><?php
                                          echo $prod[$i];
                                            ?></strong>

                                        <strong style="float: right; font-size: 18px"><?php
                                                if($checklist[0]->$value == "S"){
                                                    echo "Sim";
                                                }else{
                                                    echo "Não";
                                                }


                                            ?>
                                        </strong>
                                    </li>



                                <?php }elseif($i>17 && $i<27){?>



                                    <li class="list-group-item" style=" height:50px;">

                                        <i class="icon icon-lists-24"></i>

                                        <strong style="float: left; font-size: 18px; color: #22326b; font-weight: bold"><?php
                                            echo $prod[$i];
                                            ?></strong>

                                        <strong style="float: right; font-size: 18px"><?php
                                            if($checklist[0]->$value == "S"){
                                                echo "Sim";
                                            }else{
                                                echo "Não";
                                            }


                                            ?>
                                        </strong>
                                    </li>




                             <?php }elseif($i>26 && $i<33){?>



                                    <li class="list-group-item" style=" height:50px;">

                                        <i class="icon icon-lists-24"></i>

                                        <strong style="float: left; font-size: 18px; color: #22326b; font-weight: bold"><?php
                                            echo $prod[$i];
                                            ?></strong>

                                        <strong style="float: right; font-size: 18px"><?php
                                            if($checklist[0]->$value == "S"){
                                                echo "Sim";
                                            }else{
                                                echo "Não";
                                            }


                                            ?>
                                        </strong>
                                    </li>



                                     <?php }elseif($i>32 && $i<37){?>



                                        <li class="list-group-item" style=" height:50px;">

                                            <i class="icon icon-lists-24"></i>

                                            <strong style="float: left; font-size: 18px; color: #22326b; font-weight: bold"><?php
                                                echo $prod[$i];
                                                ?></strong>

                                            <strong style="float: right; font-size: 18px"><?php
                                                if($checklist[0]->$value == "S"){
                                                    echo "Sim";
                                                }else{
                                                    echo "Não";
                                                }


                                                ?>
                                            </strong>
                                        </li>


                                    <?php }elseif($i>36 && $i<41){?>



                                                <li class="list-group-item" style=" height:50px;">

                                                    <i class="icon icon-lists-24"></i>

                                                    <strong style="float: left; font-size: 18px; color: #22326b; font-weight: bold"><?php
                                                        echo $prod[$i];
                                                        ?></strong>

                                                    <strong style="float: right; font-size: 18px"><?php
                                                        if($checklist[0]->$value == "S"){
                                                            echo "Sim";
                                                        }else{
                                                            echo "Não";
                                                        }


                                                        ?>
                                                    </strong>
                                                </li>



                                           <?php }elseif($i>40 && $i<44){?>



                                                <li class="list-group-item" style=" height:50px;">

                                                    <i class="icon icon-lists-24"></i>

                                                    <strong style="float: left; font-size: 18px; color: #22326b; font-weight: bold"><?php
                                                        echo $prod[$i];
                                                        ?></strong>

                                                    <strong style="float: right; font-size: 18px"><?php
                                                        if($checklist[0]->$value == "S"){
                                                            echo "Sim";
                                                        }else{
                                                            echo "Não";
                                                        }


                                                        ?>
                                                    </strong>
                                                </li>



                                            <?php }elseif($i>43 && $i<47){?>



                                                <li class="list-group-item" style=" height:50px;">

                                                    <i class="icon icon-lists-24"></i>

                                                    <strong style="float: left; font-size: 18px; color: #22326b; font-weight: bold"><?php
                                                        echo $prod[$i];
                                                        ?></strong>

                                                    <strong style="float: right; font-size: 18px"><?php
                                                        if($checklist[0]->$value == "S"){
                                                            echo "Sim";
                                                        }else{
                                                            echo "Não";
                                                        }


                                                        ?>
                                                    </strong>
                                                </li>

                                            <?php } ?>







                            <?php $i++; endforeach; ?>

                        </ul>
                    </div>

                </div>






            <div class="card" style="margin-top: 10px">
                <!--            <div class="card-header dark-blue text-white s-18" style="text-align: center; padding: 20px; margin-bottom: 5px">-->
                <!--                <strong> CHECK LIST REALIZADOS - --><?//= strtoupper($usuario) ?><!-- </strong>-->

            </div>







<?php }?>



            <div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog modal-lg" role="document" style="top:165px">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #0f2548; height: 60px">
                            <span class="icon icon-email s-24" ></span><h3 class="text-white" style="margin: auto;">Enviar Email</h3>
                            <a href="#" data-dismiss="modal" aria-label="Close"
                               class="paper-nav-toggle paper-nav-white active"><i></i></a>
                        </div>
                        <div style="background: #f5b409;text-align: center;">
                            <h5 style="color: black; text-align: center"><strong>Vendedor:&nbsp</strong><?=$checklist[0]->cliente;?></h5>
                        </div>
                          <form action="enviacheck.php" method="post" style="background: #0f2548">

                                <div style="padding: 20px">
                                    <label style="font-size: 16px; color: white">Email</label>
                                    <input id="vend"  class="form-control r-30" type="email" name="email">
                                </div>

                                <div class="form-group" style="text-align: center">
                                    <button class="btn " type="submit" name="envia">Enviar</button>
                                </div>

                          </form>

                    </div>
                </div>
            </div>';











        </div>

</div>

<?php require_once 'footer.php'?>