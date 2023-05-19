<?php

    include 'cabecalho.php';

?>
    <div id="mensagem_acao"></div>

    <h11><i class="fa-solid fa-folder-tree"></i> Categoria</h11>
        <div class='espaco_pequeno'></div>
    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

    <div class="div_br"></div>

    <div class="row">
   
        <div class="col-md-3 col-6" style="background-color: rgba(1,1,1,0) !important; 
        padding-top: 0px !important; padding-bottom: 0px !important;">

            Categoria:
            <div class="input-group mb-3">
                <input id="input_categoria" class="form form-control" type="text">
                <div onclick="cadastrar_categoria()" class="input-group-append">
                    <a class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
                </div>
            </div>

        </div>

    </div>

    <div class="div_br"></div>

    <div id="carrega_tabela_categoria"></div>

<?php

    include 'rodape.php';

?>

<script>

    window.onload = function() {

        $('#carrega_tabela_categoria').load('funcoes/categoria/ajax_tabela_categoria.php');

    }

    function cadastrar_categoria() {

        var input_categoria = document.getElementById('input_categoria');

        if (input_categoria.value == '') {

            input_categoria.focus();

            //MENSAGEM            
            var_ds_msg = 'Campo%20não%20pode%20estar%20vazio.';
            var_tp_msg = 'alert-danger';
    
            $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

        } else {

            $.ajax({
                url: "funcoes/categoria/insert_categoria.php",
                method: "POST",
                data: {
                    ds_categoria: input_categoria.value
                },
                cache: false,
                success(res) {
    
                    if (res == "Sucesso") {

                        $('#carrega_tabela_categoria').load('funcoes/categoria/ajax_tabela_categoria.php');

                        //MENSAGEM            
                        var_ds_msg = 'Categoria%20cadastrada%20com%20sucesso.';
                        var_tp_msg = 'alert-success';
    
                    } else {
    
                        //MENSAGEM            
                        var_ds_msg = 'Erro%20ao%20inserir%20categoria.';
                        var_tp_msg = 'alert-danger';
    
                    }

                    $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
    
                }
            })

        }

        input_categoria.value = "";

    }

    function chama_alerta(cd_categoria, tp_acao, status_atual=0) {

        if (tp_acao == 'del') {

            ajax_alert('Deseja excluir categoria?', 'exclui_categoria('+cd_categoria+')');

        } else if (tp_acao == 'stt') {

            var mensagem = 'Deseja inativar o status da categoria?';

            if (status_atual == 'I') {

                mensagem = 'Deseja ativar o status da categoria?';

            }

            ajax_alert(mensagem, 'alterar_status_categoria('+cd_categoria+',\''+status_atual+'\')'); 

        }

    }

    function exclui_categoria(cd_categoria) {

        $.ajax({
            url: "funcoes/categoria/excluir_categoria.php",
            method: "POST",
            data: {
                cd_categoria
            },
            cache: false,
            success(res) {

                if (res == 'Sucesso') {

                    $('#carrega_tabela_categoria').load('funcoes/categoria/ajax_tabela_categoria.php');

                    //MENSAGEM            
                    var_ds_msg = 'Categoria%20excluído%20com%20sucesso.';
                    var_tp_msg = 'alert-success';

                } else {

                    console.log(res);

                    //MENSAGEM            
                    var_ds_msg = 'Erro%20ao%20excluir%20categoria.';
                    var_tp_msg = 'alert-danger';

                }

                $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

            }
        })

    }

    function editar_categoria(cd_categoria, ds_categoria) {

        // PEGA O TD PELO ID
        td_categoria = document.getElementById(cd_categoria);

        td_categoria.innerText = '';

        // CRIA UM NOVO ELEMENTO INPUT
        var titulo = document.createElement('input');

        titulo.value = ds_categoria;

        titulo.className = 'form form-control';

        // ADICIONA INPUT NO <td>
        td_categoria.appendChild(titulo);

        titulo.focus()

        // APÓS TIRAR O FOCO DO ELEMENTO, PROSSEGUE PARA EDIÇÃO
        titulo.addEventListener('blur', function() {   

            if (ds_categoria != titulo.value) {

                $.ajax({
                    url: "funcoes/categoria/update_categoria.php",
                    method: "POST",
                    data: {
                        nova_ds_categoria: titulo.value,
                        cd_categoria: cd_categoria
                    },
                    cache: false,
                    success(res) {
    
                        if (res == 'Sucesso') {
    
                            $('#carrega_tabela_categoria').load('funcoes/categoria/ajax_tabela_categoria.php');
    
                            //MENSAGEM            
                            var_ds_msg = 'Categoria%20alterado%20com%20sucesso.';
                            var_tp_msg = 'alert-success';
    
                        } else {

                            console.log(res);
    
                            //MENSAGEM            
                            var_ds_msg = 'Erro%20ao%20editar%20categoria.';
                            var_tp_msg = 'alert-danger';

                            // REMOVE O ELEMENTO INPUT E VOLTA O ANTIGO TEXT
                            td_categoria.removeChild(titulo);
                            td_categoria.innerText = ds_categoria;
    
                        }
    
                        $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
    
                    }
                })

            } else {

                // REMOVE O ELEMENTO INPUT E VOLTA O ANTIGO TEXT
                td_categoria.removeChild(titulo);
                td_categoria.innerText = ds_categoria;

            }

        })

    }

    function alterar_status_categoria(cd_categoria, status_alterar) {

        var toggle_status = 'A';

        if (status_alterar == 'I') {

            toggle_status = 'A'

        } else {

            toggle_status = 'I'

        }

        $.ajax({
            url: "funcoes/categoria/update_altera_status.php",
            method: "POST",
            data: {
                cd_categoria,
                status_alterar: toggle_status
            },
            cache: false,
            success(res) {

                if (res == 'Sucesso') {

                    $('#carrega_tabela_categoria').load('funcoes/categoria/ajax_tabela_categoria.php');

                    //MENSAGEM            
                    var_ds_msg = 'Status%20alterado%20com%20sucesso.';
                    var_tp_msg = 'alert-success';

                } else {

                    console.log(res);

                    //MENSAGEM            
                    var_ds_msg = 'Erro%20ao%20alterar%20status.';
                    var_tp_msg = 'alert-danger';

                }

                $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

            }
        })

    }
    
</script>