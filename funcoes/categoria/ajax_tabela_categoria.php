
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 23px;
    }

    .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #e05757;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #32BB53;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #32BB53;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* ANIMAÇÃO */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>

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

                            echo '<label class="switch">';
                                echo '<input type="checkbox" checked>';
                                echo '<span onclick="alterar_status_categoria('. $row['CD_CATEGORIA'] .')" class="slider round"></span>';
                            echo '</label>';


                        } else {

                            echo '<label class="switch">';
                                echo '<input type="checkbox">';
                                echo '<span class="slider round"></span>';  
                            echo '</label>';

                        }

                    echo '</td>';
                    echo '<td class="align-middle">'. $row['QNTD_CHAVES'] .'</td>';
                    echo '<td class="align-middle">';

                        if ($row['QNTD_CHAVES'] == 0) {

                            echo '<button onclick="chama_alerta_exclusao('.  $row['CD_CATEGORIA'] .')" class="btn btn-adm"> <i class="fa-solid fa-trash-can"></i></button>';

                        } else {

                            echo ' <button class="btn btn-secondary"><i class="fa-solid fa-trash-can"></i></button>';

                        }
                        
                    echo '</td>';

                echo '</tr>';
            }

        ?>
    </tbody>

</table>