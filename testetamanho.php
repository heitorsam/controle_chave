
<?php

    include 'cabecalho.php';

?>

<input type = "checkbox" onclick="ajax_tp_check('tp1')">

<input type = "checkbox" onclick="ajax_tp_check('tp2')">


<script>

function ajax_tp_check(tpcheck){

    var largura = '';
    var altura = '';

    if(tpcheck == 'tp1'){

    var largura = '100';
    var altura = '100';

    }else{


    var largura = '200';
    var altura = '200';

        
    }

    alert(largura);
    alert(altura);

}


</script>

<?php

    include 'rodape.php';

?>