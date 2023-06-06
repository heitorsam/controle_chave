<?php

    $chave = $_GET['chave'];
    $categoria = $_GET['categoria'];
    $cd_chave = $_GET['cdchave']

?>

<h11>Devolução</h11>
<div class="div_br"></div>    

<div>

    <div class="row">

        <div class="col-md-2">
            Código chave:
            <input id="cd_chave_bipada" class="form form-control" type="number">
        </div>
    
        <div class="col-md-5">
            Chave:
            <input value="<?php echo $chave; ?>" class="form form-control" type="text" readonly>
        </div>
    
        <div class="col-md-5">
            Categoria:
            <input value="<?php echo $categoria; ?>" class="form form-control" type="text" readonly>
        </div>

    </div>

    <div class="div_br"></div>

    <div class="row">

        <div class="col-md-12">

            Observação:
            <input id="inpt_observacao" class="form form-control" type="text">

        </div>

    </div>

    <div class="div_br"></div>

    <button onclick="registrar_devolucao()" style="float: right;" class="botao_home"><i class="fa-solid fa-arrow-right-from-bracket"></i> Devolver</button>

</div>

<script>

    function registrar_devolucao() {

        var cd_chave = document.getElementById('cd_chave_bipada');
        var cracha = document.getElementById('inpt_cracha');
        var observacao = document.getElementById('inpt_observacao');

        if (cd_chave.value == '') {

            cd_chave.focus();

            //MENSAGEM            
            var_ds_msg = 'Necessário%20preencher%20código%20da%20chave.';
            var_tp_msg = 'alert-danger';
        
            $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

        } else {

            $.post('funcoes/registro/valida_mesma_chave.php', { cd_chave: cd_chave.value, cracha: cracha.value}, function(resp) {
               
                var res = JSON.parse(resp);
        
                if (res['MESMA_CHAVE'] == 'S') {

                    $.ajax({
                        url: "funcoes/registro/realiza_devolucao.php",
                        method: "POST",
                        data: {
                            cd_chave: cd_chave.value,
                            observacao: observacao.value
                        },
                        cache: false,
                        success(respo) {

                            if (respo == 'Sucesso') {

                                //MENSAGEM            
                                var_ds_msg = 'Devolução%20realizada%20com%20sucesso.';
                                var_tp_msg = 'alert-success';

                                $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);
                                
                                cd_chave.value = '';
                                cracha = '';
                                observacao.value = '';

                                setTimeout(() => {

                                    window.location.href = "registro.php";

                                }, 3000)

                            } else {

                                //MENSAGEM            
                                var_ds_msg = 'Erro%20ao%20realizar%20devolução.';
                                var_tp_msg = 'alert-danger';

                                $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                            }

                            

                        }

                    })

                } else {

                    //MENSAGEM            
                    var_ds_msg = 'Chave%20diferente%20da%20registrada.';
                    var_tp_msg = 'alert-danger';

                    $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg='+var_ds_msg+'&tp_msg='+var_tp_msg);

                } 

            })

        }

    }

</script>