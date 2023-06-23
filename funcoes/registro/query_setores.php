<?php

    include '../../conexao.php';

    $cracha = $_GET['cracha'];

    // PUXA AS ULTIMAS INFORMAÇÕES DE REGISTRO CASO TENHA PARA PREENCHER OS INPUTS AUTOMATICAMENTE
    $contem_informacao = "SELECT 
                                CASE
                                    WHEN COUNT(*) = 0 THEN 'N'
                                    ELSE 'S'
                                END AS CONTEM_REGISTRO
                            FROM (SELECT reg.CD_SETOR_MV,
                                         uni.NM_SETOR
                                FROM controle_chave.REGISTRO reg
                                INNER JOIN dbamv.SETOR uni
                                    ON reg.CD_SETOR_MV = uni.CD_SETOR
                                WHERE reg.CD_REGISTRO IN (SELECT MAX(CD_REGISTRO)
                                                            FROM controle_chave.REGISTRO reg
                                                            WHERE reg.CD_USUARIO_MV = '$cracha')) res";

    $res_informacao = oci_parse($conn_ora, $contem_informacao);
    oci_execute($res_informacao);

    $res_info = oci_fetch_array($res_informacao);

    // CONSULTA TODOS OS SETORES
    $cons_setores = "SELECT se.CD_SETOR,
                            se.NM_SETOR
                     FROM dbamv.SETOR se
                     WHERE  se.SN_ATIVO = 'S'
                     ORDER BY se.NM_SETOR ASC";

    // CONSULTA SETOR E CD SETOR CASO O CRACHÁ PROCURADO TEVE REGISTRO PARA PUXAR AUTOMATICAMENTE COMO PRIMEIRA OPÇÃO
    if ($res_info['CONTEM_REGISTRO'] == 'S') {
        
        // CONSULTA TODOS OS SETORES EXCETO DO CRACHÁ SOLICITADO, CASO TENHA REGISTRO
        $cons_setores = "SELECT se.CD_SETOR,
                                se.NM_SETOR
                        FROM dbamv.SETOR se
                        WHERE  se.SN_ATIVO = 'S'
                                AND se.CD_SETOR NOT IN (SELECT reg.CD_SETOR_MV
                                                        FROM controle_chave.REGISTRO reg
                                                        INNER JOIN dbamv.SETOR uni
                                                        ON reg.CD_SETOR_MV = uni.CD_SETOR
                                                        WHERE reg.CD_REGISTRO IN
                                                            (SELECT MAX(CD_REGISTRO)
                                                                FROM controle_chave.REGISTRO reg
                                                                WHERE reg.CD_USUARIO_MV = '$cracha'))
                        ORDER BY se.NM_SETOR ASC";

        $setor_cracha = "SELECT reg.CD_SETOR_MV,
                                uni.NM_SETOR
                        FROM controle_chave.REGISTRO reg
                        INNER JOIN dbamv.SETOR uni
                            ON reg.CD_SETOR_MV = uni.CD_SETOR
                        WHERE reg.CD_REGISTRO IN (SELECT MAX(CD_REGISTRO)
                                                  FROM controle_chave.REGISTRO reg
                                                  WHERE reg.CD_USUARIO_MV = '$cracha')";
                                                        
        $res_setor_cracha = oci_parse($conn_ora, $setor_cracha);
        oci_execute($res_setor_cracha);
                                                    
        $resp_setor_cracha = oci_fetch_array($res_setor_cracha);

        echo '<option value="'. $resp_setor_cracha['CD_SETOR_MV'] .'">'. $resp_setor_cracha['NM_SETOR'] .'</option>';

    } else {

        echo '<option id="selecione" value="all" disabled selected>Selecione...</option>';

    }

    // EXECUTA CONSULTA SETORES
    $res = oci_parse($conn_ora, $cons_setores);
    $valida = oci_execute($res);

    if (!$valida) {

        echo $cons_setores;

    } else {

        while($row = oci_fetch_array($res)) {
    
            echo '<option value="'.$row['CD_SETOR'].'">'. $row['NM_SETOR'] .'</option>';
    
        }

    }

?>

<script>

/*     var selecione = document.getElementById('selecione');
    var selecao_setores = document.getElementById('carrega_categorias');

    selecao_setores.addEventListener('change', function() {

        selecione.parentNode.removeChild(selecione);

    })    
 */
</script>