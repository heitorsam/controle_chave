<h11>Entrega</h11>
<div class="div_br"></div>    

<div class="row">

    <div class="col-sm-3">
        Código chave:
        <input id="cd_chave" class="form form-control" type="text">
    </div>

</div>

<div class="div_br"></div>

<div id="carrega_entrega_chave"></div>

<script>

    var inpt_chave = document.getElementById('cd_chave');

    var cd_chave = inpt_chave.value;

    inpt_chave.addEventListener('change', function() { 

        var cd_chave = inpt_chave.value;
    
        $.post('funcoes/registro/busca_registros_chave.php?idchave=' + cd_chave, function(data) {

            var dados = JSON.parse(data);

            var ds_chave = dados['DS_CHAVE'].replace(' ', '%20');
            var ds_categoria = dados['DS_CATEGORIA'].replace(' ', '%20');

            // CHAMAR AJAX ENTREGA

        })

    })

</script>