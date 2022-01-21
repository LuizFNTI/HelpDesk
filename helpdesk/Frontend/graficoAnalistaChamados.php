<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Analista');
        data.addColumn('number', 'Total Chamados');
        data.addRows([

        <?php
                        
          include '../Backend/conexao.php';

          $dados = array();        

          //Faz a consulta no banco
          $query = $conn->query("SELECT analista, COUNT(numero_chamado) AS 'total' FROM chamados WHERE analista IS NOT NULL GROUP BY analista ORDER BY analista");

          //Joga os dados do banco num array e faz a leitura do array, jogando as informações no tabela
          foreach($query->fetchAll(PDO::FETCH_ASSOC) as $dados) {?>
              ['<?php echo $dados['analista'] ?>', {v: <?php echo $dados['total'] ?>, f: '<?php echo $dados['total'] ?>'}],
          <?php } ?>
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>
  </head>
  <body>
    <div id="table_div"></div>
  </body>
</html>


                      