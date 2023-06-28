<?php

    include '../../conexao.php';

    $cracha = $_GET['cracha'];

    $query_verifica_existencia_assinatura = "SELECT
                                                CASE
                                                    WHEN COUNT(*) = 0 THEN 'S'
                                                    ELSE 'N'
                                                END AS ASSINAR
                                            FROM (
                                                SELECT reg.CD_REGISTRO
                                                FROM controle_chave.REGISTRO reg
                                                WHERE reg.CD_USUARIO_MV = '$cracha'
                                                    AND LENGTH(reg.ASSIN_REGISTRO) > 0) res";

    $res = oci_parse($conn_ora, $query_verifica_existencia_assinatura);
    $valida = oci_execute($res);

    if (!$valida) {

        echo $query_verifica_existencia_assinatura;

    } else {

        $linha = oci_fetch_assoc($res);
        $valor = $linha['ASSINAR'];
        echo $valor;
        
    }

?>
