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
    $assinatura = $_POST['assinatura'];
    $tp_cadeado = $_POST['tp_cadeado'];

    $dataURL = $_POST['assinatura']; 

    if ($assinatura != '') {

        $parts = explode(',', $dataURL);  
        $data = $parts[1];
    
        $image = base64_decode($data);

    } else {

        $image = '';

    }

    

/*     $query_insert_registro = "INSERT INTO controle_chave.REGISTRO 
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
                               NULL AS HR_ULT_ALT,
                               EMPTY_BLOB()
                               FROM DUAL"; */

    $query_insert_registro = "INSERT INTO controle_chave.REGISTRO 
                            (CD_REGISTRO, CD_CHAVE, TP_REGISTRO, CD_USUARIO_MV, CD_SETOR_MV, NR_RAMAL, NR_CONTATO, OBS_REGISTRO, CD_USUARIO_CADASTRO, HR_CADASTRO, CD_USUARIO_ULT_ALT, HR_ULT_ALT, ASSIN_REGISTRO, TP_CADEADO
                            )
                            VALUES 
                            (controle_chave.SEQ_REGISTRO.NEXTVAL, $cd_chave, 'C', '$cracha', '$cd_setor', '$ramal', '$contato', '$observacao', '$cd_usuario_logado', SYSDATE, NULL, NULL,  EMPTY_BLOB(), '$tp_cadeado'
                            ) 
                            RETURNING ASSIN_REGISTRO INTO :image";


    $res = oci_parse($conn_ora, $query_insert_registro);

    $blob = oci_new_descriptor($conn_ora, OCI_D_LOB);
    oci_bind_by_name($res, ":image", $blob, -1, OCI_B_BLOB);

    $valida = oci_execute($res, OCI_DEFAULT);

    //if ($assinatura != '') {

        if(!$blob->save($image)){
    
            oci_rollback($conn_ora);
    
        }
        else {
    
            oci_commit($conn_ora);
    
        }

    //}

    oci_free_statement($res);
    $blob->free();

    if (!$valida) {

        echo $query_insert_registro;

    } else {

        echo "Sucesso";

    }

?>