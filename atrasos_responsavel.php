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

        <div>

            <select onchange="aplicar_filtro_categoria()" class="form form-control" id="carrega_categorias">

            </select>

        </div>

        <div class="col-md-4">
            <a onclick="gera_excel()" class="btn btn-primary"><i class="fa-solid fa-file-excel"></i></a>
        </div>
        
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

        $('#carrega_tabela_atrasos').load('funcoes/relatorios/ajax_atrasos_responsavel.php?mes=all' + '&cdcategoria=' + 1);
        $('#carrega_categorias').load('funcoes/categoria/ajax_carrega_categoria_options.php')

    }

    function aplicar_filtro_mes() {

        var filtro_mes = document.getElementById('filtro_mes').value;

        sessionStorage.setItem('filtro_mes_rel', filtro_mes);

        var filtro_categoria = sessionStorage.getItem('filtro_categoria_rel');

        $('#carrega_tabela_atrasos').load('funcoes/relatorios/ajax_atrasos_responsavel.php?mes=' + filtro_mes + '&cdcategoria=' + filtro_categoria);

    }

    function aplicar_filtro_categoria() {

        var cdcategoria = document.getElementById('carrega_categorias').value;

        sessionStorage.setItem('filtro_categoria_rel', cdcategoria);

        var filtro_mes_rel = sessionStorage.getItem('filtro_mes_rel');

        $('#carrega_tabela_atrasos').load('funcoes/relatorios/ajax_atrasos_responsavel.php?mes=' + filtro_mes_rel + '&cdcategoria=' + cdcategoria);

    }

    function gera_excel() {

        var filtro_mes_rel = sessionStorage.getItem('filtro_mes_rel');
        var filtro_categoria = sessionStorage.getItem('filtro_categoria_rel');

        window.location.href = 'funcoes/relatorios/excel/gera_excel_atrasos_responsavel.php?cdcategoria=' + filtro_categoria + '&mes=' + filtro_mes_rel;

    }
    
</script>