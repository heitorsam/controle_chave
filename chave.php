<?php

    include 'cabecalho.php';

    include 'config/mensagem/ajax_mensagem_alert.php';

?>

    <div id="mensagem_acao"></div>

    <h11><i class="fa-solid fa-key"></i> Chave</h11>
        <div class='espaco_pequeno'></div>
    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

    <div class="div_br"></div>

    <div class="row">
   
        <div class="col-md-3">
            Descrição:
            <input id="descricao" class="form form-control">
        </div>

        <div class="col-md-3">
            Categoria:
            <select id="carrega_categorias" class="form form-control" name="" id="">
                
            </select>
        </div>

        <div class="col-md-1 mt-4">
            <a onclick="cadastra_chave()" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
        </div>

    </div>

    <div class="div_br"></div>
    <div class="div_br"></div>

    <div id="carreta_tabela_chave"></div>

<?php

    include 'rodape.php';

?>

<script>

    window.onload = function() {

        $('#carreta_tabela_chave').load('funcoes/chave/ajax_tabela_chave.php');
        $('#carrega_categorias').load('funcoes/categoria/ajax_carrega_categoria_options.php');

    }

    function cadastra_chave() {

        var descricao = document.getElementById('descricao');
        var categoria = document.getElementById('carrega_categorias');

        if (descricao.value == '') {

            descricao.focus();

            //MENSAGEM            
            var_ds_msg = 'Campo%20descrição%20não%20pode%20estar%20vazio.';
            var_tp_msg = 'alert-danger';

            $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

        } else if (categoria.value == '') {

            categoria.focus();

            //MENSAGEM            
            var_ds_msg = 'Campo%20categoria%20não%20pode%20estar%20vazio.';
            var_tp_msg = 'alert-danger';

            $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

        } else {

            $.ajax({
                url: "funcoes/chave/insert_chave.php",
                method: "POST",
                data: {
                    descricao: descricao.value,
                    cd_categoria: categoria.value
                },
                cache: false,
                success(res) {

                    if (res == 'Sucesso') {

                        $('#carreta_tabela_chave').load('funcoes/chave/ajax_tabela_chave.php');

                        //MENSAGEM            
                        var_ds_msg = 'Chave%20cadastrada%20com%20sucesso.';
                        var_tp_msg = 'alert-success';

                    } else {

                        console.log(res);

                        //MENSAGEM            
                        var_ds_msg = 'Erro%20ao%20cadastrar%20chave.';
                        var_tp_msg = 'alert-danger';

                    }

                    $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                }
            })

        }

    }

    function chama_alerta(cd_chave, tp_acao, status_atual=0) {

        if (tp_acao == 'del') {

            //ajax_alert('Deseja excluir chave?', 'exclui_chave('+cd_chave+')');

        } else if (tp_acao == 'stt') {

            var mensagem = 'Deseja inativar o status da chave?';

            if (status_atual == 'I') {

                mensagem = 'Deseja ativar o status da chave?';

            }

            ajax_alert(mensagem, 'alterar_status_chave('+cd_chave+',\''+status_atual+'\')'); 

        }

    }

    function alterar_status_chave(cd_chave, status_atual) {

        $.ajax({
            url: "funcoes/chave/update_altera_status_chave.php",
            method: "POST",
            data: {
                cd_chave,
                status_atual
            },
            cache: false,
            success(res) {

                if (res == 'Sucesso') {



                } else {



                }

            }
        })

    }

</script>