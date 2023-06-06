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

    <h11 style="margin-left: 10px;">Home</h11>
    <div class="div_br"> </div>    

    <a href="registro.php" class="botao_home" type="submit"><i class="fa-solid fa-address-card"></i> Registro</a></td></tr>
    <span class="espaco_pequeno"></span>

    <div class="div_br"></div>

    <?php if($_SESSION['SN_USUARIO_ADM'] == 'S'){ ?>

        <h11 style="margin-left: 10px;">Administrador</h11>
        <div class="div_br"></div>

        <a href="chave.php" class="botao_home_adm" type="submit"><i class="fa-solid fa-key"></i> Chave</a></td></tr>
        <span class="espaco_pequeno"></span>

        <a href="categoria.php" class="botao_home_adm" type="submit"><i class="fa-solid fa-folder-tree"></i> Categoria</a></td></tr>
        <span class="espaco_pequeno"></span>

    <?php } ?>

<?php
    //RODAPE
    include 'rodape.php';
?>
