<?php 
  
  // session info here
  session_start();

  $admin_id = $_SESSION['admin_id']; // get session admin id
  $admin_fullname = $_SESSION['admin_fullname']; // get session admin fullname
  $admin_image = $_SESSION['admin_image'];

   if($_SESSION['admin_image'] == '') {
    $admin_image = "../../assets/img/avatar/avatar-1.png";
  } else {
    $admin_image = $admin_image;
  }

  // header links here
  require("scripts_header.php");

  // db connection
  require("../../backend/dbconn.php");
  $connection = dbConn();

?>


<body class="layout-3">
  <div id="app">
    <div class="main-wrapper container">
      <div class="navbar-bg" style="background-color:rgba(40, 102, 199, 0.97)"></div>
      <nav class="navbar navbar-expand-lg main-navbar" style="background-color:rgba(40, 102, 199, 0.97)">
        <a href="dashboard.php" class="navbar-brand sidebar-gone-hide text-capitalize"><img class="sidebar-gone-hide" src="../../assets/img/bh-logo-2.png">
        </a>
        <img class="sidebar-gone-hide rounded-circle" src="../../assets/img/liloan-logo-2.png" style="height: 85px; width: 90px; padding:10px;">
        <div class="navbar-nav">
          <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        </div>
      
       <form class="form-inline ml-auto">
          <ul class="navbar-nav">
            <!-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> -->
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">

          <?php 

            // notification here
            require("show_notification.php");
          
            // profile dropdown here
            require("show_listdropdown.php"); 

          ?>


        </ul>
      </nav>
      
      <nav class="navbar navbar-secondary navbar-expand-lg">
        <div class="container">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a href="dashboard.php" class="nav-link"><i class="fas fa-columns"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-user-friends"></i><span>Accounts</span></a>
                    <ul class="dropdown-menu" style="display: none;">
                      <li class="nav-item"><a href="accounts_patient.php" class="nav-link"> <span>Patient</span> </a></li>
                      <li class="nav-item"><a href="accounts_doctor.php" class="nav-link"> <span>Doctor</span> </a></li>
                      <li class="nav-item"><a href="accounts_bhw.php" class="nav-link"> <span>Barangay Health Worker</span> </a></li>
                    </ul>
                </li>

             <li class="nav-item">
              <a href="activity_logs.php" class="nav-link"><i class="fas fa-clipboard-list"></i><span>Activity Logs</span></a>
             </li>

             <li class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-calendar-check"></i>
                  <span>Appointments</span>
                </a>
                  <ul class="dropdown-menu" style="display: none;">
                      <li class="nav-item"><a href="appointments_book.php" class="nav-link"> <span>Book Appointment</span> </a></li>
                      <li class="nav-item"><a href="appointments_oc.php" class="nav-link"> <span>Online Consultation</span> </a></li>
                      <li class="nav-item"><a href="appointments_walk_in.php" class="nav-link"> <span>Walk-in Appointment</span> </a></li>
                    </ul>
                </li>

            <li class="nav-item">
              <a href="schedules.php" class="nav-link"><i class="fas fa-clock"></i><span>Schedules</span></a>
            </li>

          </ul>
        </div>
      </nav>

      <!-- Main Content -->
      <div class="main-content" style="min-height: 566px;">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
            <!-- <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            </div> -->
          </div>


         <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-user-friends" style="padding:20px;font-size:30px;"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Accounts</h4>
                  </div>
                  <div class="card-body">
                    3                  
                  </div>
                </div>
              </div>
            </div>

          
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-calendar-check" style="padding:20px;font-size:30px;"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Appointments</h4>
                  </div>
                  <div class="card-body">
                    12 </div>
                </div>
              </div>
            </div>

          
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-clock" style="padding:20px;font-size:30px;"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Schedules</h4>
                  </div>
                  <div class="card-body">
                    5                  </div>
                </div>
              </div>
            </div>
          </div> 

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Recent Activities</h4>
                  <div class="card-header-action">
                    <a href="#" class="btn btn-primary">View More <i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tbody>
                      <tr>
                        <th></th>
                        <th>User Fullname</th>
                        <th>User Role</th>
                        <th>User Activity</th>
                        <th>Date</th>
                      </tr>
                      <tr>
                        <td><a href="#">INV-87239</a></td>
                        <td class="font-weight-600">Remie Kaye Pulmones</td>
                        <td><div class="badge badge-primary">Doctor</div></td>
                        <td>Logged in into the system</td>
                        <td>July 19, 2018</td>
                      </tr>

                      <tr>
                        <td><a href="#">INV-48574</a></td>
                        <td class="font-weight-600">Nina Angelina Morcilla</td>
                        <td><div class="badge badge-primary">Patient</div></td>
                        <td>Newly registered patient account</td>
                        <td>July 21, 2018</td>
                      </tr>
     
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>
            </div>
         
          </div>


        </section>
      </div>
    </div>
    <br>

      <!-- <footer class="main-footer" style="background-color:rgba(40, 102, 199, 0.97)">
        <div class="container">
        <div class="footer-left text-white">
          © 2021 BRGYHEALTH: Barangay Health Center Appointment, Scheduling and Online Consultation System
        </div> 
      </div>
      </footer> -->

    </div>

  <!-- Menu for Footer Links -->
    <?php require("scripts_footer.php"); ?>
    <!-- -->


  </body>
</html>