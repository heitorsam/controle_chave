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
            var ds_chave = dados['DS_CHAVE'];
            var ds_categoria = dados['DS_CATEGORIA'];

            if (ds_chave.indexOf(' ') != -1) {

                ds_chave = ds_chave.replace(' ', '%20');

            }

            if (ds_categoria.indexOf(' ') != -1) {
            
                ds_categoria = ds_categoria.replace(' ', '%20');

            }

            // CHAMAR AJAX ENTREGA
            $.get('funcoes/registro/ajax_entrega_informacoes.php?dschave=' + ds_chave + '&dscategoria=' + ds_categoria, function(data) {

                document.getElementById('carrega_entrega_chave').innerHTML = data;

                // PREENCHE OS SETORES DO MV NO SELECT
                $('#selecao_setores').load('funcoes/registro/query_setores.php');

            });

        })

    })

    function registrar_entrega() {

        var setor = document.getElementById('selecao_setores');
        var ramal = document.getElementById('inpt_ramal');
        var contato = document.getElementById('inpt_contato');
        var observacao = document.getElementById('inpt_observacao');

        alert(ramal.value);

    }

</script>