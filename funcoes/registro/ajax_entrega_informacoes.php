<?php

    $ds_chave = $_GET['dschave'];
    $ds_categoria = $_GET['dscategoria'];

?>

<div class="div_br"></div>

<div class="row">

    <div class="col-md-6 col-sm-12">
        <input value="<?php echo $ds_chave; ?>" class="form form-control" type="text" readonly>
    </div>

    <div class="col-md-6 col-sm-12">
        <input value="<?php echo $ds_categoria; ?>" class="form form-control" type="text" readonly>
    </div>

</div>

<div class="div_br"></div>

<div class="row">

    <div class="col-md-4">
        Setor:
        <select class="form form-control" name="" id="selecao_setores">

        </select>
    </div>

    <div class="col-md-2">
        Ramal:
        <input class="form form-control" type="text" id="inpt_ramal">
    </div>

    <div class="col-md-6">
        Contato:
        <input class="form form-control" type="text" id="inpt_contato">
    </div>

</div>

<div class="div_br"></div>

<div class="row">

    <div class="col-md-12">
        Observação:
        <input class="form form-control" type="text" id="inpt_observacao">
    </div>

</div>

<div class="div_br"></div>

<div style="width: 100%;">

    <button onclick="registrar_entrega()" id="btn_concluir_registro" style="float: right;" class="botao_home">Concluir</button>

</div>