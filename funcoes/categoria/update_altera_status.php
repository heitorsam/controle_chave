<?php

    session_start();

    include '../../conexao.php';

    $cd_usuario_logado = $_SESSION['usuarioLogin'];

    $cd_categoria = $_POST['cd_categoria'];
    $novo_tp_status = $_POST['status_alterar'];

    $query_altera_status = "UPDATE controle_chave.CATEGORIA cat
                            SET cat.TP_STATUS = '$novo_tp_status',
                                cat.CD_USUARIO_ULT_ALT = '$cd_usuario_logado',
                                cat.HR_ULT_ALT = SYSDATE
                            WHERE cat.CD_CATEGORIA = $cd_categoria";

    $res = oci_parse($conn_ora, $query_altera_status);

    $valida = oci_execute($res);

    if (!$valida) {

        echo $query_altera_status;

    } else {

        echo "Sucesso";

    }

?>