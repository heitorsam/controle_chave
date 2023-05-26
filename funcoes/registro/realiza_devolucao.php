<?php

    session_start();

    include '../../conexao.php';

    $cd_usuario_logado = $_SESSION['usuarioLogin'];

    $cd_chave = $_POST['cd_chave'];
    $observacao = $_POST['observacao'];

    $query_conclui_devolucao = "UPDATE controle_chave.REGISTRO reg
                                SET reg.TP_REGISTRO = 'D',
                                    reg.CD_USUARIO_ULT_ALT = '$cd_usuario_logado',
                                    reg.HR_ULT_ALT = SYSDATE,
                                    reg.OBS_REGISTRO = '$observacao'
                                WHERE reg.CD_CHAVE = '$cd_chave'
                                    AND reg.TP_REGISTRO = 'C'";

    $res = oci_parse($conn_ora, $query_conclui_devolucao);
    $valida = oci_execute($res);

    if (!$valida) {

        echo $query_conclui_devolucao;

    } else {

        echo 'Sucesso';

    }

?>