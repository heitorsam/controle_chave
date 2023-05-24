<?php

    $chave = $_GET['chave'];
    $categoria = $_GET['categoria'];
    $cd_chave = $_GET['cdchave']

?>

<h11>Devolução</h11>
<div class="div_br"></div>    

<div style="float: left; width: 60%;">

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

    <button style="float: right;" class="botao_home">Concluir</button>

</div>

<div style="float: right; width: 40%; padding: 20px 0px 0px 150px;">

    <div class="col-sm-12" style="float: left;">
        <div style="width: 150px;" id="qrcode"></div>
    </div>

</div>


<script>

    // PEGA O ESPAÇO DE RENDERIZAR O QR CODE
    var espaco_qrcode = document.getElementById("qrcode");

    // MONTA O QR CODE
    var qrcode = new QRCode(espaco_qrcode, {

        text: `${<?php echo $cd_chave;?>}`,
        width: 200,
        height: 200

    });

</script>