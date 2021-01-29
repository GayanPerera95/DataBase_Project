<!-- declare the connection to database -->
<?php 
//include $_SERVER["DOCUMENT_ROOT"]."/ADBMS-Project (2)/ADBMS-Project/Connection/Connection.php";
//require_once "../../Connection/Connection.php";
//echo $_SERVER["DOCUMENT_ROOT"]."/ADBMS/ADBMS-Project/Connection/Connection.php";
?>


<?php
 
// $dataPoints = array(
// 	array("y" => 25, "label" => "Sunday"),
// 	array("y" => 15, "label" => "Monday"),
// 	array("y" => 25, "label" => "Tuesday"),
// 	array("y" => 5, "label" => "Wednesday"),
// 	array("y" => 10, "label" => "Thursday"),
// 	array("y" => 0, "label" => "Friday"),
// 	array("y" => 20, "label" => "Saturday")
// );


$sql ="EXEC  dbo.getRepairDetailsForLineChart";


 $stmt = sqlsrv_query( $conn, $sql );
 if( $stmt === false) {
     die( print_r( sqlsrv_errors(), true) );
 }
 
$dataPointsRepairLine = array();
 if ($stmt) {
     $rows = sqlsrv_has_rows( $stmt );
     if($rows === true){
 
         while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            //  echo $row['Product_Name']."<br />";

            $Date = $row['Recevied_Date']->format('d/m/Y');
           // echo  $Date;

           //   echo $row['Recevied_Date']."<br />";




            array_push($dataPointsRepairLine, array("y"=> $row["Number_of_items"], "label"=> $Date));

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
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Repair details"
	},
	axisY: {
		title: "before 10 days"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPointsRepairLine, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>   