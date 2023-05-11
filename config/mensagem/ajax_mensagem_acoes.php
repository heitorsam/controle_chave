<?php

    $var_msg = str_replace('%20',' ',$_GET['ds_msg']);
    $var_tp = $_GET['tp_msg'];

    echo "<div class='alert " . $var_tp . "' role='alert' style='position: fixed; 
    text-align: center; font-size: 14px;
    bottom: 20px; transform: translateX(-50%); left: 50%; min-width: 40%;'>";   
    echo $var_msg;                          
    echo "</div>";

?>
<script>

    $(".alert").delay(6000).fadeOut(1200);

</script>