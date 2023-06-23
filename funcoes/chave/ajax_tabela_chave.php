<?php

    session_start();

    include '../../conexao.php';

    include '../../config/mensagem/ajax_mensagem_alert.php';

    $cd_categoria = $_GET['cdcategoria'];
    $pagina = $_GET['pagina'];

    $cons_tot = "SELECT COUNT(*) AS QTD
                FROM (SELECT tot.CD_CHAVE,
                            tot.DS_CHAVE,
                            tot.DS_CATEGORIA,
                            tot.TP_STATUS,
                            tot.QTD_REGISTROS,
                            tot.RESPONSAVEL,
                            (SELECT resp.DIAS || 'd' || resp.HORAS || 'h' || resp.MINUTOS || 'm' AS TEMPO
                                FROM (SELECT FLOOR(res.DIFF / (24 * 60)) AS DIAS,
                                            FLOOR(MOD(res.DIFF, (24 * 60)) / 60) AS HORAS,
                                            MOD(res.DIFF, 60) AS MINUTOS,
                                            res.CD_CHAVE
                                        FROM (SELECT (TRUNC(SYSDATE) - TRUNC(reg.HR_CADASTRO)) * 24 * 60 +
                                                    EXTRACT(HOUR FROM
                                                            SYSDATE - reg.HR_CADASTRO) * 60 +
                                                    EXTRACT(MINUTE FROM
                                                            SYSDATE - reg.HR_CADASTRO) AS DIFF,
                                                    reg.CD_CHAVE
                                                FROM controle_chave.REGISTRO reg
                                            WHERE reg.TP_REGISTRO = 'C') res) resp
                            WHERE resp.CD_CHAVE = tot.CD_CHAVE) AS TEMPO,
                            CASE
                            WHEN tot.RESPONSAVEL = 'SEM RESPONSÁVEL' THEN
                                ''
                            ELSE
                                TO_CHAR((SELECT reg.HR_CADASTRO
                                        FROM controle_chave.REGISTRO reg
                                        WHERE reg.CD_REGISTRO = tot.CD_REGISTRO),
                                        'DD/MM/YYYY HH24:MI')
                            END AS RETIRADA
                        FROM (SELECT res.CD_CHAVE,
                                    res.DS_CHAVE,
                                    res.CD_CATEGORIA,
                                    res.DS_CATEGORIA,
                                    res.TP_STATUS,
                                    res.QTD_REGISTROS,
                                    res.CD_REGISTRO,
                                    CASE
                                    WHEN res.RESPONSAVEL_CHAVE IS NULL THEN
                                        'SEM RESPONSÁVEL'
                                    ELSE
                                        vfc.NM_RESUMIDO
                                    END AS RESPONSAVEL
                                FROM (SELECT ch.CD_CHAVE,
                                            ch.DS_CHAVE,
                                            cat.CD_CATEGORIA,
                                            cat.DS_CATEGORIA,
                                            ch.TP_STATUS,
                                            (SELECT MAX(reg.CD_REGISTRO)
                                                FROM controle_chave.REGISTRO reg
                                            WHERE ch.CD_CHAVE = reg.CD_CHAVE) AS CD_REGISTRO,
                                            (SELECT COUNT(reg.CD_REGISTRO)
                                                FROM controle_chave.REGISTRO reg
                                            WHERE ch.CD_CHAVE = reg.CD_CHAVE) AS QTD_REGISTROS,
                                            (SELECT reg.CD_USUARIO_MV
                                                FROM controle_chave.REGISTRO reg
                                            WHERE ch.CD_CHAVE = reg.CD_CHAVE
                                                AND reg.TP_REGISTRO = 'C') AS RESPONSAVEL_CHAVE
                                        FROM controle_chave.CHAVE ch
                                    INNER JOIN controle_chave.CATEGORIA cat
                                        ON ch.CD_CATEGORIA = cat.CD_CATEGORIA) res
                                LEFT JOIN controle_chave.VW_FUNC_CRACHA vfc
                                ON vfc.CRACHA = res.RESPONSAVEL_CHAVE) tot";

    // APLICA OS FILTROS CASO EXISTA ALGUM, SE FOR ENVIADO COMO ALL, MOSTRA TODOS
    if ($cd_categoria == 'all') {

        $cons_tot .= " ORDER BY tot.CD_CHAVE DESC)";
    
    } else {
    
        $cons_tot .= " WHERE tot.CD_CATEGORIA = '$cd_categoria'
                                ORDER BY tot.CD_CHAVE DESC)";
    
    }

    $res_cons_tot = oci_parse($conn_ora, $cons_tot);
    oci_execute($res_cons_tot);
    $row_qtd = oci_fetch_array($res_cons_tot);

    //QUANTAS LINHAS POR PÁGINA? 
    $qtd_paginacao = 50;
    $quantidade_qtd_pag = ceil($row_qtd['QTD'] / $qtd_paginacao);
    $var1 = ((int)$pagina * (int)$qtd_paginacao);
    $var_padrao = 50;
    $var2 = $var1 - $var_padrao;

    $cons_tabela_chave = "SELECT *
                            FROM (SELECT res.*
                                    FROM (SELECT ROWNUM AS LINHA, lin.*
                                            FROM (SELECT tot.CD_CHAVE,
                                                        tot.DS_CHAVE,
                                                        tot.DS_CATEGORIA,
                                                        tot.TP_STATUS,
                                                        tot.QTD_REGISTROS,
                                                        tot.RESPONSAVEL,
                                                        tot.CD_CATEGORIA,
                                                        (SELECT resp.DIAS || 'd' || resp.HORAS || 'h' ||
                                                                resp.MINUTOS || 'm' AS TEMPO
                                                            FROM (SELECT FLOOR(res.DIFF / (24 * 60)) AS DIAS,
                                                                        FLOOR(MOD(res.DIFF, (24 * 60)) / 60) AS HORAS,
                                                                        MOD(res.DIFF, 60) AS MINUTOS,
                                                                        res.CD_CHAVE
                                                                    FROM (SELECT (TRUNC(SYSDATE) -
                                                                                TRUNC(reg.HR_CADASTRO)) * 24 * 60 +
                                                                                EXTRACT(HOUR FROM
                                                                                        SYSDATE -
                                                                                        reg.HR_CADASTRO) * 60 +
                                                                                EXTRACT(MINUTE FROM
                                                                                        SYSDATE -
                                                                                        reg.HR_CADASTRO) AS DIFF,
                                                                                reg.CD_CHAVE
                                                                            FROM controle_chave.REGISTRO reg
                                                                        WHERE reg.TP_REGISTRO = 'C') res) resp
                                                        WHERE resp.CD_CHAVE = tot.CD_CHAVE) AS TEMPO,
                                                        CASE
                                                        WHEN tot.RESPONSAVEL = 'SEM RESPONSÁVEL' THEN
                                                            ''
                                                        ELSE
                                                            TO_CHAR((SELECT reg.HR_CADASTRO
                                                                    FROM controle_chave.REGISTRO reg
                                                                    WHERE reg.CD_REGISTRO =
                                                                        tot.CD_REGISTRO),
                                                                    'DD/MM/YYYY HH24:MI')
                                                        END AS RETIRADA
                                                    FROM (SELECT res.CD_CHAVE,
                                                                res.DS_CHAVE,
                                                                res.CD_CATEGORIA,
                                                                res.DS_CATEGORIA,
                                                                res.TP_STATUS,
                                                                res.QTD_REGISTROS,
                                                                res.CD_REGISTRO,
                                                                CASE
                                                                WHEN res.RESPONSAVEL_CHAVE IS NULL THEN
                                                                    'SEM RESPONSÁVEL'
                                                                ELSE
                                                                    vfc.NM_RESUMIDO
                                                                END AS RESPONSAVEL
                                                            FROM (SELECT ch.CD_CHAVE,
                                                                        ch.DS_CHAVE,
                                                                        cat.CD_CATEGORIA,
                                                                        cat.DS_CATEGORIA,
                                                                        ch.TP_STATUS,
                                                                        (SELECT MAX(reg.CD_REGISTRO)
                                                                            FROM controle_chave.REGISTRO reg
                                                                        WHERE ch.CD_CHAVE = reg.CD_CHAVE) AS CD_REGISTRO,
                                                                        (SELECT COUNT(reg.CD_REGISTRO)
                                                                            FROM controle_chave.REGISTRO reg
                                                                        WHERE ch.CD_CHAVE = reg.CD_CHAVE) AS QTD_REGISTROS,
                                                                        (SELECT reg.CD_USUARIO_MV
                                                                            FROM controle_chave.REGISTRO reg
                                                                        WHERE ch.CD_CHAVE = reg.CD_CHAVE
                                                                            AND reg.TP_REGISTRO = 'C') AS RESPONSAVEL_CHAVE
                                                                    FROM controle_chave.CHAVE ch
                                                                INNER JOIN controle_chave.CATEGORIA cat
                                                                    ON ch.CD_CATEGORIA =
                                                                        cat.CD_CATEGORIA) res
                                                            LEFT JOIN controle_chave.VW_FUNC_CRACHA vfc
                                                            ON vfc.CRACHA = res.RESPONSAVEL_CHAVE) tot
                                                ORDER BY tot.CD_CHAVE DESC) lin) res
                                ORDER BY res.LINHA ASC) totlin
                        WHERE totlin.LINHA BETWEEN $var2 AND $var1";
    
    // APLICA OS FILTROS CASO EXISTA ALGUM, SE FOR ENVIADO COMO ALL, MOSTRA TODOS
    if ($cd_categoria == 'all') {

        $cons_tabela_chave .= " ORDER BY totlin.CD_CHAVE DESC";

    } else {

        $cons_tabela_chave .= " AND totlin.CD_CATEGORIA = '$cd_categoria'
                                ORDER BY totlin.CD_CHAVE DESC";

    }
 
    $res = oci_parse($conn_ora, $cons_tabela_chave);
    oci_execute($res);

    //QUANTIDADE DE PAGINAS
    $quantidade_qtd_pag = ceil($row_qtd['QTD'] / $qtd_paginacao);
    $min_link = 2;
    $max_link = 2;
    $proximo = $pagina + 1;
    $antes = $pagina - 1;

