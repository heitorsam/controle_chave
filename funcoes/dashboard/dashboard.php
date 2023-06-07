<?php

    include '../../conexao.php';

    $cons_armazenamento_diario = "SELECT EXTRACT(YEAR FROM reg.HR_CADASTRO) AS ANO,
                                         EXTRACT(MONTH FROM reg.HR_CADASTRO) AS MES,
                                         COUNT(reg.CD_REGISTRO) AS QTD
                                  FROM controle_chave.REGISTRO reg
                                  WHERE EXTRACT(YEAR FROM reg.HR_CADASTRO) = 2023
                                  GROUP BY EXTRACT(YEAR FROM reg.HR_CADASTRO), EXTRACT(MONTH FROM reg.HR_CADASTRO)
                                  ORDER BY EXTRACT(MONTH FROM reg.HR_CADASTRO) ASC";

?>

<div class="row">

    <div class="col-sm-3">

        <input id="inpt_mes" onchange="filtrar_mes()" class="form form-control" type="month">

    </div>

</div>

<div class="div_br"></div>

<h11 style="margin-left: 10px;"><i class="fa-regular fa-calendar-days"></i> Armazenados por mês</h11>

<div class="div_br"></div>

<canvas id="armazenamento_dia" style="width: 100%; height: 300px;"></canvas>

<div class="div_br"></div>

<canvas id="atrasos" style="width: 100%; height: 300px;"></canvas>


<script>

    var ctx = document.getElementById("armazenamento_dia").getContext("2d")

    var data = {

        labels: [

            <?php

                $res = oci_parse($conn_ora, $cons_armazenamento_diario);
                oci_execute($res);

                while ($row = oci_fetch_array($res)) {

                    echo $row['MES'] . ',';

                }
            ?>

        ],

        datasets: [{
            label: "Armazenados",
            backgroundColor: "#a2b3fc",
            borderColor: "#a2b3fc",
            data: [<?php 
            
                $res = oci_parse($conn_ora, $cons_armazenamento_diario);
                oci_execute($res);

                while ($row = oci_fetch_array($res)) {

                    echo $row['QTD'] . ',';

                }
            
            ?>]
        }]
    }

    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
            legend: {
                position: 'top',
            },
            //title: {
            //    display: true,
            //    text: 'Consolidado Mensal'
            //}
            }
        },
    }); 



    function filtrar_mes() {

        var mes = document.getElementById('inpt_mes');

    }

</script>