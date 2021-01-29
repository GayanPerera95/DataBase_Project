<?php

include $_SERVER["DOCUMENT_ROOT"]."/ADBMS-Project (2)/ADBMS-Project/Connection/Connection.php";
  
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([

         ['Product_id','Stock_quantity'],
         <?php

          $sql = "SELECT * FROM [ComputerShop].[dbo].[Product_inclusion_in_stock]";
          $result = sqlsrv_query($conn,$sql);

           while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
            echo "['".$row['Product_id']."',".$row['Stock_quantity']."],";
          }

           ?>
        ]);

        var options = {
          title: 'Quantity Result',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
  </body>
</html>