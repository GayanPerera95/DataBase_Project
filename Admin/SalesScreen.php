<!-- declare the connection to database -->
<?php 
header('Cache-Control: no-cache');
header('Pragma: no-cache');

require_once "../Connection/Connection.php";



?>

<?php
//$list = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // collect value of input field
        
      $searchText ='';


        if (!empty($_POST['searchText'])) {
        // echo $searchText.'<br>';
          $searchText=$_POST['searchText'];
        }



                
      $Option1=''; 
      $Option2='';  
      $Option3='';
      $Option4='';    
      
            
            $sortOder = $_POST['sortOder'];
              if (!empty($sortOder)) {
            //  echo $sortOder.'<br>';
              } 
            
              if(isset($_POST["Categoryary"]))  
              { 
                $values = $_POST['Categoryary'];
                

                $count=1;

                
                foreach ($values as $a){
                    if ($count==1) {
                      $Option1=$a;
                    }
                    else if ($count==2)
                    {
                      $Option2=$a;
                    }else if($count==3){
                      $Option3=$a;
                    }else if($count==4)
                    {
                      $Option4=$a;
                    }


                    $count++;
                }

        

              } 


      //check tAG only select is a validation type of

      $isTagOnly="FALSE";


      if((!empty($Option1) || !empty($Option1) || !empty($Option1) || !empty($Option1) )  && empty($searchText) ){
      //  echo "TAG Only Selected catch";

        $isTagOnly="TRUE";
      }


      //retrieve data from the database
        $list = '';
        $sql =" EXEC  dbo.SearchEngine

        @option1 ='$Option1',
        @option2 ='$Option2',
        @option3 ='$Option3',
        @option4 ='$Option4',
        @SearchText='%$searchText%',
        @Sort_Order ='$sortOder',
        @isTagOnly='$isTagOnly'
        ";


      //echo $sql;
        $stmt = sqlsrv_query( $conn, $sql );


        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        //Check is Row is there

      if ($stmt) {
          $rows = sqlsrv_has_rows( $stmt );

          if ($rows === true){

            while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

                                $price=$row['Price'];
                                $discount=$row['Discount'];
                                $avbPrice= $price * (1- ($discount/100));


                                $list .= "<tr>" ;
                                $list .= "<td>{$row['Name']}</td>" ;
                                $list .="<td>{$row['Stock_Quantity']}</td>" ;
                                $list .="<td>{$row['Customer_Orders']}</td>" ;
                                $list .="<td>{$row['Discount']}</td>" ;
                                $list .="<td>{$row['Price']}</td>" ;
                                $list .="<td>{$avbPrice}</td>" ;
                                $list .="<td><button type=\"button\" class=\" btn btn-danger btn-xs btn-block \" href=\"{$row['Product_img']}\" data-toggle=\"lightbox\" data-title=\"{$row['Name']}   price Rs :{$row['Price']}\">
                                     View
                                    </button></td>" ;
                                $list .="</tr>" ;


            }

            }else {

              echo "Query failed" ;

            }

          }


      //sqlsrv_free_stmt( $stmt);
      }else{
      // echo 'Not Post Reqest !'; 
          $list = '';
          $sql = " dbo.SearchEngine
          @option1 ='',
          @option2 ='',
          @option3 ='',
          @option4 ='',
          @SearchText  ='%%',
          @Sort_Order ='DESC',
          @isTagOnly='FALSE'
          ";
          $stmt = sqlsrv_query( $conn, $sql );
          if( $stmt === false) {
              die( print_r( sqlsrv_errors(), true) );
          }

          if ($stmt) {
                      $rows = sqlsrv_has_rows( $stmt );
                      if($rows === true){

                          while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

                                $price=$row['Price'];
                                $discount=$row['Discount'];
                                $avbPrice= $price * (1- ($discount/100));
                        
                                $list .= "<tr>" ;
                                $list .= "<td>{$row['Name']}</td>" ;
                                $list .="<td>{$row['Stock_Quantity']}</td>" ;
                                $list .="<td>{$row['Customer_Orders']}</td>" ;
                                $list .="<td>{$row['Discount']}</td>" ;
                                $list .="<td>{$row['Price']}</td>" ;
                                $list .="<td>{$avbPrice}</td>" ;
                                $list .="<td><button type=\"button\" class=\" btn btn-danger btn-xs btn-block \" href=\"{$row['Product_img']}\" data-toggle=\"lightbox\" data-title=\"{$row['Name']}   price Rs :{$row['Price']}\">
                                     View
                                    </button></td>" ;


                                $list .="</tr>" ;
                              }
                     
                      }else {
                        echo "There are no rows. <br />";
                      }
                  }



}
     
?>




<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>

   <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
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


  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<?php include 'Includes/sidebar.php' ?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">STOCK MANAGEMENT AND ANALYTICS</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Stock Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
           
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"enctype="multipart/form-data"   >
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                 
                                    <select class="select2" multiple="multiple" data-placeholder="Category" style="width: 100%;" name="Categoryary[]" size = 4>
                                        <option>Computer item</option>
                                        <option>Electrical item</option>
                                        <option>Mobile item</option>
                                        <option>Stationary item</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                 
                                    <select class="select2" style="width: 100%; height: 100%" name="sortOder">
                                        <option selected>ASC</option>
                                        <option>DESC</option>
                                    </select>

                                </div>
                            </div>
                          
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="input-group ">
                                        <input type="search" class="form-control" placeholder="Search for an order" name="searchText" >
                                        <div class="input-group-append">
                                            <button type="submit" name="save" class="btn btn-primary">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
    </section>


  
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">









<div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>In Stock</th>
                    <th>Cus_Order_Qty</th>
                    <th>Discount</th>
                    <th>Price</th>
                    <th>Available Price</th>
                    <th>View</th>
                  </tr>
                  </thead>

                  <tbody>

                  <?php echo $list; ?>
                
                  
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>


 



       

</div>
</section>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
         <!-- PIE CHART --> 
         <div class="row">
         <div class="card card-danger col-6">
              <div class="card-header">
                <h3 class="card-title">Pie Chart</h3>

              </div>
              <div class="card-body">
              <?php include 'Includes/stockpieChart.php' ?> 
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card card-info col-6">
              <div class="card-header">
                <h3 class="card-title">Line Chart</h3>

             
              </div>
              <div class="card-body">
              <?php include 'Includes/stocklineChart.php' ?> 

              </div>
              <!-- /.card-body -->
            </div>
     </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
<?php include 'Includes/footer.php' ?> 
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
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

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>
<script>
    $(function () {
      $('.select2').select2()
    });
</script>



<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>

<!-- Ekko Lightbox -->
<script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator',
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    var stackedBarChart = new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>
</body>
</html>
