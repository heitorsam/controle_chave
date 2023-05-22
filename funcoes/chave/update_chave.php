<?php

    session_start();

    include '../../conexao.php';

    $cd_usuario_logado = $_SESSION['usuarioLogin'];

    $nova_ds_chave = $_POST['nova_ds_chave'];
    $cd_chave = $_POST['cd_chave'];

    $query_update_chave = "UPDATE controle_chave.CHAVE ch
                               SET ch.DS_CHAVE = '$nova_ds_chave',
                                   ch.CD_USUARIO_ULT_ALT = '$cd_usuario_logado',
                                   ch.HR_ULT_ALT = SYSDATE
                               WHERE ch.CD_CHAVE = $cd_chave"; 

    $res = oci_parse($conn_ora, $query_update_chave);
    $valida = oci_execute($res);

    if (!$valida) {

        echo $query_update_chave;

    } else {

        echo "Sucesso";

    }

?>