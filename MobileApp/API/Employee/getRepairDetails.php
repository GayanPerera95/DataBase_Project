<?php 
header("Content-Type: application/json; charset=UTF-8");



include $_SERVER["DOCUMENT_ROOT"]."/ADBMS-Project/Connection/Connection.php";

//echo $_SERVER["DOCUMENT_ROOT"]."/ADBMS/ADBMS-Project/Connection/Connection.php";

$search_text= $_POST['search_text'];

$emp_id= $_POST['emp_id'];




$sql = "EXEC  dbo.getRepairDetailsByToMobileApp
@SearchText  ='%$search_text%',
@emp_id ='$emp_id'";

$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}



//create the josn loacl object





if ($stmt) {
    $rows = sqlsrv_has_rows( $stmt );
    if($rows === true){



        $dataPointsRepairLine = array();


        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            // echo $row['Job_id']."<br />";
       $Date = $row['Received_date']->format('d/m/Y');

            array_push($dataPointsRepairLine,
             array(
               "Job_id"=> $row["Job_id"],
              "Device_model"=>$row["Device_model"],
              "Serial_number"=>$row["Serial_number"],
              "Problem"=>$row["Problem"],
              "P_Presant"=>$row["P_Presant"],
              "Received_date"=>$Date,
               "Customer_Name"=>$row["Cus_fname"].' '.$row["Cus_lname"] ,
               "Customer_Profile"=>$row["Customer Profile"]
             
            ));


            // $myObj=new \stdClass();
            // $myObj->results ="true";





       }


       echo json_encode($dataPointsRepairLine, JSON_NUMERIC_CHECK); 

      // echo "There are rows. <br />";
    }




     //  echo "There are no rows. <br />";
 }





?>


