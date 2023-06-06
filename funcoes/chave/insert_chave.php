<?php

    session_start();

    $cd_usuario_logado = $_SESSION['usuarioLogin'];

    include '../../conexao.php';

    $descricao = $_POST['descricao'];
    $cd_categoria = $_POST['cd_categoria'];

    $query_insert_chave = "INSERT INTO controle_chave.CHAVE
                            SELECT 
                            controle_chave.SEQ_CHAVE.NEXTVAL AS CD_CHAVE,
                            '$descricao' AS DS_CHAVE,
                            $cd_categoria AS CD_CATEGORIA,
                            'A' AS TP_STATUS,
                            '$cd_usuario_logado' AS CD_USUARIO_CADASTRO,
                            TO_CHAR(SYSDATE, 'DD/MM/YYY HH24:MI:SS') AS HR_CADASTRO,
                            NULL AS CD_USUARIO_ULT_ALT,
                            NULL AS HR_ULT_ALT
                            FROM dual";

    $res = oci_parse($conn_ora, $query_insert_chave);

    $valida = oci_execute($res);

    if (!$valida) {

        echo $query_insert_chave;

    } else {

        echo "Sucesso";

    }

?>