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

    <h11 style="margin-left: 10px;"><i class="fa-solid fa-house"></i> Home</h11>
    <div class="div_br"> </div>    

    <a href="registro.php" class="botao_home" type="submit"><i class="fa-solid fa-address-card"></i> Registro</a></td></tr>
    <span class="espaco_pequeno"></span>

    <div class="div_br"></div>

    <?php if($_SESSION['SN_USUARIO_ADM'] == 'S'){ ?>

        <h11 style="margin-left: 10px;"><i class="fa-solid fa-user-gear"></i> Administrador</h11>
        <div class="div_br"></div>

        <a href="chave.php" class="botao_home_adm" type="submit"><i class="fa-solid fa-key"></i> Chave</a></td></tr>
        <span class="espaco_pequeno"></span>

        <a href="categoria.php" class="botao_home_adm" type="submit"><i class="fa-solid fa-folder-tree"></i> Categoria</a></td></tr>
        <span class="espaco_pequeno"></span>

        <a href="relatorios.php" class="botao_home_adm" type="submit"><i class="fa-regular fa-clipboard"></i> Relatórios</a></td></tr>

    <?php } ?>

    <div class="div_br"></div>

    <h11 style="margin-left: 10px;"><i class="fa-solid fa-chart-column efeito-zoom"></i> Dashboard</h11>

    <div class="div_br"> </div>

    <div class="row">

        <div class="col-sm-3">

            <input id="inpt_mes" onchange="filtrar_mes()" class="form form-control" type="month">

        </div>

    </div>
    
    <div id="carrega_dashboard"></div>

    

<?php
    //RODAPE
    include 'rodape.php';
?>

<script>

    window.onload = function() {

        $('#carrega_dashboard').load('funcoes/dashboard/dashboard.php?filtro=hoje');

    }

    function filtrar_mes() {

        var mes = document.getElementById('inpt_mes').value;

        $('#carrega_dashboard').load('funcoes/dashboard/dashboard.php?filtro=' + mes);

    }

</script>