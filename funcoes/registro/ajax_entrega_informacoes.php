<!--MODAL ASSINATURA-->
<div class="modal fade" id="modal_assinatura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content" id="modal_content">

            <div class="modal-header">

                <h5 class="modal-title" id="titulo_modal">Registro de Armário</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div id="conteudo_modal" class="modal-body">

                ok

            </div>

        </div>

    </div>

</div>

<?php

    include '../../conexao.php';

    $ds_chave = $_GET['dschave'];
    $ds_categoria = $_GET['dscategoria'];
    $cracha = $_GET['cracha'];

    // PUXA AS ULTIMAS INFORMAÇÕES DE REGISTRO CASO TENHA PARA PREENCHER OS INPUTS AUTOMATICAMENTE
    $contem_informacao = "SELECT 
                                CASE
                                    WHEN COUNT(*) = 0 THEN 'N'
                                    ELSE 'S'
                                END AS CONTEM_REGISTRO
                            FROM (SELECT reg.CD_SETOR_MV,
                                        uni.NM_SETOR,
                                        reg.NR_RAMAL,
                                        reg.NR_CONTATO
                                FROM controle_chave.REGISTRO reg
                                INNER JOIN dbamv.SETOR uni
                                    ON reg.CD_SETOR_MV = uni.CD_SETOR
                                WHERE reg.CD_REGISTRO IN (SELECT MAX(CD_REGISTRO)
                                                            FROM controle_chave.REGISTRO reg
                                                            WHERE reg.CD_USUARIO_MV = '$cracha')) res";

    $res = oci_parse($conn_ora, $contem_informacao);
    oci_execute($res);

    $row = oci_fetch_array($res);

    if (!empty($row)) {

        $cons_informacoes = "SELECT reg.CD_SETOR_MV,
                                    uni.NM_SETOR,
                                    reg.NR_RAMAL,
                                    reg.NR_CONTATO
                            FROM controle_chave.REGISTRO reg
                            INNER JOIN dbamv.SETOR uni
                                ON reg.CD_SETOR_MV = uni.CD_SETOR
                            WHERE reg.CD_REGISTRO IN (SELECT MAX(CD_REGISTRO)
                                                    FROM controle_chave.REGISTRO reg
                                                    WHERE reg.CD_USUARIO_MV = '$cracha')";

        $res_info = oci_parse($conn_ora, $cons_informacoes);
        oci_execute($res_info);

        $informacoes = oci_fetch_array($res_info);

    }

?>

<div class="div_br"></div>

<div class="row">

    <div class="col-md-6 col-sm-12">
        <input value="<?php echo $ds_chave; ?>" class="form form-control" type="text" readonly>
    </div>

    <div class="col-md-6 col-sm-12">
        <input value="<?php echo $ds_categoria; ?>" class="form form-control" type="text" readonly>
    </div>

</div>

<div class="div_br"></div>

<div class="row">

    <div class="col-md-4">
        Setor:
        <select class="form form-control" name="" id="selecao_setores">

        </select>
    </div>

    <div class="col-md-2">
        Ramal:
        <input value="<?php if ($row['CONTEM_REGISTRO'] == 'S') { echo $informacoes['NR_RAMAL']; }?>" class="form form-control" type="text" id="inpt_ramal">
    </div>

    <div class="col-md-6">
        Contato:
        <input value="<?php if ($row['CONTEM_REGISTRO'] == 'S') { echo $informacoes['NR_CONTATO']; }?>" class="form form-control" type="text" id="inpt_contato">
    </div>

</div>

<div class="div_br"></div>

<div class="row">

    <div class="col-md-12">
        Observação:
        <input class="form form-control" type="text" id="inpt_observacao">
    </div>

</div>

<div class="div_br"></div>

<div style="width: 100%;">

    <button onclick="registrar_entrega()" id="btn_concluir_registro" style="float: right;" class="botao_home"><i class="fa-solid fa-arrow-right-from-bracket"></i> Retirar</button>

</div>