?>

<!--PAGINAÇÃO-->
<nav aria-label="...">

  <ul class="pagination">
    <li class="page-item">
      <!--VOLTA PRA PRIMEIRA PAGINA-->
      <a class="page-link" style="cursor: pointer;" tabindex="-1" 
          onclick="carrega_tabela_chave(1)">Primeira</a>
    </li>

    <?php

    if ($antes <= 0) {

      echo '<li hidden class="page-item"><a style="cursor: pointer;" class="page-link" onclick="carrega_tabela_chave('. $antes .')"><i class="fa-solid fa-angle-left"></i></a></li>';

    } else {

        ?>
        <!--VOLTA UMA PAGINA ANTES DA ATUAL-->
        <li class="page-item"><a style="cursor: pointer;" class="page-link" onclick="carrega_tabela_chave(<?php echo $antes; ?>)"><i class="fa-solid fa-angle-left"></i></a></li>
    
        <?php
    }
        ?>

    <?php 
   
    for($pagina_ant = $pagina - $min_link; $pagina_ant <= $pagina - 1; $pagina_ant++){

        if($pagina_ant >= 1){

            echo '<li class="page-item"><a style="cursor: pointer;" class="page-link"onclick="carrega_tabela_chave('. $pagina_ant . ')">' . $pagina_ant . '</a></li>';

        }
        

    }
   
    ?>
    
    <!--PAGINA ATUAL DO USUARIO-->
    <li class="page-item active">
      <a class="page-link"><?php echo $pagina; ?><span class="sr-only">(Pagina Atual do usuario)</span></a>
    </li>


    <?php

        for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_link; $pag_dep++){

            if($pag_dep <= $quantidade_qtd_pag){

                echo '<li class="page-item"><a style="cursor: pointer;" class="page-link" onclick="carrega_tabela_chave('. $pag_dep . ')">'. $pag_dep . '</a></li>';

            }
            

        }

    ?>

    <?php

        if($proximo >= $quantidade_qtd_pag){

          echo '<li hidden class="page-item"><a style="cursor: pointer;" class="page-link" onclick="carrega_tabela_chave('. $antes; ')"><i class="fa-solid fa-angle-right"></i></a></li>';

        }else {
    ?>

     <!--ADIANTA UMA PAGINA DEPOIS DA ATUAL-->
    <li class="page-item"><a style="cursor: pointer;" class="page-link" onclick="carrega_tabela_chave(<?php echo $proximo; ?>)"><i class="fa-solid fa-angle-right"></i></a></li>

    <?php 

      }

    ?>

    <li class="page-item">
      <!--VAI PARA ULTIMA PAGINA-->
      <a class="page-link" style="cursor: pointer;" onclick="carrega_tabela_chave(<?php echo $quantidade_qtd_pag; ?>)">Ultima</a>
    </li>

  </ul>

