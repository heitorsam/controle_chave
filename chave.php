<?php

    include 'cabecalho.php';
    include 'acesso_restrito_adm.php';
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
        <select id="carrega_categorias" class="form form-control">

        </select>
    </div>

    <div class="col-md-1 mt-4">
        <a onclick="cadastra_chave()" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
    </div>    

    <div class="mt-4">
        <i onclick="toggle_filtro()" style="font-size: 28px; cursor: pointer;" class="fa-solid fa-filter"></i>
    </div>

</div>

<div class="div_br"></div>

<div class="row" id="filtros" style="display: none;">

    <div class="col-md-3">

        <select onchange="aplicar_filtro()" id="categorias_filtro" class="form form-control">

        </select>

    </div>

</div>

<div class="div_br"></div>
<div class="div_br"></div>

<div id="carrega_tabela_chave"></div>

<!-- MODAL QR CODE -->
<div class="modal fade" id="modal_qrcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content" id="modal_content">

            <div class="modal-header">

                <h5 class="modal-title" id="titulo_modal">QR Code</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div id="conteudo_modal" class="modal-body">

                <button onclick="ajax_imprime_qr()" style="float: right;" class="mt-4 btn btn-primary"><i class="fa-solid fa-print"></i></button>

                <div class="row">

                    <div class="col-md-12">
                        
                        <div>
                            Tamanho:
                            <input id="inpt_tamanho_code" onkeyup="alterar_tamanhoQRCode()" type="number" class="form form-control" placeholder="3 cm">
                        </div>

                    </div>

                </div>

                <div class="div_br"></div>
                <div class="div_br"></div>
                <div class="div_br"></div>

                <div id="qrcode_container" class="text-center"></div>

            </div>

        </div>

    </div>

</div>

<?php

include 'rodape.php';

?>

