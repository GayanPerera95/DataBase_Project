<!-- declare the connection to database -->
<?php 
include $_SERVER["DOCUMENT_ROOT"]."/ADBMS-Project (2)/ADBMS-Project/Connection/Connection.php";
//echo $_SERVER["DOCUMENT_ROOT"]."/ADBMS/ADBMS-Project/Connection/Connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Plus Admin | Show Stocks</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="../https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
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

    <!-- SEARCH FORM -->
   

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
     
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
  <?php include '../Includes/sidebar.php' ?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Stocks</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Stock Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>





        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Show Stocks Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-hover">

                  <thead>
                  <tr>
                    <th>Product id </th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Discount %</th>
                    <th>Avaliable Price</th>
                    <th>Inclusion Stock</th>
                    <th>Customer Order Quantity</th>
                    <th>Stock Quantity</th>
                    <th>Recival Stock Quantity</th>

                  </tr>
                  </thead>
                  <tbody>






    <!-- retive the data from data base  -->



    <?php
                $sql = "SELECT * FROM ShowStockDetails";
                $stmt = sqlsrv_query( $conn, $sql );
                if( $stmt === false) {
                    die( print_r( sqlsrv_errors(), true) );
                }

                if ($stmt) {
                    $rows = sqlsrv_has_rows( $stmt );
                    if($rows === true){
                
                        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                            // echo $row['Product_id']."<br />";
                            $price=$row['Price'];
                            $discount=$row['Discount'];
                    
                            $avbPrice= $price * (1- ($discount/100));
                    

                            echo '<tr>';
                            echo '<td>'.$row['Product_id'].'</td>';
                            echo '<td>'.$row['Product_Name'].'</td>';
                            echo '<td>'.$row['Price'].'</td>';
                            echo '<td>'.$row['Discount'].'</td>';
                            echo '<td>'.$avbPrice.'</td>';
                            echo '<td>'.$row['InclusionStock'].'</td>';
                            echo '<td>'.$row['Customer_Orders'].'</td>';
                            echo '<td>'.$row['Stock_Quantity'].'</td>';
                            echo '<td>'.$row['RecivalStock_Quantitiy'].'</td>';
                                   
                            echo '</tr>';
                       }
                     
                    }
                
                
                      
                    else {
                        echo "<tr>There are no rows. </tr>";
                    }
                      

                }





     ?>

                 
                
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

     
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<?php include '../Includes/footer.php' ?> 
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
       "lengthChange": false,
       "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]



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
