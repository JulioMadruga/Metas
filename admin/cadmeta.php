<?php require_once 'header.php'; ?>
<?php

$coods = new Cood();
$coods = $coods->Cood_all();


if(isset($_GET['cood'])){

    $super = $_GET['cood'];
}


?>

<div class="page has-sidebar-left">
    <header class="my-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="s-24">
                        <i class="icon-pages"></i>
                        Blank <span class="s-14">Get Started</span>
                    </h1>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid my-3">

        <form class="form-material" >

                <div class="form-group">
                    <label for="inputState" class="col-form-label-sm ">Coodenador</label>
                    <select id="cood" class="form-control r-10" name="cood">

                        <?php if($_GET['cood']): ?>

                        <option><?= $_GET['cood'] ?></option>

                        <?php else: ?>

                        <option>Selecione</option>

                        <?php endif; ?>


                        <?php foreach($coods as $value): ?>

                        <option><?= $value->super?></option>

                        <?php endforeach; ?>

                    </select>
                </div>

        </form>


        <form  class="form-material"  method="post" action="cadcampanha.php?mes=<?=$mes?>&cood=<?php if(isset($_GET['cood'])){ echo $super;} ?>">
            <!-- Input -->
            <div class="body">

                <div class="row clearfix">
                    <div class="col-sm-12">

                        <div class="form-group">
                            <label>Sortido:</label>
                            <div class="form-line">
                                <input  type="text" class="form-control" name="sortido"  id="valor" onkeyup="k(this);" required  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Serenata:</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="serenata" id="valor" onkeyup="k(this);" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>baton:</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="baton" id="valor" onkeyup="k(this);" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Biscoito:</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="bisc" id="valor" onkeyup="k(this);" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Talento 25g:</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="talento25" id="valor" onkeyup="k(this);" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Talento 90g:</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="talento90" id="valor" onkeyup="k(this);" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Jumbo:</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="jumbo" id="valor" onkeyup="k(this);" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Patilha:</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="pastilha" id="valor" onkeyup="k(this);" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Chocolate em Pó:</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="po" id="valor" onkeyup="k(this);" required>
                            </div>
                        </div>




                        <div class="form-group">
                            <div class="form">
                                <button type="submit" style="width: 150px;" class="btn-lg btn-success">Cadastrar</button>

                            </div>


                        </div>


                    </div>
                </div>
            </div>
        </form>



    </div>
</div>

<?php
if(isset($_GET['result'])){

    if ($_GET['result'] == 'Cadastrado'){



        echo "<script>window.setTimeout(function(){
        document.getElementById('btnexcluido').click();
    }, 100);
    $('#solicitar').show()
    </script>";

        echo'<button id="btnexcluido" style="display: none" class="btn btn-success btn-lg toast-action"
                 data-title="Tudo Certo '.$usuario .'!"
                 data-message="Meta Cadastrada."
                 data-type="success"
                 data-position-class="toast-bottom-right"
>Success Toast
</button>
   
';



    }

    if ($_GET['result'] == 'Atualizado'){



        echo "<script>window.setTimeout(function(){
        document.getElementById('btnexcluido').click();
    }, 100);
    $('#solicitar').show()
    </script>";

        echo'<button id="btnexcluido" style="display: none" class="btn btn-success btn-lg toast-action"
                 data-title="Tudo Certo '.$usuario .'!"
                 data-message="Meta Atualizada."
                 data-type="success"
                 data-position-class="toast-bottom-right"
>Success Toast
</button>
   
';



    }




}
?>


<?php require_once 'footer.php'?>