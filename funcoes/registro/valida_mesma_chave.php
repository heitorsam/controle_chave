<?php

    include '../../conexao.php';

    $cd_chave = $_POST['cd_chave'];
    $cracha = $_POST['cracha'];

    $cons_mesma_chave = "SELECT 
                            CASE
                                WHEN reg.CD_CHAVE = '$cd_chave' THEN 'S'
                                ELSE 'N'
                            END MESMA_CHAVE
                        FROM controle_chave.REGISTRO reg
                        WHERE CD_USUARIO_MV = '$cracha'
                            AND reg.TP_REGISTRO = 'C'";
    
    $res = oci_parse($conn_ora, $cons_mesma_chave);
    $valida = oci_execute($res);

    $result = oci_fetch_array($res);

    if (!$valida) {

        echo $cons_mesma_chave;

    } else {

        echo json_encode($result);

    }

?>