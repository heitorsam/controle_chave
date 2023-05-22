<?php

    session_start();

    include '../../conexao.php';

    $cracha = $_GET['cracha'];

    $cons_registro_dados = "SELECT reg.CD_REGISTRO,
                            ch.DS_CHAVE,
                            cat.DS_CATEGORIA
                        FROM controle_chave.REGISTRO reg
                        INNER JOIN controle_chave.CHAVE ch
                        ON reg.CD_CHAVE = ch.CD_CHAVE
                        INNER JOIN controle_chave.CATEGORIA cat
                        ON ch.CD_CATEGORIA = cat.CD_CATEGORIA
                        WHERE reg.CD_USUARIO_MV = '$cracha'
                        AND reg.TP_REGISTRO = 'C'";

    $res = oci_parse($conn_ora, $cons_registro_dados);
    $valida = oci_execute($res);

    $result = oci_fetch_array($res);

    if (!$valida) {

        echo $cons_registro_dados;

    } else {

        echo json_encode($result);

    }

?>