<?php

    include '../../conexao.php';

    session_start();

    $usuario_logado = $_SESSION['usuarioLogin'];

    $ds_categoria = $_POST['ds_categoria'];

    $query_insert_categoria = "INSERT INTO controle_chave.CATEGORIA
                               SELECT
                               controle_chave.SEQ_CATEGORIA.NEXTVAL AS CD_CATEGORIA,
                               '$ds_categoria' AS DS_CATEGORIA,
                               'A' AS TP_STATUS,
                               '$usuario_logado' CD_USUARIO_CADASTRO,
                               SYSDATE AS HR_CADASTRO,
                               NULL AS CD_USUARIO_ULT_ALT,
                               NULL AS HR_ULT_ALT
                               FROM dual";

    $res = oci_parse($conn_ora, $query_insert_categoria);

    $valida = oci_execute($res);

    if (!$valida) {

        echo $query_insert_categoria;

    } else {

        echo "Sucesso";

    }

?>