<?php

    include '../../conexao.php';

    $cd_chave = $_POST['cd_chave'];

    $query_exclui_chave = "DELETE
                           FROM controle_chave.CHAVE ch
                           WHERE ch.CD_CHAVE = $cd_chave";

    $res = oci_parse($conn_ora, $query_exclui_chave);
    $valida = oci_execute($res);

    if (!$valida) {

        echo $query_exclui_chave;

    } else {

        echo "Sucesso";

    }

?>