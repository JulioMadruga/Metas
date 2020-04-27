<?php require_once 'header.php'; ?>

<div class="page has-sidebar-left">
    <header class="my-3">
        <div class="container-fluid" style="margin-top: 80px;">
            <div class="row">
                <div class="col">
                    <h1 class="s-24">
                        <i class="icon-users"></i>
                        Cadastro <span class="s-14">de Clientes</span>
                    </h1>
                </div>
            </div>
        </div>
    </header>


    <div id="cad" style="position: absolute" class="container-fluid my-3">
        <form  class="form-material"  method="post" action="cadastro2.php?rca=<?= $rca ?>">
            <!-- Input -->
            <div class="body">

                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Razão:</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="razao" placeholder="Razão Social do Cliente" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>CNPJ:</label>
                            <div class="form-line">
                                <input maxlength="18" type="text" class="form-control" name="cnpj" placeholder="XX.XXX.XXX/XXXX-XX" pattern=".{0}|.{14,}"   required title="O CNPJ TEM NO MINIMO 14 CARACTERES">
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Email:</label>
                            <div class="form-line">
                                <input type="email" class="form-control" name="email" placeholder="email@email.com.br" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Canal</label>
                            <div class="form-line">
                                <select class="form-control" name="canal" required>
                                <option></option>
                                <option>As 5+</option>
                                <option>As 3 a 4</option>
                                <option>As 1 a 2</option>
                                <option>Atacado</option>
                                <option>Conveniência</option>
                                <option>Tradicional</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Nome do Contato:</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="contato" placeholder="Contato no cliente" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Fone:</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="fone" placeholder="Fone do contato" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form">
                                <button type="submit" style="width: 150px;" class="btn-lg btn-success">Enviar</button>
                                <button id="solicitar" style="display: none" class="btn-lg btn-info"><i class="s-19 icon icon-search "></i> Consular Solicitações</button>

                            </div>


                        </div>


                    </div>
                </div>
            </div>
        </form>


    </div>






    <div id="cli" style="display: none; position: absolute; top: 1900px;" class="container-fluid my-3">

        <?php
        if(isset($_GET['result'])) {

            $solicitacao = new CadCli();
            $solicitacao = $solicitacao->Cad_all($rca);

           // var_dump($solicitacao);


        }
        ?>

    <div class="card">
        <!--            <div class="card-header dark-blue text-white s-18" style="text-align: center; padding: 20px; margin-bottom: 5px">-->
        <!--                <strong> CHECK LIST REALIZADOS - --><?//= strtoupper($usuario) ?><!-- </strong>-->
        <!--            </div>-->
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">

                <?php foreach($solicitacao as $value): ?>

                    <?php if($value->estado == "Aprovado"): ?>

                    <li class="list-group-item" style=" display: grid; grid-template-columns: 1fr 6fr 1fr; align-content: center; padding: 10px; height:80px; background:#d6ecbd; border: solid 1px #f5f8fa">

                        <div style="grid-column: 1; width: 52px "><img style="width: 80px" src="assets/img/pdv.png"/></div>
                        <div style="grid-column: 2"><strong class="font-weight-bold"> Cod.: <?= $value->cnpj ?></strong><br><strong> <?= $value->razao ?></strong></div>
                        <div style="grid-column: 3; font-size: 9px"><i class="s-36 icon icon-check green-text" style="float: right"></i><?= $value->estado ?> </div>

                    </li>

                     <?php elseif ($value->estado == "Pendente"): ?>

                    <li class="list-group-item" style=" display: grid; grid-template-columns: 1fr 6fr 1fr; align-content: center; padding: 10px; height:80px; background:#c4cdd2; border: solid 1px #f5f8fa">

                        <div style="grid-column: 1; width: 52px "><img style="width: 80px" src="assets/img/pdv.png"/></div>
                        <div style="grid-column: 2"><strong class="font-weight-bold"> Cod.: <?= $value->cnpj ?></strong><br><strong> <?= $value->razao ?></strong></div>
                        <div style="grid-column: 3; font-size: 9px"><i class="s-36 icon icon-edit blue-grey-text" style="float: right"></i><?= $value->estado ?> </div>

                    </li>


                    <?php else: ?>

                        <li class="list-group-item" style=" display: grid; grid-template-columns: 1fr 6fr 1fr; align-content: center; padding: 10px; height:80px; background:#ffd1cc; border: solid 1px #f5f8fa">

                            <div style="grid-column: 1; width: 52px "><img style="width: 80px" src="assets/img/pdv.png"/></div>
                            <div style="grid-column: 2"><strong class="font-weight-bold"> Cod.: <?= $value->cnpj ?></strong><br><strong> <?= $value->razao ?></strong></div>
                            <div style="grid-column: 3; font-size: 9px"><i class="s-36 icon icon-remove red-text" style="float: right"></i><?= $value->estado ?> </div>

                        </li>





                    <?php endif;?>

                <?php endforeach; ?>


            </ul>
        </div>

        <div id="voltar" style=" cursor: pointer; position: fixed;  width: 65px; top: 63px;right: 1px;">

            <img src="images/voltar2.png"></div>

       </div>



    </div>







<?php
    if(isset($_GET['result'])){

    if ($_GET['result'] == 'ok'){



    echo "<script>window.setTimeout(function(){
        document.getElementById('btnexcluido').click();
    }, 100);
    $('#solicitar').show()
    </script>";

    echo'<button id="btnexcluido" style="display: none" class="btn btn-success btn-lg toast-action"
                 data-title="Tudo Certo '.$usuario .'!"
                 data-message="Solicitação de cadastro Enviado!."
                 data-type="success"
                 data-position-class="toast-bottom-right"
>Success Toast
</button>
   
';



    }

    }
?>



<?php require_once 'footer.php'?>