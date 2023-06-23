<?php

    include 'cabecalho.php';

?>

    <h11><i class="fa-solid fa-file-signature"></i> Termos</h11>
        <div class='espaco_pequeno'></div>
    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

    <div class="div_br"></div>

    <div id="carrega_tabela_termos"></div>

<?php

    include 'rodape.php';

?>

<script>

    window.onload = function() {

        $('#carrega_tabela_termos').load('funcoes/termos/ajax_tabela_termos.php');

    }

</script>