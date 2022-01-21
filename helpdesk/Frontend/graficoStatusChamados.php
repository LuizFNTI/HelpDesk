    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'Total'],

          <?php
                        
            include '../Backend/conexao.php';

            $dados = array();        

            //Faz a consulta no banco
            $query = $conn->query("SELECT nome_status, COUNT(status_chamado_cod_status) AS 'total' FROM chamados INNER JOIN status_chamado ON status_chamado.cod_status = chamados.status_chamado_cod_status GROUP BY nome_status");

            //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
            foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {?>
              ['<?php echo $dados['nome_status'] ?>', <?php echo $dados['total'] ?>],
            <?php } ?>
        ]);

        var options = {
          title: 'Status dos Chamados',
          pieHole: 0.4,
          slices: {
            0: { color: 'red' },
            1: { color: 'yellow' },
            2: { color: 'green' },
            3: { color: 'black' },
            4: { color: 'orange' },
            5: { color: 'blue' },
            6: { color: 'gray' },
            7: { color: 'tomato' },
            8: { color: 'dodgerBlue' },
            9: { color: 'brown' },
            10: { color: 'purple' }
          }
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
    <div id="donutchart" style="width: 900px; height: 500px;"></div>
