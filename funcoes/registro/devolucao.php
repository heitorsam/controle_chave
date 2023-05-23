<?php

    $chave = $_GET['chave'];
    $categoria = $_GET['categoria'];
    $cd_chave = $_GET['cdchave']

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

    <div class="col-sm-12" style="width: 100%;">
        <div style="width: 150px; margin: 0 auto;" id="qrcode"></div>
    </div>

</div>

<div class="div_br"></div>

<div class="row">

    <div class="col-sm-12" style="width> 100%;">

        <div style="margin: 0 auto; width: 100px;">
            <button class="btn btn-primary">Concluir</button>
        </div>
        
    </div>

</div>


<script>

    // PEGA O ESPAÇO DE RENDERIZAR O QR CODE
    var espaco_qrcode = document.getElementById("qrcode");

    // MONTA O QR CODE
    var qrcode = new QRCode(espaco_qrcode, {

        text: `${<?php echo $cd_chave;?>}`,
        width: 150,
        height: 150

    });

</script>