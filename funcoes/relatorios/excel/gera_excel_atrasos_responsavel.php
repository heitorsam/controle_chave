<?php

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=atrasos_responsavel_chave.xls");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);

include '../../../conexao.php';

$cd_categoria = $_GET['cdcategoria'];
$dt_mes_filtro = $_GET['mes'];
$cracha = $_GET['cracha'];

// APLICA AJUSTES PARA NÃO DAR ERRO NA CONSULTA QUANDO USA FUNÇÃO
if ($dt_mes_filtro == 'all') {

    $dt_mes_filtro = "TO_CHAR(SYSDATE, 'YYYY-MM')";
} else {

    $dt_mes_filtro = "'" . $dt_mes_filtro . "'";
}

$cons_relatorio_atrasos = "SELECT    tot2.CD_USUARIO_MV AS CD_USUARIO_MV,
                                     func.NM_FUNCIONARIO,
                                     chv.DS_CHAVE,
                                     tot2.DT_RETIRADA,
                                     tot2.DT_DEVOLUCAO,
                                     tot2.NR_RAMAL,
                                     tot2.NR_CONTATO,
                                     tot2.TEMPO_TOTAL,
                                     tot2.TEMPO_ATRASO,
                                     tot2.STATUS,
                                     tot2.TEMPO_ATRASO_MINUTOS
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
                                                     resp.DIAS_ATRASO || 'd' || resp.HORAS_ATRASO || 'h' ||
                                                     resp.MINUTOS_ATRASO || 'm' AS TEMPO_ATRASO,
                                                     resp.TEMPO_ATRASO_MINUTOS,
                                                     resp.CD_CHAVE,
                                                     resp.NR_RAMAL,
                                                     resp.NR_CONTATO
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
                                                             res.CD_CHAVE,
                                                             res.NR_RAMAL,
                                                             res.NR_CONTATO
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
                                                                     reg.CD_CHAVE,
                                                                     reg.NR_RAMAL,
                                                                     reg.NR_CONTATO
                                                             FROM controle_chave.REGISTRO reg
                                                             WHERE reg.TP_REGISTRO = 'D'
                                                                 AND TO_CHAR(reg.HR_ULT_ALT, 'YYYY-MM') =
                                                                     $dt_mes_filtro) res) resp
                                             WHERE resp.DIAS > 0
                                                 OR resp.HORAS >= 12
                                             
                                             UNION ALL
                                             
                                             SELECT  resp.CD_USUARIO_MV AS CD_USUARIO_MV,
                                                     TO_CHAR(resp.HR_CADASTRO, 'DD/MM/YYYY HH24:MI') AS DT_RETIRADA,
                                                     TO_CHAR(resp.HR_ULT_ALT, 'DD/MM/YYYY HH24:MI') AS DT_DEVOLUCAO,
                                                     resp.DIAS || 'd' || resp.HORAS || 'h' || resp.MINUTOS || 'm' AS TEMPO_TOTAL,
                                                     resp.DIAS_ATRASO || 'd' || resp.HORAS_ATRASO || 'h' ||
                                                     resp.MINUTOS_ATRASO || 'm' AS TEMPO_ATRASO,
                                                     resp.TEMPO_ATRASO_MINUTOS,
                                                     resp.CD_CHAVE,
                                                     resp.NR_RAMAL,
                                                     resp.NR_CONTATO
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
                                                             res.CD_CHAVE,
                                                             res.NR_RAMAL,
                                                             res.NR_CONTATO
                                                     FROM (SELECT (TRUNC(SYSDATE) - TRUNC(reg.HR_CADASTRO)) * 24 * 60 +
                                                                     EXTRACT(HOUR FROM
                                                                             SYSDATE - reg.HR_CADASTRO) * 60 +
                                                                     EXTRACT(MINUTE FROM
                                                                             SYSDATE - reg.HR_CADASTRO) AS DIFF,
                                                                     ((TRUNC(SYSDATE) -
                                                                     TRUNC(reg.HR_CADASTRO)) * 24 * 60 +
                                                                     EXTRACT(HOUR FROM
                                                                             SYSDATE - reg.HR_CADASTRO) * 60 +
                                                                     EXTRACT(MINUTE FROM
                                                                             SYSDATE - reg.HR_CADASTRO)) - 720 AS TEMPO_ATRASO,
                                                                     ((TRUNC(SYSDATE) -
                                                                     TRUNC(reg.HR_CADASTRO)) * 24 * 60 +
                                                                     EXTRACT(HOUR FROM
                                                                             SYSDATE - reg.HR_CADASTRO) * 60 +
                                                                     EXTRACT(MINUTE FROM
                                                                             SYSDATE - reg.HR_CADASTRO)) - 720 AS TEMPO_ATRASO_MINUTOS,
                                                                     reg.CD_USUARIO_MV,
                                                                     reg.HR_CADASTRO,
                                                                     reg.HR_ULT_ALT,
                                                                     reg.CD_CHAVE,
                                                                     reg.NR_RAMAL,
                                                                     reg.NR_CONTATO
                                                             FROM controle_chave.REGISTRO reg
                                                             WHERE reg.TP_REGISTRO = 'C'
                                                                 AND TO_CHAR(reg.HR_CADASTRO, 'YYYY-MM') =
                                                                     $dt_mes_filtro) res) resp
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
                                 WHERE cat.CD_CATEGORIA = $cd_categoria";

        if ($cracha != 'all' && $cracha != '') {

        $cons_relatorio_atrasos .= "AND tot2.CD_USUARIO_MV = '$cracha'";

        }


        $res_cons_atrasos = oci_parse($conn_ora, $cons_relatorio_atrasos);
        oci_execute($res_cons_atrasos);

?>

<table class="table table-striped" style="text-align: center">

    <thead>

        <th class="p-2" style="text-align: center; white-space: nowrap;">Crachá</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Responsável</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Chave</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Data da Retirada</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Data da Devolução</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Ramal</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Contato</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Tempo Total</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Tempo em Atraso</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Status</th>

    </thead>

    <tbody>

        <?php

        while ($row = oci_fetch_array($res_cons_atrasos)) {

            echo "<tr style='text-align: center'>";

                echo "<td class='align-middle'>" . strval($row['CD_USUARIO_MV']) . "</td>";
                echo '<td class="align-middle">' . $row['NM_FUNCIONARIO'] . '</td>';
                echo '<td class="align-middle">' . $row['DS_CHAVE'] . '</td>';
                echo '<td class="align-middle">' . $row['DT_RETIRADA'] . '</td>';
                echo '<td class="align-middle">' . $row['DT_DEVOLUCAO'] . '</td>';
                echo '<td class="align-middle">' . $row['NR_RAMAL'] . '</td>';
                echo '<td class="align-middle">' . $row['NR_CONTATO'] . '</td>';
                echo '<td class="align-middle">' . $row['TEMPO_TOTAL'] . '</td>';
                echo '<td class="align-middle">' . $row['TEMPO_ATRASO'] . '</td>';
                echo '<td class="align-middle">' . $row['STATUS'] . '</td>';

            echo '</tr>';
        }

        ?>

    </tbody>

</table>

?>