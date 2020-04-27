<?php require_once "header.php";?>

<div class="page has-sidebar-left">
    <header class="my-3">
        <div class="container-fluid" style="margin-top: 70px;">
            <div class="row">
                <div class="col">
                    <h1 class="s-24">
                        <i class="icon-analytics"></i>
                        Garoto <span class="s-14">Análise de Mercado</span>
                    </h1>
                </div>
            </div>
        </div>
    </header>

    <form name="garoto" method="post" action="cadgaroto.php?id=<?= $id_user ?>">
        <div class="col">

            <div id="codcli" class="form-group" style="display: none">
                 <label>Cod. Cli</label>
                <input id="cod_cli"  class="form-control r-30" type="text" name="cod_cli" readonly>
            </div>

        <div class="form-group">
<!--            <label>Cliente</label>-->
            <input id="autocomplete_cli"  class="form-control r-30" type="text" name="cliente" placeholder="Cliente">
        </div>
            <div id="vendedor" class="form-group" style="display: none">
                <label>Vendedor</label>
                <input id="vend"  class="form-control r-30" type="text" name="vend" readonly>
            </div>
            <div id="codvend" class="form-group" style="display: none">
                <label>Vendedor</label>
                <input id="cod_vend"  class="form-control r-30" type="text" name="cod_vend" readonly>
            </div>

            <div class="form-group" style="display: none">
                <label for="inputState" class="col-form-label">Canal do Cliente</label>
                <input id="canal"  class="form-control r-30" type="text" name="canal" readonly>
            </div>

            <div id="herarquia" class="form-group" style="display: none">
                <label for="inputState" class="col-form-label"><strong>Canal do Cliente: </strong></label>
                <label id="canalCliente" for="inputState" class="col-form-label">aaaaaaa</label>

            </div>


        </div>

        <div class="col">
        <div class="card bg-light mb-3">
            <div style="background: #eab12c; color: aliceblue;" class="card-header">Chocolates Garoto</div>
            <div class="container-fluid my-3">

                <li class="list-group-item">
                    Baton DP
                    <div class="material-switch float-right">
                        <input id="someSwitchOptionPrimary" name="baton"  type="checkbox"/>
                        <label for="someSwitchOptionPrimary" class="bg-success"></label>
                    </div>
                </li>

                <li class="list-group-item">
                    Baton SM
                    <div class="material-switch float-right">
                        <input id="someSwitchOptionPrimary2" name="batonsm"  type="checkbox"/>
                        <label for="someSwitchOptionPrimary2" class="bg-success"></label>
                    </div>
                </li>

                <li class="list-group-item">
                    Serenata
                    <div class="material-switch float-right">
                        <input id="someSwitchOptionPrimary3" name="serenata"  type="checkbox"/>
                        <label for="someSwitchOptionPrimary3" class="bg-success"></label>
                    </div>
                </li>



                <li class="list-group-item">
                    Talento 25g
                    <div class="material-switch float-right">
                        <input id="someSwitchOptionPrimary4" name="talento25"  type="checkbox"/>
                        <label for="someSwitchOptionPrimary4" class="bg-success"></label>
                    </div>
                </li>

                <li class="list-group-item">
                    Pastilha
                    <div class="material-switch float-right">
                        <input id="someSwitchOptionPrimary5" name="pastilha"  type="checkbox"/>
                        <label for="someSwitchOptionPrimary5" class="bg-success"></label>
                    </div>
                </li>

                <li class="list-group-item">
                    CandyBar
                    <div class="material-switch float-right">
                        <input id="someSwitchOptionPrimary6" name="candybar"  type="checkbox"/>
                        <label for="someSwitchOptionPrimary6" class="bg-success"></label>
                    </div>
                </li>

                <li class="list-group-item">
                    Jumbos
                    <div class="material-switch float-right">
                        <input id="someSwitchOptionPrimary7" name="jumbos"  type="checkbox"/>
                        <label for="someSwitchOptionPrimary7" class="bg-success"></label>
                    </div>
                </li>

                <li class="list-group-item">
                    Talento 100g
                    <div class="material-switch float-right">
                        <input id="someSwitchOptionPrimary8" name="talento100"  type="checkbox"/>
                        <label for="someSwitchOptionPrimary8" class="bg-success"></label>
                    </div>
                </li>

                <li class="list-group-item">
                    Coberturas
                    <div class="material-switch float-right">
                        <input id="someSwitchOptionPrimary9" name="coberturas"  type="checkbox"/>
                        <label for="someSwitchOptionPrimary9" class="bg-success"></label>
                    </div>
                </li>

                <li class="list-group-item">
                    Caixa de Bombons
                    <div class="material-switch float-right">
                        <input id="someSwitchOptionPrimary10" name="caixas"  type="checkbox"/>
                        <label for="someSwitchOptionPrimary10" class="bg-success"></label>
                    </div>
                </li>

                <li class="list-group-item">
                    Chocolate em Pó
                    <div class="material-switch float-right">
                        <input id="someSwitchOptionPrimary11" name="chocoPo"  type="checkbox"/>
                        <label for="someSwitchOptionPrimary11" class="bg-success"></label>
                    </div>
                </li>

                <li class="list-group-item">
                    Biscoito Recheados
                    <div class="material-switch float-right">
                        <input id="someSwitchOptionPrimary12" name="rech"  type="checkbox"/>
                        <label for="someSwitchOptionPrimary12" class="bg-success"></label>
                    </div>
                </li>

                <li class="list-group-item">
                    Biscoitos Cookies
                    <div class="material-switch float-right">
                        <input id="someSwitchOptionPrimary13" name="cookies"  type="checkbox"/>
                        <label for="someSwitchOptionPrimary13" class="bg-success"></label>
                    </div>
                </li>

            </div>

        </div>
    </div>

     <!--divisão -->


        <div class="col">
            <div class="card bg-light mb-3">
                <div style="background: #c32e3c; color: aliceblue;"  class="card-header">Nestle</div>
                <div class="container-fluid my-3">

                    <li class="list-group-item">
                        KitKat
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryn1" name="N_kitkat"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryn1" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        Prestígio/Chokito
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryn2" name="N_prestigio"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryn2" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        Charge/Galac/Lollo
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryn3" name="N_charge"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryn3" class="bg-success"></label>
                        </div>
                    </li>



                    <li class="list-group-item">
                        Jumbos
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryn4" name="N_jumbos"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryn4" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        Caixas de Bombons
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryn5" name="N_caixas"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryn5" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        Chocolate em Pó
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryn6" name="N_chocopo"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryn6" class="bg-success"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        Coberturas
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryn7" name="N_coberturas"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryn7" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        Biscoitos Recheados
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryn8" name="N_rech"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryn8" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        Biscoitos Cookies
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryn9" name="N_cookies"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryn9" class="bg-success"></label>
                        </div>
                    </li>

                </div>

            </div>
        </div>

