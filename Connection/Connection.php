<?php


$serverName ="DESKTOP-1GAFLDK"; //serverName\instanceName
$connectionInfo = array("Database"=>"ComputerShop");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn){
	//echo "Connection established.<br/>";
}else{
	//echo "Connection could not be established.<br/>";
	die(print_r(sqlsrv_errors(), true));
}



?>