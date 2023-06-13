<?php

    include '../../conexao.php';

    $ids = implode(', ', $_GET['ids']);

    $cons_infos_chave = "SELECT chv.CD_CHAVE,
                                chv.DS_CHAVE
                        FROM controle_chave.CHAVE chv
                        WHERE chv.CD_CHAVE IN ($ids)
                        ORDER BY chv.CD_CHAVE DESC";

    $res = oci_parse($conn_ora, $cons_infos_chave);
    $valida = oci_execute($res);

    if (!$valida) {

        echo $cons_infos_chave;

    } else {

        $result = array();

        while ($row = oci_fetch_array($res)) {

            $result[] = $row;

        }

        echo json_encode($result);

    }

?>