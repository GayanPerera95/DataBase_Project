<?php 
require_once "../Connection/Connection.php";
?>

<!-- Start card retive for number of to jobs  -->
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  
  $searchText=$_POST['searchText'];
       // echo "<tr>Serach Text Call . </tr>".$searchText;


      $list = '';
       $sql = "EXEC  dbo.getRepairDetailsBySerach
       @SearchText  ='%$searchText%'
       ";
       $stmt = sqlsrv_query( $conn, $sql );
       if( $stmt === false) {
           die( print_r( sqlsrv_errors(), true) );
       }
       
       if ($stmt) {
           $rows = sqlsrv_has_rows( $stmt );
           if($rows === true){
       
               while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                 $Date = $row['Received_date']->format('d/m/Y');
           
       
                              $list.= "<tr>";
                  $list.= "    <td>";
                  $list.= "        {$row['Job_id']}";
                  $list.= "    </td>";
                
                  $list.= "    <td>";
                
                  $list.= "            {$row['Cus_fname']} <small>  {$row['Cus_lname']} </small>";
              
                  $list.= "      <br/>";
                  $list.= "       <small>";
                  $list.= "           {$Date} ";
                  $list.= "        </small>";
                  $list.= "    </td>";
                   
                  $list.= "    <td>";
                  $list.= "        <ul class=\"list-inline\">";
                  $list.= "           <li class=\"list-inline-item\">";
                  $list.= "                <img alt=\"Avatar\" class=\"table-avatar\" src=\"{$row['Image']}\" style=\"width:40px; height:40px;\">";
                  $list.= "            </li>";
                  $list.= "            <li class=\"list-inline-item\">";
                  $list.= "                <small> {$row['Emp_fname']} <small>  {$row['Emp_lname']} </small>";
                  $list.= "            </li>";
                  $list.= "        </ul>";
                  $list.= "    </td>";
                 
                  $list.= "    <td class=\"project_progress\">";
                  $list.= "        <div class=\"progress progress-sm\">";
                  $list.= "<div class=\"progress-bar bg-green\" role=\"progressbar\" aria-valuenow=\"{$row['P_Presant']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: {$row['P_Presant']}%\">";
                  $list.= "            </div>";
                  $list.= "        </div>";
                  $list.= "        <small>";
                  $list.= "            {$row['P_Presant']} Complete";
                  $list.= "        </small>";
                  $list.= "    </td>";
                  $list.= "    <td>";
                  $list.= "       {$row['Problem']} <small> {$row['Serial_number']}</small> ";
                  $list.= "    </td>";
                
                  $list.= "    <td class=\"project-actions text-right\">";
                  $list.= "        <a class=\"btn btn-primary btn-sm\" ";
                  $list.= "            <i class=\"fas fa-folder\">";
                  $list.= "         </i>";
                  $list.= "          View";
                  $list.= "      </a>";
                 
                  $list.= "       <a class=\"btn btn-danger btn-sm\" ";
                  $list.= "           <i class=\"fas fa-trash\">";
                  $list.= "           </i>";
                  $list.= "           Delete";
                  $list.= "       </a>";
                  $list.= "   </td>";
                  $list.= " </tr>";
                  
              }
            
           }
       
       
             
           else {
               echo "<tr>no results. </tr>";
           }
      }







}else{


  // echo "<tr>Not in Post method call . </tr>";
  $list = '';
  $sql = "EXEC  dbo.getRepairDetailsBySerach
  @SearchText  ='%%'
  ";
  $stmt = sqlsrv_query( $conn, $sql );
  if( $stmt === false) {
      die( print_r( sqlsrv_errors(), true) );
  }
  
  if ($stmt) {
      $rows = sqlsrv_has_rows( $stmt );
      if($rows === true){
  
          while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $Date = $row['Received_date']->format('d/m/Y');
      
                   
                  
                  $list.= "<tr>";
                  $list.= "    <td>";
                  $list.= "        {$row['Job_id']}";
                  $list.= "    </td>";
                
                  $list.= "    <td>";
                
                  $list.= "            {$row['Cus_fname']} <small>  {$row['Cus_lname']} </small>";
              
                  $list.= "      <br/>";
                  $list.= "       <small>";
                  $list.= "           {$Date} ";
                  $list.= "        </small>";
                  $list.= "    </td>";
                   
                  $list.= "    <td>";
                  $list.= "        <ul class=\"list-inline\">";
                  $list.= "           <li class=\"list-inline-item\">";
                  $list.= "                <img alt=\"Avatar\" class=\"table-avatar\"  src=\"{$row['Image']}\"  style=\"width:40px; height:40px;\" >";
                  $list.= "            </li>";
                  $list.= "            <li class=\"list-inline-item\">";
                  $list.= "                <small> {$row['Emp_fname']} <small>  {$row['Emp_lname']} </small>";
                  $list.= "            </li>";
                  $list.= "        </ul>";
                  $list.= "    </td>";
                 
                  $list.= "    <td class=\"project_progress\">";
                  $list.= "        <div class=\"progress progress-sm\">";
                  $list.= "<div class=\"progress-bar bg-green\" role=\"progressbar\" aria-valuenow=\"{$row['P_Presant']}\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: {$row['P_Presant']}%\">";
                  $list.= "            </div>";
                  $list.= "        </div>";
                  $list.= "        <small>";
                  $list.= "            {$row['P_Presant']} Complete";
                  $list.= "        </small>";
                  $list.= "    </td>";
                  $list.= "    <td>";
                  $list.= "       {$row['Problem']} <small> {$row['Serial_number']}</small> ";
                  $list.= "    </td>";
                
                  $list.= "    <td class=\"project-actions text-right\">";
                  $list.= "        <a class=\"btn btn-primary btn-sm\" ";
                  $list.= "            <i class=\"fas fa-folder\">";
                  $list.= "         </i>";
                  $list.= "          View";
                  $list.= "      </a>";
                 
                  $list.= "       <a class=\"btn btn-danger btn-sm\" ";
                  $list.= "           <i class=\"fas fa-trash\">";
                  $list.= "           </i>";
                  $list.= "           Delete";
                  $list.= "       </a>";
                  $list.= "   </td>";
                  $list.= " </tr>";
             
         }
       
      }
  
  
        
      else {
          echo "<tr>no results. </tr>";
      }
 }



}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Repair</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>


   



     <!-- for notification icon  -->
    <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
              <i class="fas fa-th-large"></i>
            </a>
          </li>
    </ul>
    <!-- for notification icon  --> 
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'Includes/sidebar.php' ?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>REPAIR MANAGEMENT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Repair</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid mb-2">
         
            <div class="row">
                <div class="col-md-12">
                    <form  method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"enctype="multipart/form-data"  >
                        <div class="input-group">
                            <input type="search" class="form-control " placeholder="Customer Name or Job ID" name="searchText">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
        <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Repair Projects Progress</h3>


        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                           <tr>
                      <th style="width: 1%">
                          ID
                      </th>
                      <th style="width: 10%">
                          Project Name
                      </th>
                      <th style="width: 15%">
                          Team Members
                      </th>
                      <th style="width: 20%">
                          Project Progress
                      </th>
                      <th style="width: 12%">
                          Status
                      </th>
                                          <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
