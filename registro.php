<?php

    include 'cabecalho.php';

?>

<div id="mensagem_acao"></div>

<h11><i class="fa-solid fa-address-card"></i> Registro</h11>
        <div class='espaco_pequeno'></div>
    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

    <div class="div_br"></div>

    <div class="row">

        <div class="col-sm-3">

            Crachá:
            <input id="inpt_cracha" type="number" class="form form-control">

        </div>

    </div>

    <div class="div_br"></div>

    <div id="carrega_acao_registro"></div>
    
<?php

    include 'rodape.php';

?>

<script>

    window.onload = function() {

        var cracha = document.getElementById('inpt_cracha');

        // CRIA EVENTO DE CHANGE PARA INSERIR O CRACHÁ
        cracha.addEventListener('change', function() {

            $.ajax({
                url: "funcoes/registro/valida_registro.php",
                method: "GET",
                data: {
                    cracha: cracha.value
                },
                cache: false,
                success(res) {

                    if (res != 'S' && res != 'N') {

                        console.log(res);

                        //MENSAGEM            
                        var_ds_msg = 'Erro%20buscar%20usuário.';
                        var_tp_msg = 'alert-danger';

                        $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                    } else {

                        if (res == 'S') {

                            $.post( "funcoes/registro/busca_registros_cracha.php?cracha=" + cracha.value, function( data ) {

                                var dados = JSON.parse(data);

                                var ds_chave = dados['DS_CHAVE'].replace(' ', '%20');
                                var ds_categoria = dados['DS_CATEGORIA'].replace(' ', '%20');
                                
                                $('#carrega_acao_registro').load('funcoes/registro/devolucao.php?chave=' + ds_chave + '&categoria=' + ds_categoria);

                            });                            

                        } else {

                            $('#carrega_acao_registro').load('funcoes/registro/entrega.php');
                    
                        }
                        
                    }

                }
            })

        })

    }

</script>