<!--  ----------------------------------------------------- -->

        <div class="col">
            <div class="card bg-light mb-3">
                <div style="background: #093882; color: aliceblue;" class="card-header">Lacta</div>
                <div class="container-fluid my-3">

                    <li class="list-group-item">
                        Sonho de Valsa / Ouro Branco
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryl1" name="L_sonho"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryl1" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        Bis
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryl2" name="L_bis"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryl2" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        Tablete 25g
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryl3" name="L_tab25"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryl3" class="bg-success"></label>
                        </div>
                    </li>



                    <li class="list-group-item">
                        Jumbos
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryl4" name="L_jumbos"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryl4" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        Tabletes 80g
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryl5" name="L_tab80"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryl5" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        Caixa de Bombons
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryl6" name="L_caixas"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryl6" class="bg-success"></label>
                        </div>
                    </li>

                </div>

            </div>
        </div>



        <!--  ----------------------------------------------------- -->

        <div class="col">
            <div class="card bg-light mb-3">
                <div style="background: #2762bd; color: aliceblue;" class="card-header">Mars</div>
                <div class="container-fluid my-3">

                    <li class="list-group-item">
                        Snickers
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimarym1" name="M_snickers"  type="checkbox"/>
                            <label for="someSwitchOptionPrimarym1" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        Twix
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimarym2" name="M_twix"  type="checkbox"/>
                            <label for="someSwitchOptionPrimarym2" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        MilkWay
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimarym3" name="M_milkway"  type="checkbox"/>
                            <label for="someSwitchOptionPrimarym3" class="bg-success"></label>
                        </div>
                    </li>



                    <li class="list-group-item">
                        M&M
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimarym4" name="M_mm"  type="checkbox"/>
                            <label for="someSwitchOptionPrimarym4" class="bg-success"></label>
                        </div>
                    </li>


                </div>

            </div>
        </div>


        <!--  ----------------------------------------------------- -->

        <div class="col">
            <div class="card bg-light mb-3">
                <div style="background: #9e7934; color: aliceblue;" class="card-header">Ferrero</div>
                <div class="container-fluid my-3">

                    <li class="list-group-item">
                        Kinder Ovo
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryf1" name="F_kinder"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryf1" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        Kinder Bueno
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryf2" name="F_bueno"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryf2" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        Kinder Stick
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryf3" name="F_stick"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryf3" class="bg-success"></label>
                        </div>
                    </li>



                    <li class="list-group-item">
                        Bombons bola
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryf4" name="F_bola"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryf4" class="bg-success"></label>
                        </div>
                    </li>


                </div>

            </div>
        </div>

        <!--  ----------------------------------------------------- -->

        <div class="col">
            <div class="card bg-light mb-3">
                <div style="background: #241aa5; color: aliceblue;" class="card-header">Arcor</div>
                <div class="container-fluid my-3">

                    <li class="list-group-item">
                        Tortuguita
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimarya1" name="A_tortuguita"  type="checkbox"/>
                            <label for="someSwitchOptionPrimarya1" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        Snack
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimarya2" name="A_snack"  type="checkbox"/>
                            <label for="someSwitchOptionPrimarya2" class="bg-success"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        Jumbos
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimarya3" name="A_jumbos"  type="checkbox"/>
                            <label for="someSwitchOptionPrimarya3" class="bg-success"></label>
                        </div>
                    </li>


                </div>

            </div>
        </div>


        <!--  ----------------------------------------------------- -->

        <div class="col">
            <div class="card bg-light mb-3">
                <div style="background: #65280a; color: aliceblue;" class="card-header">HERSHEYS</div>
                <div class="container-fluid my-3">

                    <li class="list-group-item">
                        Tablete 25g
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryh1" name="H_Tablete25"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryh1" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        Tablete 80g
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryh2" name="H_Tablete80"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryh2" class="bg-success"></label>
                        </div>
                    </li>

                    <li class="list-group-item">
                        Jumbos
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryh3" name="H_jumbos"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryh3" class="bg-success"></label>
                        </div>
                    </li>




                </div>

            </div>
        </div>



        <!--  ----------------------------------------------------- -->

        <div class="col">
            <div class="card bg-light mb-3">
                <div style="background: #969696; color: aliceblue;" class="card-header">OUTRAS MARCAS</div>
                <div class="container-fluid my-3">

                    <li class="list-group-item">
                        Outros
                        <div class="material-switch float-right">
                            <input id="someSwitchOptionPrimaryo1" name="outros"  type="checkbox"/>
                            <label for="someSwitchOptionPrimaryo1" class="bg-success"></label>
                        </div>
                    </li>


                </div>

            </div>
        </div>

        <div class="col">

        <div class="form-group">
            <label for="inputState" class="col-form-label">Merchandising</label>
            <select id="inputState" class="form-control r-30" name="merchan">
                <option>Bom</option>
                <option>Regular</option>
                <option>Ruim</option>
            </select>
        </div>

        </div>


        <div class="col">

            <div class="form-group">
                <label for="inputState2" class="col-form-label">Checkout</label>
                <select id="inputState2" class="form-control r-30" name="checkout">
                    <option>Bom</option>
                    <option>Regular</option>
                    <option>Ruim</option>
                </select>
            </div>

        </div>


        <div class="col">

            <div class="form-group">
                <label for="exampleFormControlTextarea2">Observações</label>
                <textarea class="form-control r-0" id="exampleFormControlTextarea2"
                          rows="3" name="obs"></textarea>
            </div>

        </div>


        <div class="col" style="text-align: center">
        <input type="submit" name="salvar" class="btn btn-success btn-lg btn-block" style="margin:auto; width: 180px" value="Salvar">
        
        </form>
         <br>

       </div>

    </div>


<?php

require_once "footer.php"; ?>