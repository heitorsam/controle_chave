<?php

    include '../../conexao.php';

    $id_chave = $_GET['idchave'];

    $cons_infos_chave = "SELECT ch.DS_CHAVE,
                                cat.DS_CATEGORIA
                        FROM controle_chave.CHAVE ch
                        INNER JOIN controle_chave.CATEGORIA cat
                        ON ch.CD_CATEGORIA = cat.CD_CATEGORIA
                        WHERE ch.CD_CHAVE = $id_chave
                              AND ch.TP_STATUS = 'A'";

    $res = oci_parse($conn_ora, $cons_infos_chave);
    $valida = oci_execute($res);

    $result = oci_fetch_array($res);

    if (!$valida) {

        echo $cons_registro_dados;

    } else {

        echo json_encode($result);

    }

?>