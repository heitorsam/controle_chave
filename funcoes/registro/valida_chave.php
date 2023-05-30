<?php

    include '../../conexao.php';

    $cd_chave = $_POST['idchave'];

    // CONSULTA PARA VERIFICAR SE A CHAVE EXISTE
    $cons_busca_chave = "SELECT ch.DS_CHAVE,
                                ch.TP_STATUS
                         FROM controle_chave.CHAVE ch
                         WHERE ch.CD_CHAVE = $cd_chave";

    $res = oci_parse($conn_ora, $cons_busca_chave);
    $valida = oci_execute($res);

    // CONSULTA PARA VERIFICAR SE A CHAVE JÁ ESTÁ EM USO
    $cons_busca_chave_nao_coleta =  "SELECT reg.CD_CHAVE, 
                                            reg.TP_REGISTRO
                                        FROM controle_chave.REGISTRO reg
                                        WHERE reg.CD_CHAVE = '$cd_chave'
                                        AND reg.TP_REGISTRO = 'C'";

    $res_nao_coleta = oci_parse($conn_ora, $cons_busca_chave_nao_coleta);
    $valida_nao_coleta = oci_execute($res_nao_coleta);

    // VERIFICA SE DEU AGLUM ERRO
    if (!$valida) {

        echo $cons_busca_chave;

    } else {

        $row = oci_fetch_array($res);

        // VERIFICA SE NÃO ESTÁ VAZIO O RESULTADO DA CONSULTA DE CHAVE
        if (!empty($row)) {

            // VERIFICA O STATUS DA CHAVE
            if ($row['TP_STATUS'] == 'A') {

                // VERIFICA SE TEM ERRO DURANTE A CONSULTA DA CHAVE QUE NÃO É COLETA
                if (!$valida_nao_coleta) {
    
                    echo $cons_busca_chave_nao_coleta;
            
                } else {
    
                    $row_nao_coleta = oci_fetch_array($res_nao_coleta);
    
                    // VERIFICA SE NÃO ESTÁ VAZIO A CONSULTA QUE NÃO É COLETA
                    if (empty($row_nao_coleta)) {
    
                        echo 'Sucesso';
    
                    } else {
    
                        echo 'Chave em uso';
    
                    }
    
                }

            } else {

                echo 'Chave inativa';

            }


       } else {

            echo 'Não cadastrada';

       }

    }

?>