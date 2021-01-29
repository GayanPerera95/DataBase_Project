

<!-- declare the connection to database -->
<?php 
//include $_SERVER["DOCUMENT_ROOT"]."/ADBMS-Project (2)/ADBMS-Project/Connection/Connection.php";
//require_once "../../Connection/Connection.php";
//echo $_SERVER["DOCUMENT_ROOT"]."/ADBMS/ADBMS-Project/Connection/Connection.php";
?>


<?php
 





 $sql ="EXEC  dbo.getStockForLineChart";


 $stmt = sqlsrv_query( $conn, $sql );
 if( $stmt === false) {
     die( print_r( sqlsrv_errors(), true) );
 }
 
$dataPointsStockLine = array();
 if ($stmt) {
     $rows = sqlsrv_has_rows( $stmt );
     if($rows === true){
 
         while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            //  echo $row['Product_Name']."<br />";
            //  echo $row['Quanitity']."<br />";




            array_push($dataPointsStockLine, array("y"=> $row["Quanitity"], "label"=>$row["Product_Name"]));

        }
       // echo "There are rows. <br />";
     }
 
 
       
     else {
        echo "There are no rows. <br />";
     }
      
  }


?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart2 = new CanvasJS.Chart("StockPieChart", {
	animationEnabled: true,
	title: {
		text: "Stock Analysis"
	},
	subtitles: [{
		text: ""
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPointsStock, JSON_NUMERIC_CHECK); ?>
	}]
});
chart2.render();
 


var chart3 = new CanvasJS.Chart("chartContainer1", {
	title: {
		text: "Populer Products"
	},
	axisY: {
		title: ""
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPointsStockLine, JSON_NUMERIC_CHECK); ?>
	}]
});
chart3.render();
 
}
</script>



</head>
<body>
<div id="chartContainer1" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>  

</body>
</html>       