<?php

    include '../../conexao.php';

    session_start();

    $cd_usuario_logado = $_SESSION['usuarioLogin'];

    $cd_setor = $_POST['setor'];
    $ramal = $_POST['ramal'];
    $contato = $_POST['contato'];
    $observacao = $_POST['observacao'];
    $cd_chave = $_POST['cd_chave'];
    $cracha = $_POST['cracha'];

    $query_insert_registro = "INSERT INTO controle_chave.REGISTRO 
                               SELECT controle_chave.SEQ_REGISTRO.NEXTVAL AS CD_REGISTRO,
                               $cd_chave AS CD_CHAVE,
                               'C' AS TP_REGISTRO,
                               '$cracha' AS CD_USUARIO_MV,
                               '$cd_setor' AS CD_SETOR_MV,
                               '$ramal' AS NR_RAMAL,
                               '$contato' AS NR_CONTATO,
                               '$observacao' AS OBS_REGISTRO,
                               '$cd_usuario_logado' AS CD_USUARIO_CADASTRO,
                               SYSDATE HR_CADASTRO,
                               NULL AS CD_USUARIO_ULT_ALT,
                               NULL AS HR_ULT_ALT
                               FROM DUAL";   

    $res = oci_parse($conn_ora, $query_insert_registro);
    $valida = oci_execute($res);

    if (!$valida) {

        echo $query_insert_registro;

    } else {

        echo "Sucesso";

    }

?>