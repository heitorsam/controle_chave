<!--MODAL TERMO-->
<div class="modal fade" id="modal_termo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content" id="modal_content" style="width: 75%; margin: 0 auto;">

            <div class="modal-header">

                <h5 class="modal-title" id="titulo_modal">Registro de Armário</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div id="conteudo_modal" class="modal-body">

                <div class="row">

                    <div class="col-md-12" style="margin: 0 auto;">

                        Funcionário:
                        <input id="nm_func_assinatura" type="text" class="form form-control" disabled>

                    </div>

                </div>

                <div class="div_br"></div>

                <div class="row">

                    <div class="col-md-6">

                        Registro:
                        <input id="registro_assinatura" type="text" class="form form-control" disabled>

                    </div>

                    <div class="col-md-6">

                        Setor:
                        <input id="setor_assinatura" type="text" class="form form-control" disabled>

                    </div>

                </div>

                <div class="div_br"></div>

                <div class="row">

                    <div class="col-md-8" style="margin: 0 auto; margin-top: 40px; margin-bottom: 40px; font-size: 17px;">

                        <p style="display: block; margin: 0 auto; width: 100%; font-size: 18px; font-family: Georgia, serif; color: #1f1f1f;">
                            &nbsp &nbsp &nbsp &nbspDeclaro que recebi o armário nº <?php echo '2'; ?> com cadeado e duas cópias
                            de chaves para uso exclusivo neste armário, sendo uma cópia reserva que fica no
                            setor de Segurança de Patrimonial para ser usada em caso de real necessidade.<br>
                            &nbsp &nbsp &nbsp &nbspEstou ciente da obrigatoriedade de conservação e limpeza do mesmo, ficando
                            desde já autorizado o desconto em folha de pagamento se porventura causar algum
                            dano ao armário ou perda da chave e do cadeado.<br>
                            &nbsp &nbsp &nbsp &nbspNão é permitido trocar de armário sem autorização da segurança Patrimonial
                            e nem colar adesivos no mesmo.
                        </p>

                    </div>

                </div>

                <div>

                    <input name="tp_cadeado" value="S" type="radio" style="font-size: 3px;"> 
                    <label>CADEADO DA SANTA CASA</label>

                </div>

                <div>

                    <input name="tp_cadeado" value="P" type="radio" style="font-size: 3px;"> 
                    <label>CADEADO PARTICULAR (FUNCIONARIO)</label>

                </div>

                <div style="font-weight: bold;">

                    Atenção!<br>
                    Não deixe objetos de valor dentro do armário.

                </div>

                <div>

                    São José dos Campos, 21 de Junho de 2023

                </div>


                <div style="float: right;">

                    <button onclick="abrir_modal_assinatura()" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Assinar</button>

                </div>

            </div>

        </div>

    </div>

</div>


<!--MODAL ASSINATURA-->
<div class="modal fade" id="modal_assinatura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content" id="modal_content">

            <div class="modal-header">

                <h5 class="modal-title" id="titulo_modal">Assinatura Termo</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div id="conteudo_modal_assinatura" class="modal-body" style="width: 100%;">

                <canvas id="canvas" width="800" height="200" style="width: 100%; height: auto;"></canvas>

                <div class="div_br"></div>

                <button onclick="inserir_registro_com_assinatura()" style="float: right;" class="btn btn-primary"><i class="fa-solid fa-check"></i> Concluir</button>

                <button style="float: right; margin-right: 10px;" class="btn btn-primary" id="btn_limpar"><i class="fa-solid fa-broom"></i> Limpar</button>

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
        <input id="ds_categoria" value="<?php echo $ds_categoria; ?>" class="form form-control" type="text" readonly>
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
        <input value="<?php if ($row['CONTEM_REGISTRO'] == 'S') {
                            echo $informacoes['NR_RAMAL'];
                        } ?>" class="form form-control" type="text" id="inpt_ramal">
    </div>

    <div class="col-md-6">
        Contato:
        <input value="<?php if ($row['CONTEM_REGISTRO'] == 'S') {
                            echo $informacoes['NR_CONTATO'];
                        } ?>" class="form form-control" type="text" id="inpt_contato">
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