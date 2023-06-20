<?php

    include 'cabecalho.php';
    include 'acesso_restrito_adm.php';

?>

    <h11><i class="fa-solid fa-unlock-keyhole"></i> Atrasos por responsável</h11>
        <div class='espaco_pequeno'></div>
    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

    <div class="div_br"></div>

    <div class="row">

        <div class="col-md-3">

            <input onchange="aplicar_filtro_mes()" id="filtro_mes" type="month" class="form form-control">

        </div>

        <div class="col-md-3">

            <select onchange="aplicar_filtro_categoria()" class="form form-control" id="carrega_categorias">

            </select>

        </div>

        <div class="col-md-3">

            <input onchange="aplicar_filtro_cracha()" id="filtro_colaborador" type="number" class="form form-control" placeholder="Crachá">

        </div>

        <div class="col-md-2">

            <a onclick="gera_excel()" class="btn btn-primary"><i class="fa-solid fa-file-excel"></i></a>

        </div>
        
    </div>

    <div class="div_br"></div>
    <div class="div_br"></div>
    

    <div id="infos_quantidade" style="display: flex; justify-content: center; height: 40px; width: 45%; background-color: #46a5d4; border-radius: 10px; margin: 0 auto; color: white; padding: 8px; font-weight: bold;">

        <label>Quantidade:</label> 

        <div class="espaco_pequeno"></div>
        
        <p style="color: white;" id="resp_qtd"></p>

        <div class="espaco_pequeno"></div>
        <div class="espaco_pequeno"></div>
        <div class="espaco_pequeno"></div>
        <div class="espaco_pequeno"></div>
        <div class="espaco_pequeno"></div>
        
        <label>Total (min):</label> 

        <div class="espaco_pequeno"></div>
        
        <p style="color: white;" id="resp_tempo"></p>
        
    </div>

    <div class="div_br"></div>
    <div class="div_br"></div>

    <div id="carrega_tabela_atrasos"></div>

<?php

    include 'rodape.php';

?>

<script>

    window.onload = function() {

        sessionStorage.setItem('filtro_mes_rel', 'all');
        sessionStorage.setItem('filtro_categoria_rel', 1);
        sessionStorage.setItem('filtro_cracha_rel', 'all');

        verifica_visualizacao_div_contagem()

        $('#carrega_tabela_atrasos').load('funcoes/relatorios/ajax_atrasos_responsavel.php?mes=all' + '&cdcategoria=' + 1 + '&cracha=all');
        $('#carrega_categorias').load('funcoes/categoria/ajax_carrega_categoria_options.php')

    }

    function aplicar_filtro_mes() {

        var filtro_mes = document.getElementById('filtro_mes').value;

        sessionStorage.setItem('filtro_mes_rel', filtro_mes);

        var filtro_categoria = sessionStorage.getItem('filtro_categoria_rel');
        var filtro_cracha = sessionStorage.getItem('filtro_cracha_rel');

        verifica_visualizacao_div_contagem()

        $('#carrega_tabela_atrasos').load('funcoes/relatorios/ajax_atrasos_responsavel.php?mes=' + filtro_mes + '&cdcategoria=' + filtro_categoria + '&cracha=' + filtro_cracha);

    }

    function aplicar_filtro_categoria() {

        var cdcategoria = document.getElementById('carrega_categorias').value;

        sessionStorage.setItem('filtro_categoria_rel', cdcategoria);

        var filtro_mes_rel = sessionStorage.getItem('filtro_mes_rel');
        var filtro_cracha = sessionStorage.getItem('filtro_cracha_rel');

        verifica_visualizacao_div_contagem()

        $('#carrega_tabela_atrasos').load('funcoes/relatorios/ajax_atrasos_responsavel.php?mes=' + filtro_mes_rel + '&cdcategoria=' + cdcategoria + '&cracha=' + filtro_cracha);

    }

    function aplicar_filtro_cracha() {

        var filtro_cracha = document.getElementById('filtro_colaborador').value;

        sessionStorage.setItem('filtro_cracha_rel', filtro_cracha);

        var filtro_categoria = sessionStorage.getItem('filtro_categoria_rel');
        var filtro_mes_rel = sessionStorage.getItem('filtro_mes_rel');

        $('#carrega_tabela_atrasos').load('funcoes/relatorios/ajax_atrasos_responsavel.php?mes=' + filtro_mes_rel + '&cdcategoria=' + filtro_categoria + '&cracha=' + filtro_cracha);
        
        $.ajax({
            url: 'funcoes/relatorios/ajax_contagem_atrasos_responsavel.php',
            method: 'GET',
            data: {
                filtro_cracha,
                filtro_categoria,
                filtro_mes_rel
            },
            cache: false,
            success(res) {

                if (res == 'Erro') {

                    console.log(res);

                    //MENSAGEM            
                    var_ds_msg = 'Erro%20ao%20extrair%20relatório.';
                    var_tp_msg = 'alert-danger';

                    $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);

                } else {

                    var resp = JSON.parse(res)

                    // PEGA OS VALORES CONSOLIDADOS E INSERE NA LABEL ACIMA DA TABELA
                    var label_qtd = document.getElementById('resp_qtd');
                    var label_tempo = document.getElementById('resp_tempo');

                    label_qtd.innerText = resp['QTD_ATRASOS'];
                    label_tempo.innerText = resp['TOT_MIN'];

                    verifica_visualizacao_div_contagem()

                }

            }
        })

    }

    function gera_excel() {

        var filtro_mes_rel = sessionStorage.getItem('filtro_mes_rel');
        var filtro_categoria = sessionStorage.getItem('filtro_categoria_rel');
        var filtro_cracha = sessionStorage.getItem('filtro_cracha_rel');

        window.location.href = 'funcoes/relatorios/excel/gera_excel_atrasos_responsavel.php?cdcategoria=' + filtro_categoria + '&mes=' + filtro_mes_rel + '&cracha=' + filtro_cracha;

    }

    function verifica_visualizacao_div_contagem() {

        var cracha_verificacao = sessionStorage.getItem('filtro_cracha_rel')

        var div_quantidade = document.getElementById('infos_quantidade');

        if (cracha_verificacao == 'all' || cracha_verificacao == '') {

            div_quantidade.style.display = 'none';

        } else {

            div_quantidade.style.display = 'flex';
  

        }

    }
    
</script>