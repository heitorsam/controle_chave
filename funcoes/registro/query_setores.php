<?php

    include '../../conexao.php';

    $cons_setores = "SELECT se.CD_SETOR,
                            se.NM_SETOR
                     FROM dbamv.SETOR se
                     WHERE  se.SN_ATIVO = 'S'
                     ORDER BY se.NM_SETOR ASC";

    $res = oci_parse($conn_ora, $cons_setores);
    $valida = oci_execute($res);

    while($row = oci_fetch_array($res)) {

        echo '<option value="'.$row['CD_SETOR'].'">'. $row['NM_SETOR'] .'</option>';

    }

?>