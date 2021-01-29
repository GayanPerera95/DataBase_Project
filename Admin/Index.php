
<?php 

require_once "../Connection/Connection.php";

if (isset($_POST['submit_product'])) {

  $search_product = $_POST['search_product'];

    $sql_product = "SELECT * FROM dbo.Product WHERE Name LIKE '%".$_POST['search_product']."%'";  

    
    $result = sqlsrv_query($conn,$sql_product); //check the sql query

                //checking how many rows founded with query
                if($result){
                 // if (sqlsrv_num_rows($result) == 1) {
            
                    $product = sqlsrv_fetch_array($result); //cheching if the result is ok...
                    $product_name = $product['Name'];
                    $product_price = $product['Price'];
                    $product_des = $product['Description'];
                    //$product_col = $product['Colour'];
                    $product_dis = $product['Discount'];
                    $product_img = $product['Product_img'];
                    $product_ctnum = $product['Category_no'];
                   
                  // }else{
                  //  echo "errorrrrrr";
                  // }
            
                }else{
                  //$error[] = "Query failed" ;
                  echo "error";
                }
}




 ?>


<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>


  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- jQuery UI library -->
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <script>
  $(function() {
      $("#search_product").autocomplete({
          source: "backend-search.php",
      });
  });
  </script>

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

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3" method="POST" action="index.php">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" name="search_product">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit" name="submit_product">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

  


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
            <h1 class="m-0">ADMINISTRATION DASHBOARD</h1>

           

          </div><!-- /.col -->

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Home Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content ------------------------------------------------------------------------------------------------------------------------------------------------------- -->
	  <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">

          <div class="row">
        		        <div class="container-fluid">
				             <!-- <h2 class="text-left">Search for a Product</h2> -->
				            <form method="POST" action="index.php">
				                <div class="row">
				                    <div class="col-md-12 ">
				                        <div class="form-group">
				                            <div class="search-box input-group input-group-lg ">
				                                <input type="search" autocomplete="off" class="form-control form-control-lg" placeholder="Enter Product Name" name="search_product" id="search_product">
                                        
				                                <div class="input-group-append">
				                                    <button type="submit" class="btn btn-lg btn-primary" name="submit_product">
				                                        <i class="fa fa-search"></i>
				                                    </button>
				                                </div>
				                            </div>
				                        </div>
				                    </div>
				                </div>
				            </form>
				        </div>
          </div>

          <div class="row">
            <div class="col-12 col-sm-4">
            
              <div class="col-12">
                <img src="<?php if(isset($product_img)){ echo $product_img; } else {echo "dist/img/boxed-bg.jpg";}  ?>" class="product-image" alt="Product Image">
              </div>


            </div>
            <div class="col-12 col-sm-8">
              <h3 class="my-3"><?php if(isset($product_name)){ echo $product_name; } else {echo "Not Selected";}  ?></h3>
              <p><?php if(isset($product_des)){ echo $product_des; } else {echo "Not Selected";}  ?></p>

              <hr>

              <h4><?php if(isset($product_dis)){ echo 'Discount(%) : '.$product_dis; } else {echo "Not Selected";}  ?></h4>
              <h4 class="mt-1"><?php if(isset($product_ctnum)){ echo 'Category Number : '.$product_ctnum; } else {echo "Not Selected";}  ?></h4>
              




            </div>
          </div>

          <div class="row">

          	<div class="col-12 col-sm-4">
        	  <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                <?php if(isset($product_price)){ echo $product_price; } else {echo "RS 00:00";}  ?>
                </h2>
                <h4 class="mt-0">
                  <small>Ex Tax: 00.00 </small>
                </h4>
              </div>
        	</div>

        	<div class="col-12 col-sm-8">
        		<div class="mt-4 ">

	                <div class="btn btn-primary btn-lg btn-flat btn-block">
	                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
	                  Submit Payment
	                </div>

	          

	              </div>
        	</div>
        	     
          </div>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>



   	<section class="content">
      <div class="container-fluid">


        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">41,410</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number">760</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                <span class="info-box-number">2,000</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>

        
        
      </div><!-- /.container-fluid -->
    </section>
    
    
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
<script>
    $(function () {
      $('.select2').select2()
    });
</script>

</body>
</html>