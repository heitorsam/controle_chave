<?php

    $var_cd_cracha = $_GET['varcracha'];

    include '../../conexao.php';

    $cons_nm_resumido = "SELECT NM_RESUMIDO, LENGTH(NM_RESUMIDO) AS TAMANHO
                         FROM controle_chave.VW_FUNC_CRACHA
                         WHERE CRACHA = '$var_cd_cracha'";

    $res = oci_parse($conn_ora, $cons_nm_resumido);
    oci_execute($res);

    $row = oci_fetch_array($res);

    $tamanho_nm_final_resumido =  @$row['TAMANHO'];
    $nm_final_resumido =  @$row['NM_RESUMIDO'];


    if($tamanho_nm_final_resumido > 5){

        echo 'Usuário:';
        echo '<input id="inpt_cracha" type="text" value="' . $nm_final_resumido . '" class="form form-control" readonly>';

    }
?>