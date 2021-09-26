<?php 
  
  // session info here
  session_start();

   $patient_id = $_SESSION['patient_id']; // get session admin id
  $patient_fullname = $_SESSION['patient_fullname']; // get session admin fullname
  $patient_image = $_SESSION['patient_image'];

   if($_SESSION['patient_image'] == '') {
    $patient_image = "../../assets/img/avatar/avatar-1.png";
  } else {
    $patient_image = $patient_image;
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
          
          ?>

          <!-- profile here -->
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
             <img alt="image" src="<?php echo $patient_image ?>" class="rounded-circle mr-1" style="width:30px;height:30px;">
            <div class="d-sm-none d-lg-inline-block text-capitalize">Hi, <?php echo $patient_fullname; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item active has-icon" href="show_changepassword.php" style="cursor: pointer">
                <i class="fas fa-unlock"></i> Change Password
              </a>
              <a class="dropdown-item has-icon" href="show_profile.php" style="cursor: pointer">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="../../logout.php" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>

        
        </ul>
      </nav>

      <nav class="navbar navbar-secondary navbar-expand-lg">
        <div class="container">
          <ul class="navbar-nav">

            <li class="nav-item">
              <a href="dashboard.php" class="nav-link"><i class="fas fa-columns"></i><span>Dashboard</span></a>
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
                   <a href="online_consultation.php" class="nav-link"><i class="fas fa-notes-medical"></i><span>Online Consultation</span></a>
               </li>

          </ul>
        </div>
      </nav>

          <!-- Main Content -->
     <div class="main-content" style="min-height: 566px;">
        <section class="section">
          <div class="section-header">
            <h1>Account Change Password</h1>
          </div>
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <form method="post" class="needs-validation" novalidate="">
                    <div class="card-header">
                      <h4>Change Password</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>Old Password</label>
                            <input type="email" class="form-control" required="">
                            <div class="invalid-feedback">
                              Please fill in the email
                            </div>
                          </div>
                        </div>
                         <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>New Password</label>
                            <input type="email" class="form-control" required="">
                            <div class="invalid-feedback">
                              Please fill in the email
                            </div>
                          </div>
                        </div>
                         <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>Confirm New Password</label>
                            <input type="email" class="form-control" required="">
                            <div class="invalid-feedback">
                              Please fill in the email
                            </div>
                          </div>
                        </div>
                       
                      
                    </div>
                    <div class="card-footer text-left">
                      <button class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

     
        </section>
      </div>




    </div>


    
  
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