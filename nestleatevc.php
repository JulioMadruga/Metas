<?php require_once "header.php";?>

<?php
$cod_cli = $_GET['id'];

$cliente = new ClientesBase();

$cliente = $cliente->find_cli($cod_cli);

?>


    <div class="page has-sidebar-left">
            <header class="my-3">
                <div class="container-fluid" style="margin-top: 70px;">
                    <div class="row">
                        <div class="col">
                            <h1 class="s-24">
                                <i class="icon-analytics"></i>
                                Garoto <span class="s-14">Cadastro Nestlé até Vc</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </header>

         <?php foreach($cliente as $value): ?>

                <form name="garoto" action="cadatevc.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data" >
                    <div class="col">

                        <div id="codcli" class="form-group">
                             <label>Cod. Cli</label>
                            <input id="cod_cli"  class="form-control r-30" type="text" name="cod_cli"  value="<?= $value->cod_cli?>" readonly>
                        </div>

                    <div class="form-group">
                         <label>Cliente</label>
                         <input id="autocomplete_cli"  class="form-control r-30" type="text" name="cliente" value="<?= $value->razao?>"  placeholder="Cliente">
                    </div>
                        <div id="vendedor" class="form-group" style="display: none">
                            <label>Vendedor</label>
                            <input id="vend"  class="form-control r-30" type="text" name="vend" value="<?= $value->rca?>"  readonly>
                        </div>
                        <div id="codvend" class="form-group" >
                            <label>Vendedor</label>
                            <input id="cod_vend"  class="form-control r-30" type="text" name="cod_vend" value="<?= $value->nome?>" readonly>
                        </div>

                        <div class="form-group" style="display: none">
                            <label for="inputState" class="col-form-label">Canal do Cliente</label>
                            <input id="canal"  class="form-control r-30" type="text" name="canal" value="<?= $value->cod_canal?>" readonly>
                        </div>



                    </div>


                    <div class="col">
                        <div class="card bg-light mb-3">
                            <div style="background: #ff9800; font-weight: bold; color: aliceblue;" class="card-header">Confirmar Cadastro Nestle Até Vc</div>
                            <div class="container-fluid my-3">

                                <li class="list-group-item">
                                    Confirmar
                                    <div class="material-switch float-right">
                                        <input id="someSwitchOptionPrimaryo1" name="nestleatevc"  type="checkbox"/>
                                        <label for="someSwitchOptionPrimaryo1" class="bg-success"></label>
                                    </div>
                                </li>


                            </div>

                        </div>
                    </div>



                    <div class="col" style="display: flex; align-items: center; justify-content: center;">


                        <div style=" position: relative; color: red;">
                            <img src="assets/camera.png">
                            <input style="position: absolute;
                                          width: 100%;
                                          height: 100%;
                                          top: 0;
                                          left: 0;
                                          opacity: 0;
                                          cursor: pointer;"
                            id="file" type="file" name="img[]" multiple="multiple" accept="image/*" capture="camera">

                        </div>

                    </div>
                    <h3 class="text-center" id="msg">Fotos</h3>
                    <p class="alert-danger" id="uploadMsg "></p>


                    <div class="col" style=" margin-top:10px; text-align: center">
                    <input type="submit" name="salvar" class="btn btn-success btn-lg btn-block" style="margin:auto; width: 180px" value="Salvar">

                    </form>
                 <br>
         <?php endforeach; ?>

       </div>

       </div>

<script>

    let imageUpload = document.getElementById("file");
    let Msg = document.getElementById("msg");
    // display file name if file has been selected
    imageUpload.onchange = function() {
        let input = this.files[0];
        let text;
        if (input) {
            //process input
            text = "Foto carregada";
            console.log("carregou");
            Msg.innerText = text;
            Msg.className = 'alert-success text-center';
        } else {
            text = "Foto não carregou";
            console.log("não");
            Msg.innerText = text;
        Msg.className = 'alert-danger text-center';
        }

    };

</script>


<?php


require_once "footer.php"; ?>