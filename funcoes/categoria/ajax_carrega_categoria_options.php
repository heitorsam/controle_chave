<?php

    include '../../conexao.php';

    $cons_categorias = "SELECT cat.CD_CATEGORIA,
                               cat.DS_CATEGORIA
                        FROM controle_chave.CATEGORIA cat
                        WHERE cat.TP_STATUS = 'A'";

    $res = oci_parse($conn_ora, $cons_categorias);
    oci_execute($res);

    echo '<option id="selecione" value="all" disabled selected>Selecione...</option>';

    while($row = oci_fetch_array($res)) {

        echo '<option value="'. $row['CD_CATEGORIA'] .'">'.$row['DS_CATEGORIA'].'</option>';

    }

?>

<script>

    var selecione = document.getElementById('selecione');
    var carrega_categorias = document.getElementById('carrega_categorias');

    carrega_categorias.addEventListener('change', function() {

        selecione.parentNode.removeChild(selecione);

    })    

</script>
