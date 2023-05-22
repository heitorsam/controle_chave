<?php

    include '../../conexao.php';

    include '../../config/mensagem/ajax_mensagem_alert.php';

    $cons_tabela_chave = "SELECT ch.CD_CHAVE,
                                ch.DS_CHAVE,
                                cat.DS_CATEGORIA,
                                ch.TP_STATUS,
                                (SELECT COUNT(reg.CD_REGISTRO)
                                FROM controle_chave.REGISTRO reg
                                WHERE ch.CD_CHAVE = reg.CD_CHAVE) AS QTD_REGISTROS
                            FROM controle_chave.CHAVE ch
                            INNER JOIN controle_chave.CATEGORIA cat
                                ON ch.CD_CATEGORIA = cat.CD_CATEGORIA";

    $res = oci_parse($conn_ora, $cons_tabela_chave);

    oci_execute($res);

?>

<table class="table table-striped" style="text-align: center">

    <thead>

        <th class="p-2" style="text-align: center; white-space: nowrap;">Código</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Descrição</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Categoria</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Status</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Registros</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">QR Code</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Opções</th>

    </thead>

    <tbody>

        <?php

            while($row = oci_fetch_array($res)) {

                echo '<tr style="text-align: center">';

                    echo '<td class="align-middle">'. $row['CD_CHAVE'] .'</td>';
                    echo '<td class="align-middle" id="'. $row['CD_CHAVE'] .'" style="cursor: pointer;" 
                        ondblclick="editar_chave(\''.$row['CD_CHAVE'].'\',\''. $row['DS_CHAVE'] .'\')">'. 
                            $row['DS_CHAVE'] 
                        .'</td>';
                    echo '<td class="align-middle">'. $row['DS_CATEGORIA'] .'</td>';
                    echo '<td class="align-middle">';

                        if ($row['TP_STATUS'] == 'A') {

                            $tp_acao = 'stt';

                            echo '<i style="cursor: pointer; font-size: 25px; color: green;" onclick="chama_alerta(' . $row['CD_CHAVE'] . ',\'' . $tp_acao . '\',\'' . $row['TP_STATUS'] . '\')" class="fa-solid fa-toggle-on"></i>';

                        } else {

                            $tp_acao = 'stt';

                            echo '<i style="cursor: pointer; font-size: 25px; color: #e05757;" onclick="chama_alerta(' . $row['CD_CHAVE'] . ',\'' . $tp_acao . '\',\'' . $row['TP_STATUS'] . '\')" class="fa-solid fa-toggle-off"></i>';

                        }
                        
                    echo '</td>';
                    echo '<td class="align-middle">'. $row['QTD_REGISTROS'] .'</td>';
                    echo '<td class="align-middle"><button class="btn btn-primary"><i class="fa-solid fa-qrcode"></i></button></td>';

                    echo '<td class="align-middle">';

                        if ($row['QTD_REGISTROS'] == 0) {

                            $tp_acao = 'del';

                            echo '<button onclick="chama_alerta('.  $row['CD_CHAVE'] . ',\'' . $tp_acao . '\')" class="btn btn-adm"> <i class="fa-solid fa-trash-can"></i></button>';

                        } else {

                            echo ' <button class="btn btn-secondary"><i class="fa-solid fa-trash-can"></i></button>';

                        }

                    echo '</td>';

                echo '</tr>';

            }

        ?>

    </tbody>

</table>