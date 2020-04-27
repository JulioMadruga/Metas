<?php require_once "header.php";?>

<?php

$marca = ['MENTOS','MARILAN','CASAREDO','PEPSICO','BATAVO','RICHS','SANTA AMÁLIA','YASAÍ','BEM BRASIL','FRIMESA','FLEISCHMAN'];


?>

<div class="page has-sidebar-left">
    <header class="my-3">
        <div class="container-fluid" style="margin-top: 70px;">
            <div class="row">
                <div class="col">
                    <h1 class="s-24">
                        <i class="icon-analytics"></i>
                        Disnorte <span class="s-14">Análise de Mercado</span>
                    </h1>
                </div>
            </div>
        </div>
    </header>

    <form name="garoto" method="post" action="caddisnorte.php?id=<?= $id_user ?>">
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

            <div class="form-group">
                <label for="inputState" class="col-form-label">Canal do Cliente</label>
                <select id="inputState" class="form-control r-30" name="canal">
                    <option value="comv">Conveniência</option>
                    <option value="trad">Tradicional</option>
                    <option value="as12">1 a 2 Checkout</option>
                    <option value="as34">3 a 4 Checkout</option>
                    <option value="as5+">5+ Checkout </option>
                </select>
            </div>

        </div>

        <?php  foreach ($marca as $itens): ?>

        <div class="col">
        <div class="card bg-light mb-3">
            <div style="background: #657aab; color: aliceblue; text-align: center" class="card-header s-24"><?=$itens?></div>
            <div class="container-fluid my-3">

                <li class="list-group-item">
                    Expositores
                    <div class="material-switch float-right">
                        <input id="someSwitchOptionPrimary1<?php echo substr($itens,0,2) ?>" name="<?php echo substr($itens,0,2) ?>expositor"  type="checkbox"/>
                        <label for="someSwitchOptionPrimary1<?php echo substr($itens,0,2) ?>" class="bg-success"></label>
                    </div>
                </li>
                <li class="list-group-item">
                    Cartaz
                    <div class="material-switch float-right">
                        <input id="someSwitchOptionPrimary2<?php echo substr($itens,0,2) ?>" name="<?php echo substr($itens,0,2) ?>cartaz"  type="checkbox"/>
                        <label for="someSwitchOptionPrimary2<?php echo substr($itens,0,2) ?>" class="bg-success"></label>
                    </div>
                </li>
                <li class="list-group-item">
                    Presença no cliente
                    <div class="material-switch float-right">
                        <input id="someSwitchOptionPrimary3<?php echo substr($itens,0,2) ?>" name="<?php echo substr($itens,0,2) ?>posit"  type="checkbox"/>
                        <label for="someSwitchOptionPrimary3<?php echo substr($itens,0,2) ?>" class="bg-success"></label>
                    </div>
                </li>

                <label for="inputState" class="col-form-label">Atendimento</label>
                <select id="inputState" class="form-control r-30" name="<?php echo substr($itens,0,2) ?>canal">
                    <option value="D">Disnorte</option>
                    <option value="A">Atacado</option>
                    <option value="C">Disnorte+Atacado</option>
                </select>

                <hr>

                <div class="form-group">

                <input id="QtItens"  class="form-control r-30" type="number" name="<?php echo substr($itens,0,2) ?>QtItens" placeholder="Quantidade de Itens">

                </div>

            </div>

        </div>
    </div>

