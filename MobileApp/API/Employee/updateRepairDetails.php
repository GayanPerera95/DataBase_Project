<?php 
header("Content-Type: application/json; charset=UTF-8");



include $_SERVER["DOCUMENT_ROOT"]."/ADBMS-Project/Connection/Connection.php";

//echo $_SERVER["DOCUMENT_ROOT"]."/ADBMS/ADBMS-Project/Connection/Connection.php";

$job_id= $_POST['job_id'];

$emp_id= $_POST['emp_id'];

$Presentage= $_POST['Presentage'];



$sql = "EXEC  dbo.updateRepairDetailsByToMobileApp
@Job_id  ='$job_id',
@emp_id ='$emp_id',
@Presentage ='$Presentage'";

$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}



//create the josn loacl object





if ($stmt) {
    $rows = sqlsrv_has_rows( $stmt );
    $myObj=new \stdClass();
    $myObj->success = 'true';
    $myJSON = json_encode($myObj);
    echo $myJSON;
    }else{

        $myObj=new \stdClass();
        $myObj->success = 'false';
        $myJSON = json_encode($myObj);
        echo $myJSON;

    }










?>


