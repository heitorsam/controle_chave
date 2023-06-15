<?php

    include '../../conexao.php';

    $cracha = $_POST['cracha'];

    $matricula = substr($cracha, 0, -2);
    
    $cons_funcionario = "SELECT func.NM_FUNCIONARIO
                         FROM dbamv.STA_TB_FUNCIONARIO func
                         WHERE func.CHAPA = $matricula
                             AND func.TP_SITUACAO = 'A'";

    $res = oci_parse($conn_ora, $cons_funcionario);
    $valida = oci_execute($res);

    if (!$valida) {

        echo $cons_funcionario;

    } else {

        $row = oci_fetch_array($res);

        if (strlen($cracha) <> 12 || empty($row) || $row['NM_FUNCIONARIO'] == '' || $row['NM_FUNCIONARIO'] == null || !isset($row['NM_FUNCIONARIO'])) {

            echo 'Funcionário não está ativo';

        } else {
            
            echo 'Sucesso';

        }

    }

?>