<?php

    include '../../conexao.php';

    $cons_categorias = "SELECT cat.CD_CATEGORIA,
                               cat.DS_CATEGORIA
                        FROM controle_chave.CATEGORIA cat
                        WHERE cat.TP_STATUS = 'A'";

    $res = oci_parse($conn_ora, $cons_categorias);
    oci_execute($res);

    while($row = oci_fetch_array($res)) {

        echo '<option value="'. $row['CD_CATEGORIA'] .'">'.$row['DS_CATEGORIA'].'</option>';

    }

?>
