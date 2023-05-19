<?php

    include '../../conexao.php';

    include '../../config/mensagem/ajax_mensagem_alert.php';

    $cons_categorias = "SELECT cat.CD_CATEGORIA,
                               cat.DS_CATEGORIA,
                               cat.TP_STATUS,
                               (SELECT COUNT(CD_CATEGORIA) AS QNTD_CHAVES
                               FROM controle_chave.CHAVE ch
                               WHERE ch.CD_CATEGORIA = cat.CD_CATEGORIA) AS QNTD_CHAVES
                        FROM controle_chave.CATEGORIA cat";
    
    $res_cons_tabela_categoria = oci_parse($conn_ora, $cons_categorias);

    oci_execute($res_cons_tabela_categoria);

?>

<table  class="table table-striped" style="text-align: center">

    <thead>

        <th class="p-2" style="text-align: center; white-space: nowrap;">Código</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Descrição</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Status</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Chaves</th>
        <th class="p-2" style="text-align: center; white-space: nowrap;">Opções</th>

    </thead>

    <tbody>
        <?php

            while($row = oci_fetch_array($res_cons_tabela_categoria)) {

                echo '<tr style="text-align: center">';

                    echo '<td class="align-middle">'. $row['CD_CATEGORIA'] .'</td>';
                    echo '<td id="'. $row['CD_CATEGORIA'] .'" style="cursor: pointer;" 
                            ondblclick="editar_categoria(\''.$row['CD_CATEGORIA'].'\',\''. $row['DS_CATEGORIA'] .'\')" class="align-middle">'. $row['DS_CATEGORIA'] .'
                          </td>';
                    echo '<td class="align-middle">';
                    
                        if ($row['TP_STATUS'] == 'A') {

                            $tp_acao = 'stt';

                            echo '<i style="cursor: pointer; font-size: 25px; color: green;" onclick="chama_alerta(' . $row['CD_CATEGORIA'] . ',\'' . $tp_acao . '\',\'' . $row['TP_STATUS'] . '\')" class="fa-solid fa-toggle-on"></i>';

                        } else {

                            $tp_acao = 'stt';

                            echo '<i style="cursor: pointer; font-size: 25px; color: #e05757;" onclick="chama_alerta(' . $row['CD_CATEGORIA'] . ',\'' . $tp_acao . '\',\'' . $row['TP_STATUS'] . '\')" class="fa-solid fa-toggle-off"></i>';

                        }

                    echo '</td>';
                    echo '<td class="align-middle">'. $row['QNTD_CHAVES'] .'</td>';
                    echo '<td class="align-middle">';

                        if ($row['QNTD_CHAVES'] == 0) {

                            $tp_acao = 'del';

                            echo '<button onclick="chama_alerta('.  $row['CD_CATEGORIA'] . ',\'' . $tp_acao . '\')" class="btn btn-adm"> <i class="fa-solid fa-trash-can"></i></button>';

                        } else {

                            echo ' <button class="btn btn-secondary"><i class="fa-solid fa-trash-can"></i></button>';

                        }
                        
                    echo '</td>';

                echo '</tr>';

            }

        ?>
    </tbody>

</table>