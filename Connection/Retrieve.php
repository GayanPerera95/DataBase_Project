<?php

 include 'Connection.php';



//type one retive 

// $sql = "SELECT * FROM [ComputerShop].[dbo].[Basic_for_job_post]";
//     $params = array();
//     $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
//     $stmt = sqlsrv_query( $conn, $sql , $params, $options );

//     $row_count = sqlsrv_num_rows( $stmt );
  

//         if ($row_count === false)
//            echo "Error al obtener datos.";
//         else
//            echo "bien";
//         //echo $row_count;

//         while( $row = sqlsrv_fetch_array( $stmt) ) {

//               print json_encode($row);


//         }




//type two retive 
// $sql = "SELECT * FROM [ComputerShop].[dbo].[Basic_for_job_post]";
// $stmt = sqlsrv_query( $conn, $sql );
// if( $stmt === false) {
//     die( print_r( sqlsrv_errors(), true) );
// }

// while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {



//       echo $row['Job_post'].", ".$row['Basic']."<br />";
// }

// sqlsrv_free_stmt( $stmt);




$sql = "Exec dbo.SearchEngine
@option1 ='%Computer item%',
 @option2 ='%%',
 @option3 ='%%',
 @option4 ='%%',
 @SearchText  ='%KeyBoard%',
 @Sort_Order ='DESC'";
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

if ($stmt) {
    $rows = sqlsrv_has_rows( $stmt );
    if($rows === true){

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            echo $row['Product_id']."<br />";
       }
       echo "There are rows. <br />";
    }


      
    else 
       echo "There are no rows. <br />";
 }











// $sql ="Exec dbo.SearchEngine
// @option1 ='%Computer item%',
// @option2 ='%%',
// @option3 ='%%',
// @option4 ='%%',
// @SearchText  ='%KeyBoard%',
// @Sort_Order ='DESC'";
// $params = array();
// $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
// $stmt = sqlsrv_query( $conn, $sql , $params, $options );

// $row_count = sqlsrv_num_rows( $stmt );
   
// if ($row_count === false)
//    echo "Error in retrieveing row count.";
// else
//    echo 'number of rows :'.$row_count;



// sqlsrv_free_stmt( $stmt);

?>

