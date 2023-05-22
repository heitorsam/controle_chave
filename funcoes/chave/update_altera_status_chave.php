<?php

    session_start();

    include '../../conexao.php';

    $cd_usuario_logado = $_SESSION['usuarioLogin'];

    $cd_chave = $_POST['cd_chave'];
    $status_alterar = $_POST['toggle_status'];

    $query_altera_status = "UPDATE controle_chave.CHAVE ch
                            SET ch.TP_STATUS = '$status_alterar',
                                ch.CD_USUARIO_ULT_ALT = '$cd_usuario_logado',
                                ch.HR_ULT_ALT = SYSDATE
                            WHERE ch.CD_CHAVE = $cd_chave";

    $res = oci_parse($conn_ora, $query_altera_status);

    $valida = oci_execute($res);

    if (!$valida) {

        echo $query_altera_status;

    } else {

        echo "Sucesso";

    }

?>