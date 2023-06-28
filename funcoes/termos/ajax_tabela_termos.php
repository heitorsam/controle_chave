<?php

    include '../../conexao.php';

    include '../../config/mensagem/ajax_mensagem_alert.php';

    $cons_tabela_termos = "SELECT res.CD_CHAVE,
                                res.DS_CHAVE,
                                res.DS_CATEGORIA,
                                func.CHAPA,
                                func.NM_FUNCIONARIO,
                                func.CHAPA,
                                uni.NM_SETOR,
                                res.ASSIN_REGISTRO,
                                res.TP_CADEADO,
                                res.DATA_ASSINATURA
                            FROM (SELECT reg.CD_CHAVE,
                                        chv.DS_CHAVE,
                                        SUBSTR(CD_USUARIO_MV, 1, LENGTH(CD_USUARIO_MV) - 2) AS CD_USUARIO_MV,
                                        cat.DS_CATEGORIA,
                                        reg.ASSIN_REGISTRO,
                                        reg.TP_CADEADO,
                                        TO_CHAR(reg.HR_CADASTRO, 'DD/MM/YYYY') AS DATA_ASSINATURA
                                FROM controle_chave.REGISTRO reg
                                INNER JOIN controle_chave.CHAVE chv
                                    ON reg.CD_CHAVE = chv.CD_CHAVE
                                INNER JOIN controle_chave.CATEGORIA cat
                                    ON chv.CD_CATEGORIA = cat.CD_CATEGORIA
                                WHERE LENGTH(reg.ASSIN_REGISTRO) > 0) res
                            INNER JOIN dbamv.STA_TB_FUNCIONARIO func
                            ON res.CD_USUARIO_MV = func.CHAPA
                            INNER JOIN dbamv.SETOR uni
                            ON func.CD_SETOR = uni.CD_SETOR";

    $res_termos = oci_parse($conn_ora, $cons_tabela_termos);
    oci_execute($res_termos);

?>

<table class="table table-striped" style="text-align: center">

    <thead>

        <th class="p-2" style="text-align: center; white-space: nowrap;">Código</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Chave</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Categoria</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Matrícula</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Responsável</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Termo</th>

    </thead>

    <tbody>

        <?php

            while($row = oci_fetch_array($res_termos)) {
                
                echo '<tr style="text-align: center">';

                    echo '<td class="align-middle">'. $row['CD_CHAVE'] .'</td>';
                    echo '<td class="align-middle">'. $row['DS_CHAVE'] .'</td>';
                    echo '<td class="align-middle">'. $row['DS_CATEGORIA'] .'</td>';
                    echo '<td class="align-middle">'. $row['CHAPA'] .'</td>';
                    echo '<td class="align-middle">'. $row['NM_FUNCIONARIO'] .'</td>';

                    // PEGA O VALOR EM BLOB E PASSA EM STRING
                    $img = $row['ASSIN_REGISTRO']->load();
                    $imagem = base64_encode($img);

                    echo '<td onclick="abrir_modal_termo(\''. $row['NM_FUNCIONARIO'] .'\', \''. $row['CHAPA'] .'\', \''. $row['NM_SETOR'] .'\', \''. $row['TP_CADEADO'] .'\', \''. $imagem .'\', \''. $row['DATA_ASSINATURA'] .'\')" class="align-middle"><button class="btn btn-primary"><i class="fa-solid fa-file-signature"></i></button></td>';

                echo '</tr>';

            }

        ?>

    </tbody>

</table>