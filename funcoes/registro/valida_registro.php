<?php

    session_start();

    include '../../conexao.php';

    $cracha = $_GET['cracha'];

    $cons_registro = "SELECT CD_REGISTRO
                  FROM controle_chave.REGISTRO reg
                  WHERE reg.CD_USUARIO_MV = '$cracha'";

    $res = oci_parse($conn_ora, $cons_registro);
    $valida = oci_execute($res);

    if (!$valida) {

        //echo $cons_registro;

    } else {

       $row = oci_fetch_array($res);

       if (!empty($row)) {

            echo 'S';

       } else {

            echo 'N';

       }

    }

?>
