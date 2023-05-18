<?php

    include '../../conexao.php';

    $nova_ds_categoria = $_POST['nova_ds_categoria'];
    $cd_categoria = $_POST['cd_categoria'];

    $query_update_categoria = "UPDATE controle_chave.CATEGORIA cat
                               SET cat.DS_CATEGORIA = '$nova_ds_categoria'
                               WHERE cat.CD_CATEGORIA = $cd_categoria"; 

    $res = oci_parse($conn_ora, $query_update_categoria);

    $valida = oci_execute($res);

    if (!$valida) {

        echo $query_update_categoria;

    } else {

        echo "Sucesso";

    }

?>