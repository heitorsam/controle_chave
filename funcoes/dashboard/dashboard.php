<?php

include '../../conexao.php';

$periodo = $_GET['filtro'];

if ($periodo == 'hoje') {

    $cons_armazenamento_diario = "SELECT EXTRACT(MONTH FROM reg.HR_CADASTRO) AS MES,
                                            EXTRACT(DAY FROM reg.HR_CADASTRO) AS DIA,
                                            COUNT(reg.CD_REGISTRO) AS QTD
                                    FROM controle_chave.REGISTRO reg
                                    WHERE TO_CHAR(reg.HR_CADASTRO, 'YYYY-MM') = TO_CHAR(SYSDATE, 'YYYY-MM')       
                                    GROUP BY EXTRACT(MONTH FROM reg.HR_CADASTRO), EXTRACT(DAY FROM reg.HR_CADASTRO)
                                    ORDER BY DIA";
} else {

    $cons_armazenamento_diario = "SELECT EXTRACT(MONTH FROM reg.HR_CADASTRO) AS MES,
                                         EXTRACT(DAY FROM reg.HR_CADASTRO) AS DIA,
                                         COUNT(reg.CD_REGISTRO) AS QTD
                                  FROM controle_chave.REGISTRO reg
                                  WHERE TO_CHAR(reg.HR_CADASTRO, 'YYYY-MM') = '$periodo'
                                  GROUP BY EXTRACT(MONTH FROM reg.HR_CADASTRO), EXTRACT(DAY FROM reg.HR_CADASTRO)
                                  ORDER BY DIA";

}

$cons_armazenamento_mensal = "SELECT EXTRACT(YEAR FROM reg.HR_CADASTRO) AS ANO,
                                     EXTRACT(MONTH FROM reg.HR_CADASTRO) AS MES,
                                     COUNT(reg.CD_REGISTRO) AS QTD
                              FROM controle_chave.REGISTRO reg
                              WHERE EXTRACT(YEAR FROM reg.HR_CADASTRO) = TO_CHAR(SYSDATE, 'YYYY')
                              GROUP BY EXTRACT(YEAR FROM reg.HR_CADASTRO), EXTRACT(MONTH FROM reg.HR_CADASTRO)
                              ORDER BY EXTRACT(MONTH FROM reg.HR_CADASTRO) ASC";


?>

<div class="div_br"></div>

<h11 style="margin-left: 10px;"><i class="fa-regular fa-calendar-days"></i> Armazenados por dia</h11>

<div class="div_br"></div>

<canvas id="armazenamento_diario" style="width: 100%; height: 300px;"></canvas>

<h11 style="margin-left: 10px;"><i class="fa-regular fa-calendar-days"></i> Armazenados por mês</h11>

<div class="div_br"></div>

<canvas id="armazenamento_mensal" style="width: 100%; height: 300px;"></canvas>

<div class="div_br"></div>


<script>
    var ctx = document.getElementById("armazenamento_mensal").getContext("2d");
    var ctx2 = document.getElementById("armazenamento_diario").getContext("2d");

    var data = {

        labels: [

            <?php

            $res = oci_parse($conn_ora, $cons_armazenamento_mensal);
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

                    $res = oci_parse($conn_ora, $cons_armazenamento_mensal);
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

    var data = {

        labels: [

            <?php

            $resp = oci_parse($conn_ora, $cons_armazenamento_diario);
            oci_execute($resp);

            while ($row = oci_fetch_array($resp)) {

                echo $row['DIA'] . ',';
            }
            ?>

        ],

        datasets: [{
            label: "Armazenados",
            backgroundColor: "#9deddc",
            borderColor: "#9deddc",
            data: [<?php

                    $resp = oci_parse($conn_ora, $cons_armazenamento_diario);
                    oci_execute($resp);

                    while ($row = oci_fetch_array($resp)) {

                        echo $row['QTD'] . ',';
                    }

                    ?>]
        }]
    }

    var myBarChart2 = new Chart(ctx2, {
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
</script>