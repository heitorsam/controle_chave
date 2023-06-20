<?php

    include '../../conexao.php';

    $cracha = $_GET['filtro_cracha'];
    $cdcategoria = $_GET['filtro_categoria'];
    $mes = $_GET['filtro_mes_rel'];

    // APLICA AJUSTES PARA NÃO DAR ERRO NA CONSULTA QUANDO USA FUNÇÃO
    if ($mes == 'all') {

        $mes = "TO_CHAR(SYSDATE, 'YYYY-MM')";
    } else {

        $mes = "'" . $mes . "'";
    }

    $cons_cont_atrasos = "SELECT SUM(tot2.TEMPO_ATRASO_MINUTOS) AS TOT_MIN,
                                    COUNT(*) AS QTD_ATRASOS
                                FROM (SELECT tot.*,
                                            CASE
                                            WHEN tot.DT_DEVOLUCAO IS NOT NULL THEN
                                            'ENTREGUE'
                                            ELSE
                                            'COM A CHAVE'
                                            END AS STATUS
                                    FROM (SELECT resp.CD_USUARIO_MV,
                                                    TO_CHAR(resp.HR_CADASTRO, 'DD/MM/YYYY HH24:MI') AS DT_RETIRADA,
                                                    TO_CHAR(resp.HR_ULT_ALT, 'DD/MM/YYYY HH24:MI') AS DT_DEVOLUCAO,
                                                    
                                                    resp.DIAS || 'd' || resp.HORAS || 'h' || resp.MINUTOS || 'm' AS TEMPO_TOTAL,
                                                    resp.DIAS_ATRASO || 'd' || resp.HORAS_ATRASO || 'h' || resp.MINUTOS_ATRASO || 'm' AS TEMPO_ATRASO,
                                                    resp.TEMPO_ATRASO_MINUTOS,
                                                    resp.CD_CHAVE
                                            FROM (SELECT FLOOR(res.DIFF / (24 * 60)) AS DIAS,
                                                            FLOOR(MOD(res.DIFF, (24 * 60)) / 60) AS HORAS,
                                                            MOD(res.DIFF, 60) AS MINUTOS,
                                                            FLOOR(res.TEMPO_ATRASO / (24 * 60)) AS DIAS_ATRASO,
                                                            FLOOR(MOD(res.TEMPO_ATRASO, (24 * 60)) / 60) AS HORAS_ATRASO,
                                                            MOD(res.TEMPO_ATRASO, 60) AS MINUTOS_ATRASO,
                                                            res.CD_USUARIO_MV,
                                                            res.HR_CADASTRO,
                                                            res.HR_ULT_ALT,
                                                            res.TEMPO_ATRASO_MINUTOS,
                                                            res.CD_CHAVE
                                                    FROM (SELECT (TRUNC(reg.HR_ULT_ALT) -
                                                                    TRUNC(reg.HR_CADASTRO)) * 24 * 60 +
                                                                    EXTRACT(HOUR FROM
                                                                            reg.HR_ULT_ALT - reg.HR_CADASTRO) * 60 +
                                                                    EXTRACT(MINUTE FROM
                                                                            reg.HR_ULT_ALT - reg.HR_CADASTRO) AS DIFF,
                                                                    (TRUNC(reg.HR_ULT_ALT) -
                                                                    TRUNC(reg.HR_CADASTRO)) * 24 * 60 +
                                                                    EXTRACT(HOUR FROM
                                                                            reg.HR_ULT_ALT - reg.HR_CADASTRO) * 60 +
                                                                    EXTRACT(MINUTE FROM
                                                                            reg.HR_ULT_ALT - reg.HR_CADASTRO) - 720 AS TEMPO_ATRASO,
                                                                    (TRUNC(reg.HR_ULT_ALT) -
                                                                    TRUNC(reg.HR_CADASTRO)) * 24 * 60 +
                                                                    EXTRACT(HOUR FROM
                                                                            reg.HR_ULT_ALT - reg.HR_CADASTRO) * 60 +
                                                                    EXTRACT(MINUTE FROM
                                                                            reg.HR_ULT_ALT - reg.HR_CADASTRO) - 720 AS TEMPO_ATRASO_MINUTOS,
                                                                    reg.CD_USUARIO_MV,
                                                                    reg.HR_CADASTRO,
                                                                    reg.HR_ULT_ALT,
                                                                    reg.CD_CHAVE
                                                            FROM controle_chave.REGISTRO reg
                                                            WHERE reg.TP_REGISTRO = 'D'
                                                                AND TO_CHAR(reg.HR_ULT_ALT, 'YYYY-MM') =
                                                                    $mes) res) resp
                                            WHERE resp.DIAS > 0
                                                OR resp.HORAS >= 12
                                            
                                            UNION ALL
                                            
                                            SELECT resp.CD_USUARIO_MV,
                                                    TO_CHAR(resp.HR_CADASTRO, 'DD/MM/YYYY HH24:MI') AS DT_RETIRADA,
                                                    TO_CHAR(resp.HR_ULT_ALT, 'DD/MM/YYYY HH24:MI') AS DT_DEVOLUCAO,
                                                    resp.DIAS || 'd' || resp.HORAS || 'h' || resp.MINUTOS || 'm' AS TEMPO_TOTAL,
                                                    resp.DIAS_ATRASO || 'd' || resp.HORAS_ATRASO || 'h' || resp.MINUTOS_ATRASO || 'm' AS TEMPO_ATRASO,
                                                    resp.TEMPO_ATRASO_MINUTOS,
                                                    resp.CD_CHAVE
                                            FROM (SELECT FLOOR(res.DIFF / (24 * 60)) AS DIAS,
                                                            FLOOR(MOD(res.DIFF, (24 * 60)) / 60) AS HORAS,
                                                            MOD(res.DIFF, 60) AS MINUTOS,
                                                            FLOOR(res.TEMPO_ATRASO / (24 * 60)) AS DIAS_ATRASO,
                                                            FLOOR(MOD(res.TEMPO_ATRASO, (24 * 60)) / 60) AS HORAS_ATRASO,
                                                            MOD(res.TEMPO_ATRASO, 60) AS MINUTOS_ATRASO,
                                                            res.CD_USUARIO_MV,
                                                            res.HR_CADASTRO,
                                                            res.HR_ULT_ALT,
                                                            res.TEMPO_ATRASO_MINUTOS,
                                                            res.CD_CHAVE
                                                    FROM (SELECT (TRUNC(SYSDATE) - TRUNC(reg.HR_CADASTRO)) * 24 * 60 +
                                                                    EXTRACT(HOUR FROM
                                                                            SYSDATE - reg.HR_CADASTRO) * 60 +
                                                                    EXTRACT(MINUTE FROM
                                                                            SYSDATE - reg.HR_CADASTRO) AS DIFF,
                                                                    ((TRUNC(SYSDATE) - TRUNC(reg.HR_CADASTRO)) * 24 * 60 +
                                                                    EXTRACT(HOUR FROM
                                                                            SYSDATE - reg.HR_CADASTRO) * 60 +
                                                                    EXTRACT(MINUTE FROM
                                                                            SYSDATE - reg.HR_CADASTRO)) - 720 AS TEMPO_ATRASO,
                                                                    ((TRUNC(SYSDATE) - TRUNC(reg.HR_CADASTRO)) * 24 * 60 +
                                                                    EXTRACT(HOUR FROM
                                                                            SYSDATE - reg.HR_CADASTRO) * 60 +
                                                                    EXTRACT(MINUTE FROM
                                                                            SYSDATE - reg.HR_CADASTRO)) - 720 AS TEMPO_ATRASO_MINUTOS,
                                                                    reg.CD_USUARIO_MV,
                                                                    reg.HR_CADASTRO,
                                                                    reg.HR_ULT_ALT,
                                                                    reg.CD_CHAVE
                                                            FROM controle_chave.REGISTRO reg
                                                            WHERE reg.TP_REGISTRO = 'C'
                                                                AND TO_CHAR(reg.HR_CADASTRO, 'YYYY-MM') =
                                                                    $mes) res) resp
                                            WHERE resp.DIAS > 0
                                                OR resp.HORAS >= 12) tot) tot2
                                INNER JOIN (SELECT CASE
                                                WHEN LENGTH(aux.CHAPA) = 5 THEN
                                                    '00000' || aux.CHAPA || '00'
                                                ELSE
                                                    '000000' || aux.CHAPA || '00'
                                                END AS CRACHA,
                                                aux.NM_FUNCIONARIO
                                            FROM (SELECT func.CHAPA, func.NM_FUNCIONARIO
                                                    FROM dbamv.STA_TB_FUNCIONARIO func
                                                WHERE func.TP_SITUACAO = 'A') aux) func
                                ON func.CRACHA = tot2.CD_USUARIO_MV
                                INNER JOIN controle_chave.CHAVE chv
                                ON tot2.CD_CHAVE = chv.CD_CHAVE
                                INNER JOIN controle_chave.CATEGORIA cat
                                ON chv.CD_CATEGORIA = cat.CD_CATEGORIA
                                WHERE tot2.CD_USUARIO_MV = '$cracha'
                                    AND cat.CD_CATEGORIA = '$cdcategoria'";

    $res_cons_cont_atrasos = oci_parse($conn_ora, $cons_cont_atrasos);
    $valida = oci_execute($res_cons_cont_atrasos);

    if (!$valida) {

        echo 'Erro';

    } else {

        if ($row = oci_fetch_assoc($res_cons_cont_atrasos)) {
      
            $json = json_encode($row);
            
            echo $json;
            
        }
    }

?>