<?php endforeach; ?>

        <div class="col">
        <div class="card bg-light mb-3">
        <div style="background: #8fb57a; color: aliceblue; text-align: center" class="card-header s-24">Avaliação</div>

         <div class="container-fluid my-3">

             <li class="list-group-item">
                 1 - O roteiro está atualizado?
                 <div class="material-switch float-right">
                     <input id="someSwitchOptionPrimary100" name="um"  type="checkbox"/>
                     <label for="someSwitchOptionPrimary100" class="bg-success"></label>
                 </div>
             </li>
             <li class="list-group-item">
                 2 - O Vendedor é conhecido 
                 <br>no PDV?
                 <div class="material-switch float-right">
                     <input id="someSwitchOptionPrimary101" name="dois"  type="checkbox"/>
                     <label for="someSwitchOptionPrimary101" class="bg-success"></label>
                 </div>
             </li>
             <li class="list-group-item">
                 3 - O Vendedor está com a
                 <br>Pasta/Catálogo?
                 <div class="material-switch float-right">
                     <input id="someSwitchOptionPrimary102" name="tres"  type="checkbox"/>
                     <label for="someSwitchOptionPrimary102" class="bg-success"></label>
                 </div>
             </li>
             <li class="list-group-item">
                 4 - Apresentação Visual
                 <br>(Uniforme Disnorte)?
                 <div class="material-switch float-right">
                     <input id="someSwitchOptionPrimary103" name="quatro"  type="checkbox"/>
                     <label for="someSwitchOptionPrimary103" class="bg-success"></label>
                 </div>
             </li>
             <li class="list-group-item">
                 5 - Estabelece e documenta objetivos
                 <br>de cada visita?
                 <div class="material-switch float-right">
                     <input id="someSwitchOptionPrimary104" name="cinco"  type="checkbox"/>
                     <label for="someSwitchOptionPrimary104" class="bg-success"></label>
                 </div>
             </li>
             <li class="list-group-item">
                 6 - Identifica oportunidades de
                 <br>adequação do roteiro?
                 <div class="material-switch float-right">
                     <input id="someSwitchOptionPrimary105" name="seis"  type="checkbox"/>
                     <label for="someSwitchOptionPrimary105" class="bg-success"></label>
                 </div>
             </li>
             <li class="list-group-item">
                 7 - Percorre a loja e o estoque
                 <br>identificando os MPDVs?
                 <div class="material-switch float-right">
                     <input id="someSwitchOptionPrimary106" name="sete"  type="checkbox"/>
                     <label for="someSwitchOptionPrimary106" class="bg-success"></label>
                 </div>
             </li>
             <li class="list-group-item">
                 8 - Verifica o material invadido
                 <br>ou sem uso no PDV?
                 <div class="material-switch float-right">
                     <input id="someSwitchOptionPrimary107" name="oito"  type="checkbox"/>
                     <label for="someSwitchOptionPrimary107" class="bg-success"></label>
                 </div>
             </li>
             <li class="list-group-item">
                 9 - Identifica oportunidades de melhoria
                 <br>e aumentos de espaços?
                 <div class="material-switch float-right">
                     <input id="someSwitchOptionPrimary108" name="nove"  type="checkbox"/>
                     <label for="someSwitchOptionPrimary108" class="bg-success"></label>
                 </div>
             </li>
             <li class="list-group-item">
                 10 - Realiza rodízio e providencia
                 <br>as trocas de produtos nos PVs?
                 <div class="material-switch float-right">
                     <input id="someSwitchOptionPrimary109" name="dez"  type="checkbox"/>
                     <label for="someSwitchOptionPrimary109" class="bg-success"></label>
                 </div>
             </li>
             <li class="list-group-item">
                 11 - Orienta o cliente quanto ao
                 <br>mark up praticado?
                 <div class="material-switch float-right">
                     <input id="someSwitchOptionPrimary110" name="onze"  type="checkbox"/>
                     <label for="someSwitchOptionPrimary110" class="bg-success"></label>
                 </div>
             </li>
             <li class="list-group-item">
                 12 - Propõe a  unificação de preços
                 <br>para produtos similares?
                 <div class="material-switch float-right">
                     <input id="someSwitchOptionPrimary111" name="doze"  type="checkbox"/>
                     <label for="someSwitchOptionPrimary111" class="bg-success"></label>
                 </div>
             </li>
             <li class="list-group-item">
                 13 -  Propõe a redução de preço
                 <br>nos produtos data curta?
                 <div class="material-switch float-right">
                     <input id="someSwitchOptionPrimary112" name="treze"  type="checkbox"/>
                     <label for="someSwitchOptionPrimary112" class="bg-success"></label>
                 </div>
             </li>
             <li class="list-group-item">
                 14 - Encerra a visita
                 <br>adequadamente?
                 <div class="material-switch float-right">
                     <input id="someSwitchOptionPrimary113" name="quatorze"  type="checkbox"/>
                     <label for="someSwitchOptionPrimary113" class="bg-success"></label>
                 </div>
             </li>



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