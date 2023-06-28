<?php

include 'cabecalho.php';

?>

<!-- MODAL ASSINATURA -->
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

                    <input id="tp_cadeado_1" name="tp_cadeado" value="S" type="radio" style="font-size: 3px;" disabled>
                    <label>CADEADO DA SANTA CASA</label>

                </div>

                <div>

                    <input id="tp_cadeado_2" name="tp_cadeado" value="P" type="radio" style="font-size: 3px;" disabled>
                    <label>CADEADO PARTICULAR (FUNCIONARIO)</label>

                </div>

                <div style="font-weight: bold;">

                    Atenção!<br>
                    Não deixe objetos de valor dentro do armário.

                </div>

                <div>

                    São José dos Campos, <label id="dia">25</label> de <label id="mes">Maio</label> de <label id="ano">2023</label>

                </div>

                <div class="div_br"></div>

                <img id="mostra_assinatura" style="width: 90%;" />

            </div>

        </div>

    </div>

</div>

<h11><i class="fa-solid fa-file-signature"></i> Termos</h11>
<div class='espaco_pequeno'></div>
<h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply efeito-zoom" aria-hidden="true"></i> Voltar</a></h27>

<div class="div_br"></div>
<div class="div_br"></div>

<div id="carrega_tabela_termos"></div>

<?php

include 'rodape.php';

?>

<script>
    window.onload = function() {

        $('#carrega_tabela_termos').load('funcoes/termos/ajax_tabela_termos.php');

    }

    function abrir_modal_termo(nm_funcionario, matricula, setor, tp_cadeado, assinatura, dt_assinatura) {

        array_data = dt_assinatura.split('/');

        document.getElementById('dia').innerText = array_data[0];

        var mes = '';

        switch (dt_assinatura[1]) {

            case '1':
                mes = 'Janeiro';
                break
            case '2':
                mes = 'Fevereiro';
                break
            case '3':
                mes = 'Março';
                break
            case '4':
                mes = 'Abril';
                break
            case '5':
                mes = 'Maio';
                break
            case '6':
                mes = 'Junho';
                break
            case '7':
                mes = 'Julho';
                break
            case '8':
                mes = 'Agosto';
                break
            case '9':
                mes = 'Setembro';
                break
            case '10':
                mes = 'Outubro';
                break
            case '11':
                mes = 'Novembro';
                break
            case '12':
                mes = 'Dezembro';
                break
        }
        
        document.getElementById('mes').innerText = mes;
        document.getElementById('ano').innerText = array_data[2];
        document.getElementById('nm_func_assinatura').value = nm_funcionario;
        document.getElementById('registro_assinatura').value = matricula;
        document.getElementById('setor_assinatura').value = setor;
        var mostra_assinatura = document.getElementById('mostra_assinatura');

        if (tp_cadeado == 'S') {

            document.getElementById('tp_cadeado_1').checked = true;

        } else {

            document.getElementById('tp_cadeado_2').checked = true;

        }

        mostra_assinatura.src = 'data:image;base64,' + assinatura;

        $('#modal_termo').modal();

    }
</script>