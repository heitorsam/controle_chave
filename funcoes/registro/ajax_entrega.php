<h11><i class="fa-solid fa-key efeito-zoom"></i> Retirada</h11>
<div class="div_br"></div>    

<div class="row">

    <div class="col-sm-3">
        Chave:
        <input id="cd_chave" class="form form-control" type="number">
    </div>

</div>

<div class="div_br"></div>

<div id="carrega_entrega_chave"></div>

<script>

    var inpt_chave = document.getElementById('cd_chave');

    var cd_chave = inpt_chave.value;

    inpt_chave.addEventListener('change', function() {

        var cracha = document.getElementById('inpt_cracha');
        
        var acao_entrega = document.getElementById('carrega_entrega_chave');
        acao_entrega.innerText = '';

        var cd_chave = inpt_chave.value;

        $.post('funcoes/registro/valida_chave.php', { idchave: cd_chave }, function(chave) {

            if (chave == 'Sucesso') {
                
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
                    $.get('funcoes/registro/ajax_entrega_informacoes.php?dschave=' + ds_chave + '&dscategoria=' + ds_categoria + '&cracha=' + cracha.value, function(data) {
        
                        document.getElementById('carrega_entrega_chave').innerHTML = data;
    
                        // PREENCHE OS SETORES DO MV NO SELECT
                        $('#selecao_setores').load('funcoes/registro/query_setores.php?cracha=' + cracha.value);
        
                    });
        
                })

            } else if (chave == 'Chave em uso') {

                //MENSAGEM            
                var_ds_msg = 'Chave%20já%20está%20em%20uso.';
                var_tp_msg = 'alert-danger';

                $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

            } else if (chave == 'Não cadastrada') {

                //MENSAGEM            
                var_ds_msg = 'Chave%20inexistente.';
                var_tp_msg = 'alert-danger';

                $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

            } else if (chave == 'Chave inativa') {
            
                //MENSAGEM            
                var_ds_msg = 'Chave%20inativa%20no%20sistema.';
                var_tp_msg = 'alert-danger';

                $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);


            } else {

                console.log(chave)

                //MENSAGEM            
                var_ds_msg = 'Erro%20ao%20buscar%20chave.';
                var_tp_msg = 'alert-danger';

                $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

            }

        })

    })

    function registrar_entrega() {

        var setor = document.getElementById('selecao_setores');
        var ramal = document.getElementById('inpt_ramal');
        var contato = document.getElementById('inpt_contato');
        var observacao = document.getElementById('inpt_observacao');
        var cracha = document.getElementById('inpt_cracha');

        if (contato.value == '') {

            //MENSAGEM            
            var_ds_msg = 'Necessário%20preenchimento%20dos%20campos.';
            var_tp_msg = 'alert-danger';
    
            $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

            contato.focus();

        } else {

            $.ajax({
                url: "funcoes/registro/insert_registro_entrega.php",
                method: "POST",
                data: {
                    setor: setor.value,
                    ramal: ramal.value,
                    contato: contato.value,
                    observacao: observacao.value,
                    cd_chave: inpt_chave.value,
                    cracha: cracha.value
                },
                cache: false,
                success(res) {
    
                    if (res == 'Sucesso') {
    
                        ramal.value = '';
                        contato.value = '';
                        observacao.value = '';
    
                        //MENSAGEM            
                        var_ds_msg = 'Retirada%20registrado%20com%20sucesso.';
                        var_tp_msg = 'alert-success';
    
                        $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
    
                        setTimeout(() => {
                            
                            window.location.href = "home.php";
    
                        }, 4000);
    
                    } else {
    
                        console.log(res)
    
                        //MENSAGEM            
                        var_ds_msg = 'Erro%20ao%20registrar%20retirada.';
                        var_tp_msg = 'alert-danger';
    
                        $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
    
                    }
    
                }
            })

        }

    }

</script>