<?php echo $list; ?>

              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Pie Chart</h3>

        
              </div>
              <div class="card-body">
              <?php include 'Includes/repairLinechart.php' ?> 
 
              </div>
              <!-- /.card-body -->
            </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Repairing table shows</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Job_id</th>
                    <th>Device_model</th>
                    <th>Serial_number</th>
                    <th>Problem</th>
                    <th>Received Date</th>
                    <th>Employe Name</th>
                    <th>Customer Name</th>
                    <th>Customer phone</th>
                    <th>Advance paid</th>
                    <th>Sub totoal</th>
                    <th>Availabel balance</th>
                  </tr>
                  </thead>
                  <tbody>

                  <!-- retrive data through the procedure  start -->

                  <?php

               $sql = "Exec getRepairDetails";
                $stmt = sqlsrv_query( $conn, $sql );
                if( $stmt === false) {
                    die( print_r( sqlsrv_errors(), true) );
                }

                if ($stmt) {
                    $rows = sqlsrv_has_rows( $stmt );
                    if($rows === true){
                
                        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                          $Date = $row['Received_date']->format('d/m/Y');
                    

                            echo '<tr>';
                            echo '<td>'.$row['Job_id'].'</td>';
                            echo '<td>'.$row['Device_model'].'</td>';
                            echo '<td>'.$row['Serial_number'].'</td>';
                            echo '<td>'.$row['Problem'].'</td>';
                            echo '<td>'.$Date.'</td>';
                            echo '<td>'.$row['Emp_fname'].' '.$row['Emp_lname'].'</td>';
                            echo '<td>'.$row['Cus_fname'].' '.$row['Cus_lname'].'</td>';
                            echo '<td>'.$row['Phone_no'].'</td>';

                            echo '<td>'.$row['Advance_paid'].'</td>';
                            echo '<td>'.$row['Sub_total'].'</td>';
                            echo '<td>'.$row['AvailableBlanace'].'</td>';
                                   
                            echo '</tr>';
                       }
                     
                    }
                
                
                      
                    else {
                        echo "<tr>There are no rows. </tr>";
                    }
                      
                }
                   

                  ?>
                <!-- retrive data through the procedure  end -->
  
                  </tbody>
                  <!-- <tfoot> 
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                  </tr>
                  </tfoot> -->
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <section class="content">

















     <!-- Start card retive for number of to end  -->

      <!-- Default box -->

  <!-- /.content-wrapper -->
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<?php include 'Includes/footer.php' ?> 
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
