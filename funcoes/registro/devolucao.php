<?php

    $chave = $_GET['chave'];
    $categoria = $_GET['categoria'];

?>

<h11>Devolução</h11>
<div class="div_br"></div>    

<div class="row">

    <div class="col-sm-6">
        Chave:
        <input value="<?php echo $chave; ?>" class="form form-control" type="text" readonly>
    </div>

    <div class="col-sm-6">
        Categoria:
        <input value="<?php echo $categoria; ?>" class="form form-control" type="text" readonly>
    </div>

</div>

<div class="div_br"></div>    

<div class="row">

    <div class="col-sm-12">

        Observação:
        <input class="form form-control" type="text">

    </div>

</div>

<div class="div_br"></div>    

<div class="row">

    <div class="col-sm-6">
        QR CODE
    </div>

</div>

<div class="div_br"></div>

<button style="text-align: center;" class="btn btn-primary">Concluir</button>