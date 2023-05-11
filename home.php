<!--ATUALIZA A PAGINA (SEGUNDOS)-->
<meta http-equiv="refresh" content="60">

<?php 
    //CABECALHO
    include 'cabecalho.php';

    //ACESSO ADM
    //include 'acesso_restrito_adm.php';
?>

    <div class="div_br"> </div>

    <!--MENSAGENS-->
    <?php
        include 'js/mensagens.php';
        include 'js/mensagens_usuario.php';
    ?>

    <h11 style="margin-left: 10px;"><i class="fa-solid fa-magnifying-glass efeito-zoom" aria-hidden="true"></i> Inspeção Sesmt</h11>
    <div class="div_br"> </div>

    <a href="inspecao.php" class="botao_home" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Inspeção</a>
    <span class="espaco_pequeno"></span>

    <a href="realizados.php" class="botao_home" type="submit"><i class="fa-regular fa-square-check"></i> Realizados</a>
    <span class="espaco_pequeno"></span>

    <?php if($_SESSION['SN_USUARIO_ADM'] == 'S'){ ?>

        <a href="ficha.php" class="botao_home_adm" type="submit"><i class="fa-regular fa-clipboard"></i> Ficha</a>
        <span class="espaco_pequeno"></span>

        <a href="local.php" class="botao_home_adm" type="submit"><i class="fa-solid fa-location-dot"></i> Local</a>
        <span class="espaco_pequeno"></span> 
        
    <?php } ?>
    
    <div class="div_br"> </div>
    <div id="dashboard_home"> </div>    
    

<script defer>

    window.onload = function(){

        ajax_lista_local();

    }

    function ajax_lista_local(){

        $('#dashboard_home').load('funcoes/ajax_exibe_dashboard_home.php');

    }

    function ajax_direciona_realizados(js_inspecao,js_ficha_inspecao){

        window.location = "realizados.php?get_inspecao="+js_inspecao+"&get_ficha_inspecao="+js_ficha_inspecao;

    }

    function ajax_direciona_inspecao(){

        window.location = "inspecao.php";

    }


</script>

<?php
    //RODAPE
    include 'rodape.php';
?>
