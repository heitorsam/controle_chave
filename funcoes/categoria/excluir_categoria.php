<?php

    include '../../conexao.php';

    $cd_categoria = $_POST['cd_categoria'];

    $query_exclui_categoria = "DELETE
                               FROM controle_chave.CATEGORIA cat
                               WHERE cat.CD_CATEGORIA = $cd_categoria";

    $res = oci_parse($conn_ora, $query_exclui_categoria);
    $valida = oci_execute($res);

    if (!$valida) {

        echo $query_exclui_categoria;

    } else {

        echo "Sucesso";

    }

?>