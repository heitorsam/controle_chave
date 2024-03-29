<h11><i class="fa-solid fa-key efeito-zoom"></i> Retirada</h11>
<div class="div_br"></div>

<div class="row">

    <div class="col-sm-3">
        Chave:
        <input id="cd_chave" class="form form-control" type="number">
    </div>

</div>

<div class="div_br"></div>

<div id="carrega_entrega_chave"></div>

<script>
    var inpt_chave = document.getElementById('cd_chave');

    var cd_chave = inpt_chave.value;

    inpt_chave.addEventListener('change', function() {

        var cracha = document.getElementById('inpt_cracha');

        var acao_entrega = document.getElementById('carrega_entrega_chave');
        acao_entrega.innerText = '';

        var cd_chave = inpt_chave.value;

        $.post('funcoes/registro/valida_chave.php', {
            idchave: cd_chave
        }, function(chave) {

            if (chave == 'Sucesso') {

                $.post('funcoes/registro/busca_registros_chave.php?idchave=' + cd_chave, function(data) {

                    var dados = JSON.parse(data);
                    var ds_chave = dados['DS_CHAVE'];
                    var ds_categoria = dados['DS_CATEGORIA'];

                    if (ds_chave.indexOf(' ') != -1) {

                        ds_chave = ds_chave.replace(' ', '%20');

                    }

                    if (ds_categoria.indexOf(' ') != -1) {

                        ds_categoria = ds_categoria.replace(' ', '%20');

                    }

                    // CHAMAR AJAX ENTREGA
                    $.get('funcoes/registro/ajax_entrega_informacoes.php?dschave=' + ds_chave + '&dscategoria=' + ds_categoria + '&cracha=' + cracha.value, function(data) {

                        document.getElementById('carrega_entrega_chave').innerHTML = data;
                        document.getElementById('registro_assinatura').value = cracha.value;

                        var nm_resumido = document.getElementById('nm_func_resumido').value
                        document.getElementById('nm_func_assinatura').value = nm_resumido;

                        // PREENCHE OS SETORES DO MV NO SELECT
                        $('#selecao_setores').load('funcoes/registro/query_setores.php?cracha=' + cracha.value);

                        var inpt_setores = document.getElementById('selecao_setores');

                        // ADICIONA O SETOR NA MODAL DE ASSINATURA
                        inpt_setores.addEventListener('change', function() {

                            var option = inpt_setores.children[inpt_setores.selectedIndex];
                            document.getElementById('setor_assinatura').value = option.textContent;

                        })

                    });

                })

            } else if (chave == 'Chave em uso') {

                //MENSAGEM            
                var_ds_msg = 'Chave%20já%20está%20em%20uso.';
                var_tp_msg = 'alert-danger';

                $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);

            } else if (chave == 'Não cadastrada') {

                //MENSAGEM            
                var_ds_msg = 'Chave%20inexistente.';
                var_tp_msg = 'alert-danger';

                $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);

            } else if (chave == 'Chave inativa') {

                //MENSAGEM            
                var_ds_msg = 'Chave%20inativa%20no%20sistema.';
                var_tp_msg = 'alert-danger';

                $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);


            } else {

                console.log(chave)

                //MENSAGEM            
                var_ds_msg = 'Erro%20ao%20buscar%20chave.';
                var_tp_msg = 'alert-danger';

                $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);

            }

        })

    })

    function verificar_proxima_etapa() {

        // BUSCAR PELA CHAVE, O CD CATEGORIA, VERIFICAR SE O CD CATEGORIA É DOS EPIS E SE NÃO TEM NENHUMA ASSINATURA
        var cracha_cons_assinatura = document.getElementById('inpt_cracha').value;

        $.ajax({
            url: "funcoes/registro/verificar_existe_assinatura.php",
            method: "GET",
            data: {
                cracha: cracha_cons_assinatura
            },
            cache: false,
            success(res) {

                if (res == 'S' || res == 'N') {

                    var ds_categoria = document.getElementById('ds_categoria').value;
            
                    if (ds_categoria == 'Armário EPIs' && res == 'S') {
            
                        $('#modal_termo').modal('show');
            
                    } else {
            
                        registrar_entrega();
            
                    }

                } else {

                    //MENSAGEM            
                    var_ds_msg = 'Erro%20ao%20prosseguir%20registro.';
                    var_tp_msg = 'alert-danger';

                    $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);


                }

            }
        })
    
    }

    function abrir_modal_assinatura() {

        var cad_santacasa = document.getElementById('cad_santacasa');
        var cad_particular = document.getElementById('cad_particular');

        // OBRIGA A PREENCHER ALGUM TIPO DE CADEADO PARA PROSSEGUIR
        if (cad_santacasa.checked == true || cad_particular.checked == true) {

            $('#modal_termo').modal('hide');
            $('#modal_assinatura').modal('show');
    
            inicializarCanvasAssinatura();

        } else {

            //MENSAGEM            
            var_ds_msg = 'Necessário%20preenchimento%20do%20tipo%20de%20cadeado.';
            var_tp_msg = 'alert-danger';

            $('#resp_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);

        }

    }

    function inserir_registro_com_assinatura() {

        var canvas = document.getElementById('canvas');
        var ctx = canvas.getContext('2d');

        var tp_cadeado = document.querySelector('input[name="tp_cadeado"]:checked').value;

        var base64_assinatura = canvas.toDataURL('image/png');
        console.log(base64_assinatura);

        $('#modal_assinatura').modal('hide');

        // PEGAR AS INFORMAÇÕES DO INPUT E DAR O INSERT COM A ASSINATURA...        
        var setor = document.getElementById('selecao_setores');
        var ramal = document.getElementById('inpt_ramal');
        var contato = document.getElementById('inpt_contato');
        var observacao = document.getElementById('inpt_observacao');
        var cracha = document.getElementById('inpt_cracha');
        
        $.ajax({
            url: "funcoes/registro/insert_registro_entrega.php",
            method: "POST",
            data: {
                setor: setor.value,
                ramal: ramal.value,
                contato: contato.value,
                observacao: observacao.value,
                cd_chave: inpt_chave.value,
                cracha: cracha.value,
                assinatura: base64_assinatura,
                tp_cadeado: tp_cadeado
            },
            cache: false,
            success(res) {

                alert(res);

           }
        })

    }

    function inicializarCanvasAssinatura() {

        var canvas = document.getElementById("canvas");
        var context = canvas.getContext("2d");
  
        var isDrawing = false;
        var lastX = 0;
        var lastY = 0;

        // PEGA O TAMANHO CORRETO DA TELA PARA NÃO PERDER A QUALIDADE DO PIXEL
        var scale = window.devicePixelRatio || 1;
        canvas.width *= scale;
        canvas.height *= scale;
        context.strokeStyle = "#5b79b4";
        context.scale(scale, scale);

        function getMousePos(canvas, event) {

            var rect = canvas.getBoundingClientRect();

            return {

                x: (event.clientX - rect.left) * (canvas.width / rect.width),
                y: (event.clientY - rect.top) * (canvas.height / rect.height)

            };

        }

        function startDrawing(event) {

            isDrawing = true;
            var pos = getMousePos(canvas, event);
            lastX = pos.x;
            lastY = pos.y;

        }

        function draw(event) {

            if (!isDrawing) return;

            var pos = getMousePos(canvas, event);
            var currentX = pos.x;
            var currentY = pos.y;

            context.beginPath();
            context.moveTo(lastX, lastY);
            context.lineTo(currentX, currentY);
            context.stroke();
            context.closePath();

            lastX = currentX;
            lastY = currentY;

        }

        function stopDrawing() {

            isDrawing = false;

        }

        function touchStart(event) {

            var touch = event.touches[0];
            var pos = getMousePos(canvas, touch);
            startDrawing(pos);

        }

        function touchMove(event) {

            var touch = event.touches[0];
            var pos = getMousePos(canvas, touch);
            draw(pos);
            event.preventDefault();

        }

        canvas.addEventListener("mousedown", startDrawing);
        canvas.addEventListener("mousemove", draw);
        canvas.addEventListener("mouseup", stopDrawing);

        canvas.addEventListener("touchstart", function(event) {

            var touch = event.touches[0];
            startDrawing(touch);

        });

        canvas.addEventListener("touchmove", function(event) {

            var touch = event.touches[0];
            draw(touch);
            event.preventDefault();

        });

        canvas.addEventListener("touchend", stopDrawing);

        document.getElementById("btn_limpar").addEventListener("click", function() {

            context.clearRect(0, 0, canvas.width, canvas.height);

        });

    }

    function registrar_entrega() {

        var setor = document.getElementById('selecao_setores');
        var ramal = document.getElementById('inpt_ramal');
        var contato = document.getElementById('inpt_contato');
        var observacao = document.getElementById('inpt_observacao');
        var cracha = document.getElementById('inpt_cracha');

        // REALIZAR VALIDAÇÃO DO CRACHÁ

        if (contato.value == '') {

            //MENSAGEM            
            var_ds_msg = 'Necessário%20preenchimento%20dos%20campos.';
            var_tp_msg = 'alert-danger';

            $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);

            contato.focus();

        } else {

            $.ajax({
                url: "funcoes/registro/insert_registro_entrega.php",
                method: "POST",
                data: {
                    setor: setor.value,
                    ramal: ramal.value,
                    contato: contato.value,
                    observacao: observacao.value,
                    cd_chave: inpt_chave.value,
                    cracha: cracha.value,
                    assinatura: '',
                    tp_cadeado: ''
                },
                cache: false,
                success(res) {

                    if (res == 'Sucesso') {

                        ramal.value = '';
                        contato.value = '';
                        observacao.value = '';

                        //MENSAGEM            
                        var_ds_msg = 'Retirada%20registrado%20com%20sucesso.';
                        var_tp_msg = 'alert-success';

                        $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);

                        setTimeout(() => {

                            window.location.href = "registro.php";

                        }, 3000)

                    } else {

                        console.log(res)

                        //MENSAGEM            
                        var_ds_msg = 'Erro%20ao%20registrar%20retirada.';
                        var_tp_msg = 'alert-danger';

                        $('#mensagem_acao').load('config/mensagem/ajax_mensagem_acoes.php?ds_msg=' + var_ds_msg + '&tp_msg=' + var_tp_msg);

                    }

                }
            })

        }

    }
</script>