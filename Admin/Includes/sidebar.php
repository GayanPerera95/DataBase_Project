 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">My Plus Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
     
      <!-- Sidebar Menu -->

      <?php   $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);  ?> 
      <?php   $active="active"; ?> 


      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


             <li class="nav-item">
                <a href="index.php" class="nav-link   <?php  if($curPageName=="index.php"){ echo $active; } ?> ">
                  <i class="nav-icon fas fa-calendar-alt"></i>
                  <p>
                    Administrator
                  </p>
                 </a>
              </li>

              <li class="nav-item">
                <a href="CutomerScreen.php" class="nav-link <?php  if($curPageName=="CutomerScreen.php"){ echo $active; } ?> ">
                  <i class="nav-icon fas fa-calendar-alt"></i>
                  <p>
                    Customer Management
                  </p>
                 </a>
              </li>


              <li class="nav-item">
                <a href="EmployeeScrenn.php" class="nav-link  <?php  if($curPageName=="EmployeeScrenn.php"){ echo $active; } ?>">
                  <i class="nav-icon fas fa-calendar-alt"></i>
                  <p>
                    Emplyoyee Management
                  </p>
                 </a>
              </li>

              <li class="nav-item">
                <a href="SalesScreen.php" class="nav-link  <?php  if($curPageName=="SalesScreen.php"){ echo $active; } ?>">
                  <i class="nav-icon fas fa-calendar-alt"></i>
                  <p>
                    Stock Managenemt
                  </p>
                 </a>
              </li>


              <li class="nav-item">
                <a href="RepairScreen.php" class="nav-link <?php  if($curPageName=="RepairScreen.php"){ echo $active; } ?>">
                  <i class="nav-icon fas fa-calendar-alt"></i>
                  <p>
                    Repair Management
                  </p>
                 </a>
              </li>

        </ul>

        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>