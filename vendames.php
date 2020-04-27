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

$venda = new Venda();

$venda->setTabMes($mes);
$venda->setId($rca);

$venda = $venda->all();

$venda2 = new Venda();
$venda2->setTabMes($mes);
$venda2->setId($rca);

$vendTotal = $venda2->total();





?>

<div class="page has-sidebar-left">
    <header class="my-1">
        <div class="container-fluid"  style="margin-top: 35px;">
            <div class="row">
                <div class="col">
                    <h1 class="s-24">
                        <i class="icon-money"></i>
                        Vendas <span class="s-14">do Mês de <?= $mes ?></span>
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

    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <thead class="titulo">
            <tr>
                <th class="linha3">Cod.</th>
                <th class="linha3">Razão</th>
                <th class="linha3">Data</th>
                <th class="linha3">Nota</th>
                <th class="linha3">Valor</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($venda as $value): ?>
            <tr>
                <td class="linha"><?= $value->ID ?></td>
                <td class="linha"><?= $value->Nome_parceiro ?></td>
                <td class="linha"><?= $value->data_doc ?></td>
                <td class="linha"><?= $value->n_nf ?></td>
                <?php if( $value->total>=0):?>
                <td class="linha font-weight-bold">R$ <?= number_format($value->total, 2, ',', '.') ?></td>
                <?php else:?>
                <td class="linha text-red font-weight-bold">R$ <?= number_format($value->total, 2, ',', '.') ?></td>
                <?php endif;?>
            </tr>

            <?php endforeach; ?>

            </tbody>
            <tfoot class="titulo">
            <tr>
                <th class="linha2"></th>
                <th class="linha2">Total:</th>
                <th class="linha2">R$ <?= number_format($vendTotal[0]->total, 2, ',', '.')?></th>
            </tr>
            </tfoot>


        </table>
    </div>
    <!-- /.box-body -->
</div>
    <!-- /.box -->
    </div>
    </div>
    </section>
    </div>
    </div>
    </div>






</div>

<script>
    $('table').on('scroll', function () {
        $("table > *").width($("table").width() + $("table").scrollLeft());
    });
</script>

<?php require_once 'footer.php'?>