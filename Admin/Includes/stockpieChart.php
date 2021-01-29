

<!-- declare the connection to database -->
<?php 
//include $_SERVER["DOCUMENT_ROOT"]."ADBMS-Project/Connection/Connection.php";

//echo $_SERVER["DOCUMENT_ROOT"]."/ADBMS/ADBMS-Project/Connection/Connection.php";
?>



<?php
 

 $sql ="EXEC  dbo.getStockForChart";


 $stmt = sqlsrv_query( $conn, $sql );
 if( $stmt === false) {
     die( print_r( sqlsrv_errors(), true) );
 }
 
$dataPointsStock = array();
 if ($stmt) {
     $rows = sqlsrv_has_rows( $stmt );
     if($rows === true){
 
         while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            //  echo $row['Product_Name']."<br />";
            //  echo $row['Quanitity']."<br />";




            array_push($dataPointsStock, array("y"=> $row["Quanitity"], "label"=>$row["Product_Name"]));

        }
       // echo "There are rows. <br />";
     }
 
 
       
     else {
        echo "There are no rows. <br />";
     }
      
  }
 
 









// $dataPoints = array( 
// 	array("label"=>"Chrome", "y"=>64.02),
// 	array("label"=>"Firefox", "y"=>12.55),
// 	array("label"=>"IE", "y"=>8.47),
// 	array("label"=>"Safari", "y"=>6.08),
// 	array("label"=>"Edge", "y"=>4.29),
// 	array("label"=>"Others", "y"=>4.59)
// )
 



// $dataPointsStock = array();

?>
<!DOCTYPE HTML>
<html>
<head>

</head>
<body>
<div id="StockPieChart" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>            