</nav>

<table class="table table-striped" style="text-align: center">

    <thead>

        <th class="p-2" style="text-align: center; white-space: nowrap;"><input class="check_box" onclick="toggle_checkbox()" id="checkbox_todos" type="checkbox"> Todos</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Código</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Descrição</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Categoria</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Status</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Responsável</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Data de Retirada</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Tempo</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Registros</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">QR Code</th>
        <?php if($_SESSION['SN_USUARIO_ADM'] == 'S') { ?>
            <th class="p-2" style="text-align: center; white-space: nowrap;">Opções</th>
        <?php } ?>

    </thead>

    <tbody>

        <?php

            while($row = oci_fetch_array($res)) {

                echo '<tr style="text-align: center">';

                    echo '<td class="align-middle"><input class="check_box ckb-selecionados" value="'.$row['CD_CHAVE'].'"type="checkbox"></td>';
                    echo '<td class="align-middle">'. $row['CD_CHAVE'] .'</td>';

                    if($_SESSION['SN_USUARIO_ADM'] == 'S') {

                        echo '<td class="align-middle" id="'. $row['CD_CHAVE'] .'" style="cursor: pointer;" 
                            ondblclick="editar_chave(\''.$row['CD_CHAVE'].'\',\''. $row['DS_CHAVE'] .'\')">'. 
                                $row['DS_CHAVE'] 
                            .'</td>';
                    } else {

                        echo '<td class="align-middle" id="'. $row['CD_CHAVE'] .'">'. 
                                $row['DS_CHAVE'] 
                            .'</td>';

                    }

                    echo '<td class="align-middle">'. $row['DS_CATEGORIA'] .'</td>';
                    echo '<td class="align-middle">';

                        if ($row['TP_STATUS'] == 'A' && $row['RESPONSAVEL'] == 'SEM RESPONSÁVEL') {

                            $tp_acao = 'stt';

                            if($_SESSION['SN_USUARIO_ADM'] == 'S') {

                                echo '<i style="cursor: pointer; font-size: 25px; color: green;" onclick="chama_alerta(' . $row['CD_CHAVE'] . ',\'' . $tp_acao . '\',\'' . $row['TP_STATUS'] . '\')" class="fa-solid fa-toggle-on"></i>';

                            } else {

                                echo '<i style="font-size: 25px; color: #A4A4A4;" class="fa-solid fa-toggle-on"></i>';

                            }

                        } else if ($row['TP_STATUS'] != 'A'  && $row['RESPONSAVEL'] == 'SEM RESPONSÁVEL') {

                            $tp_acao = 'stt';

                            if($_SESSION['SN_USUARIO_ADM'] == 'S') {

                                echo '<i style="cursor: pointer; font-size: 25px; color: #e05757;" onclick="chama_alerta(' . $row['CD_CHAVE'] . ',\'' . $tp_acao . '\',\'' . $row['TP_STATUS'] . '\')" class="fa-solid fa-toggle-off"></i>';

                            } else {

                                echo '<i style="font-size: 25px; color: #A4A4A4;" class="fa-solid fa-toggle-off"></i>';

                            }
                        } else {

                            echo '<i style="font-size: 25px; color: #A4A4A4;" class="fa-solid fa-toggle-on"></i>';

                        }
                        
                    echo '</td>';
                    echo '<td class="align-middle">'. $row['RESPONSAVEL'] .'</td>';
                    echo '<td class="align-middle">'. $row['RETIRADA'] .'</td>';
                    echo '<td class="align-middle">'. $row['TEMPO'] .'</td>';
                    echo '<td class="align-middle">'. $row['QTD_REGISTROS'] .'</td>';
                    echo '<td onclick="modal_qrcode(' . $row['CD_CHAVE'] . ',\'' . $row['DS_CHAVE'] . '\',\'' . $row['DS_CATEGORIA'] . '\')" class="align-middle"><button class="btn btn-primary"><i class="fa-solid fa-qrcode"></i></button></td>';

                    if($_SESSION['SN_USUARIO_ADM'] == 'S') {

                        echo '<td class="align-middle">';

                            if ($row['QTD_REGISTROS'] == 0) {

                                $tp_acao = 'del';

                                echo '<button onclick="chama_alerta('.  $row['CD_CHAVE'] . ',\'' . $tp_acao . '\')" class="btn btn-adm"> <i class="fa-solid fa-trash-can"></i></button>';

                            } else {

                                echo ' <button class="btn btn-secondary"><i class="fa-solid fa-trash-can"></i></button>';

                            }

                        echo '</td>';

                    }

                echo '</tr>';

            }

        ?>

    </tbody>

</table>