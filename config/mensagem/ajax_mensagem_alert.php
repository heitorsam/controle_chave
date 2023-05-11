<div id="modal_alert" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 50% !important; margin: 0 auto;">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px; padding: 4px;"><i class="fa-regular fa-bell efeito-zoom"></i> Alerta</h5>
            <button type="button" class="close efeito-zoom" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="font-size: 16px;">
        <div id="conteudo_modal_alert"> </div> 
      </div>
      <div id="rodape_alert" class="modal-footer">        
      </div>
    </div>
  </div>
</div>

<!--
<a class="btn btn-primary" onclick="ajax_alert('Deseja alterar o status?','ajax_alert_teste(100)')">Teste Heitor</a>
-->

<script>

    function ajax_alert(js_mensagem,js_acao){

        $('#modal_alert').modal('show');
        $("#conteudo_modal_alert").empty();
        $("#conteudo_modal_alert").append(''+js_mensagem+'');

        $("#rodape_alert").empty();
        $("#rodape_alert").append('<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="' + js_acao + '"><i class="fa-solid fa-check"></i> Confirmar</button>');
        $("#rodape_alert").append('<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Fechar</button>'); 
    
    }

    //function ajax_alert_teste(js_id){

        //alert(js_id);
    //}


</script>