<script> 

    // VARIAVEL DE FILTRO PARA CONTROLAR MOSTRAGEM DE FILTROS NA TABELA CHAVE
    var toggle_categoria = false;
    
    //CARREGA PAGINA
    window.onload = function() {

        if (sessionStorage.getItem("categoria") == null) {

            $('#carrega_tabela_chave').load('funcoes/chave/ajax_tabela_chave.php?cdcategoria=all');

        } else {

            var valorRecuperado = sessionStorage.getItem("categoria");
            $('#carrega_tabela_chave').load('funcoes/chave/ajax_tabela_chave.php?cdcategoria=' + valorRecuperado);

        }
 
        $('#carrega_categorias').load('funcoes/categoria/ajax_carrega_categoria_options.php');

    }

    function toggle_filtro() {

        var filtros = document.getElementById('filtros');

        // INVERTE O VALOR DA VARIAVEL DE FILTRO
        toggle_categoria = !toggle_categoria;

        if (toggle_categoria) {

            filtros.style.display = 'block';

            if (sessionStorage.getItem("categoria") == null) {

                $('#categorias_filtro').load('funcoes/filtros/ajax_categorias_filtro.php?cdcategoria=all');

            } else {

                var cd_categoria = sessionStorage.getItem("categoria");
                $('#categorias_filtro').load('funcoes/filtros/ajax_categorias_filtro.php?cdcategoria=' + cd_categoria);

            }

        } else {

            filtros.style.display = 'none';

        }

    }

    function aplicar_filtro() {

        categoria = document.getElementById('categorias_filtro').value;

        var valor = categoria;
        sessionStorage.setItem("categoria", valor);

        var valorRecuperado = sessionStorage.getItem("categoria");

        $('#carrega_tabela_chave').load('funcoes/chave/ajax_tabela_chave.php?cdcategoria=' + valorRecuperado);

    }

    function editar_chave(cd_chave, ds_chave) {

        // PEGA O TD PELO ID
        td_chave = document.getElementById(cd_chave);

        td_chave.innerText = '';

        // CRIA UM NOVO ELEMENTO INPUT
        var titulo = document.createElement('input');

        titulo.value = ds_chave;

        titulo.className = 'form form-control';

        // ADICIONA INPUT NO <td>
        td_chave.appendChild(titulo);

        titulo.focus()

        // APÓS TIRAR O FOCO DO ELEMENTO, PROSSEGUE PARA EDIÇÃO
        titulo.addEventListener('blur', function() {

            if (ds_chave != titulo.value && titulo.value.trim() != '') {

                $.ajax({
                    url: "funcoes/chave/update_chave.php",
                    method: "POST",
                    data: {
                        nova_ds_chave: titulo.value.trim(),
                        cd_chave: cd_chave
                    },
                    cache: false,
                    success(res) {

                        if (res == 'Sucesso') {

                            $('#carrega_tabela_chave').load('funcoes/chave/ajax_tabela_chave.php?cdcategoria=' + valorRecuperado);

                            //MENSAGEM            
                            var_ds_msg = 'Chave%20alterada%20com%20sucesso.';
                            var_tp_msg = 'alert-success';

                        } else {

                            console.log(res);

                            //MENSAGEM            
                            var_ds_msg = 'Erro%20ao%20editar%20chave.';
                            var_tp_msg = 'alert-danger';

                            // REMOVE O ELEMENTO INPUT E VOLTA O ANTIGO TEXT
                            td_chave.removeChild(titulo);
                            td_chave.innerText = ds_categoria;

                        }

                        $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);

                    }
                })

            } else {

                // REMOVE O ELEMENTO INPUT E VOLTA O ANTIGO TEXT
                td_chave.removeChild(titulo);
                td_chave.innerText = ds_chave;

            }

        })

    }

    function modal_qrcode(valor) {

        $('#modal_qrcode').modal('show');

        gerarQRCode(valor);

    }

    function ajax_imprime_qr() {

        var conteudo = document.getElementById('qrcode_container').innerHTML;
        tela_impressao = window.open('about:blank');
        tela_impressao.document.write(conteudo);
        tela_impressao.window.print();
        tela_impressao.window.close();

    }

    function cadastra_chave() {

        var descricao = document.getElementById('descricao');
        var categoria_insert = document.getElementById('carrega_categorias');

        if (descricao.value == '') {

            descricao.focus();

            //MENSAGEM            
            var_ds_msg = 'Campo%20descrição%20não%20pode%20estar%20vazio.';
            var_tp_msg = 'alert-danger';

            $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);

        } else if (categoria_insert.value == '') {

            categoria_insert.focus();

            //MENSAGEM            
            var_ds_msg = 'Campo%20categoria%20não%20pode%20estar%20vazio.';
            var_tp_msg = 'alert-danger';

            $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);

        } else {
            

            $.ajax({
                url: "funcoes/chave/insert_chave.php",
                method: "POST",
                data: {
                    descricao: descricao.value,
                    cd_categoria: categoria_insert.value
                },
                cache: false,
                success(res) {

                    valorRecuperado = sessionStorage.getItem("categoria");

                    if (res == 'Sucesso') {

                        $('#carrega_tabela_chave').load('funcoes/chave/ajax_tabela_chave.php?cdcategoria=' + valorRecuperado);
                        
                        //MENSAGEM            
                        var_ds_msg = 'Chave%20cadastrada%20com%20sucesso.';
                        var_tp_msg = 'alert-success';

                    } else {

                        console.log(res);

                        //MENSAGEM            
                        var_ds_msg = 'Erro%20ao%20cadastrar%20chave.';
                        var_tp_msg = 'alert-danger';

                    }

                    descricao.value = '';

                    $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);

                }
            })

        }

    }

    function chama_alerta(cd_chave, tp_acao, status_atual = 0) {

        if (tp_acao == 'del') {

            ajax_alert('Deseja excluir chave?', 'exclui_chave(' + cd_chave + ')');

        } else if (tp_acao == 'stt') {

            var mensagem = 'Deseja inativar o status da chave?';

            if (status_atual == 'I') {

                mensagem = 'Deseja ativar o status da chave?';

            }

            ajax_alert(mensagem, 'alterar_status_chave(' + cd_chave + ',\'' + status_atual + '\')');

        }

    }

    function alterar_status_chave(cd_chave, status_atual) {

        var toggle_status = 'A';

        if (status_atual == 'I') {

            toggle_status = 'A'

        } else {

            toggle_status = 'I'

        }

        $.ajax({
            url: "funcoes/chave/update_altera_status_chave.php",
            method: "POST",
            data: {
                cd_chave,
                toggle_status
            },
            cache: false,
            success(res) {

                if (res == 'Sucesso') {

                    valorRecuperado = sessionStorage.getItem("categoria");

                    $('#carrega_tabela_chave').load('funcoes/chave/ajax_tabela_chave.php?cdcategoria=' + valorRecuperado);

                    //MENSAGEM            
                    var_ds_msg = 'Status%20alterado%20com%20sucesso.';
                    var_tp_msg = 'alert-success';

                } else {

                    console.log(res);

                    //MENSAGEM            
                    var_ds_msg = 'Erro%20ao%20alterar%20status.';
                    var_tp_msg = 'alert-danger';

                }

                $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);

            }

        })

    }

    function exclui_chave(cd_chave) {

        $.ajax({
            url: "funcoes/chave/excluir_chave.php",
            method: "POST",
            data: {
                cd_chave
            },
            cache: false,
            success(res) {

                valorRecuperado = sessionStorage.getItem("categoria");

                if (res === 'Sucesso') {

                    $('#carrega_tabela_chave').load('funcoes/chave/ajax_tabela_chave.php?cdcategoria=' + valorRecuperado);

                    //MENSAGEM            
                    var_ds_msg = 'Chave%20excluída%20com%20sucesso.';
                    var_tp_msg = 'alert-success';

                } else {

                    console.log(res);

                    //MENSAGEM            
                    var_ds_msg = 'Erro%20ao%20excluir%20chave.';
                    var_tp_msg = 'alert-danger';

                }

                $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);

            }
        })

    }

    function gerarQRCode(valor) {

        localStorage.setItem("code", valor);

        // PEGA O ESPAÇO DE RENDERIZAR O QR CODE
        var espaco_qrcode = document.getElementById("qrcode_container");

        // LIMPA O ESPAÇO CASO JÁ EXISTA PARA RENDERIZAR UM NOVO
        espaco_qrcode.innerHTML = '';

        // MONTA O QR CODE
        var qrcode = new QRCode(espaco_qrcode, {

            text: `${valor}`,
            width: 112,
            height: 112

        });

        var novo_tamanho = 5 * 37.80;
        var proporcao = novo_tamanho / 400;

        var modal_dialog = document.querySelector('.modal-dialog');
        var qrcode_container = document.getElementById("qrcode_container");

        // AJUSTA O TAMANHO DA MODAL PROPORCIONALMENTE
        modal_dialog.style.width = (400 * proporcao) + 'px';
        modal_dialog.style.maxWidth = (850 * proporcao) + 'px';

        // AJUSTA O TAMANHO DO QR CODE PARA CENTRALIZAR
        qrcode_container.style.width = novo_tamanho + 'px';
        qrcode_container.style.height = novo_tamanho + 'px';
        qrcode_container.style.margin = '0 auto';

    }

    function alterar_tamanhoQRCode() {

        var codigo_qr = localStorage.getItem("code");
        var tamanho_cm = document.getElementById('inpt_tamanho_code').value;

        var tamanho_inicial = 400;

        if (tamanho_cm == '' || tamanho_cm <= 0) {

            tamanho_cm = 3;

        } else if (tamanho_cm >= 15) {

            tamanho_cm = 15;

        }

        var novo_tamanho = tamanho_cm * 37.80;
        var proporcao = novo_tamanho / tamanho_inicial;

        var modal_dialog = document.querySelector('.modal-dialog');
        var qrcode_container = document.getElementById("qrcode_container");

        // AJUSTA O TAMANHO DA MODAL PROPORCIONALMENTE
        modal_dialog.style.width = (tamanho_inicial * proporcao) + 'px';
        modal_dialog.style.maxWidth = (850 * proporcao) + 'px';

        // AJUSTA O TAMANHO DO QR CODE PARA CENTRALIZAR
        qrcode_container.style.width = novo_tamanho + 'px';
        qrcode_container.style.height = novo_tamanho + 'px';
        qrcode_container.style.margin = '0 auto';

        // RENDERIZA O QR CODE
        qrcode_container.innerHTML = '';

        var qrcode = new QRCode(qrcode_container, {
            text: `${codigo_qr}`,
            width: novo_tamanho,
            height: novo_tamanho
        });

    }



</script>