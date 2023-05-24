<?php

    $ds_chave = $_GET['dschave'];
    $ds_categoria = $_GET['dscategoria'];

?>

<div class="div_br"></div>

<div class="row">

    <div class="col-sm-6">
        <input value="<?php echo $ds_chave; ?>" class="form form-control" type="text" readonly>
    </div>

    <div class="col-sm-6">
        <input value="<?php echo $ds_categoria; ?>" class="form form-control" type="text" readonly>
    </div>

</div>

<div class="div_br"></div>

<div class="row">

    <div class="col-sm-4">
        Setor:
        <select class="form form-control" name="" id="">
            <option value="">teste</option>
        </select>
    </div>

    <div class="col-sm-3">
        Ramal:
        <input class="form form-control" type="text">
    </div>

    <div class="col-sm-5">
        Contato:
        <input class="form form-control" type="text">
    </div>

</div>

<div class="div_br"></div>

<div class="row">

    <div class="col-sm-12">
        Observação:
        <input class="form form-control" type="text">
    </div>

</div>
