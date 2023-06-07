<?php

    include '../../conexao.php';

    $categoria = $_GET['cdcategoria'];

    if ($categoria == 'all') {

        $cons_categorias = "SELECT cat.CD_CATEGORIA,
                                   cat.DS_CATEGORIA
                            FROM controle_chave.CATEGORIA cat
                            ORDER BY cat.DS_CATEGORIA DESC";

        echo '<option value="all" selected>Todas</option>';

    } else {

        // REALIZA CONSULTA PARA BUSCAR A DESCRIÇÃO DA CATEGORIA PARA COLOCAR NO OPTION DO FILTRO ATUAL
        $busca_ds_categoria_filtro = "SELECT cat.DS_CATEGORIA
                                      FROM controle_chave.CATEGORIA cat
                                      WHERE cat.CD_CATEGORIA = '$categoria'";

        $res_categoria = oci_parse($conn_ora, $busca_ds_categoria_filtro);
        oci_execute($res_categoria);

        $resp_categoria = oci_fetch_array($res_categoria);

        $cons_categorias = "SELECT cat.CD_CATEGORIA,
                                   cat.DS_CATEGORIA
                            FROM controle_chave.CATEGORIA cat
                            WHERE cat.CD_CATEGORIA <> '$categoria'
                            ORDER BY cat.DS_CATEGORIA DESC";

        echo '<option value="all" selected>Todas</option>';
        echo '<option value="'.$categoria.'" selected>'. $resp_categoria['DS_CATEGORIA'] .'</option>';

    }

    $res = oci_parse($conn_ora, $cons_categorias);
    oci_execute($res);

    while($row = oci_fetch_array($res)) {

        echo '<option value="'. $row['CD_CATEGORIA'] .'">'.$row['DS_CATEGORIA'].'</option>';

    }

?>