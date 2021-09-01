<?php 
  
  // session info here
  session_start();

  $doctor_id = $_SESSION['doctor_id']; // get session doctor id
  $doctor_fullname = $_SESSION['doctor_fullname']; // get session doctor fullname

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
            <li class="nav-item">
              <a href="dashboard.php" class="nav-link"><i class="fas fa-columns"></i><span>Dashboard</span></a>
            </li>
          
             <li class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-user-friends"></i>
                  <span>Manage Patients</span>
                </a>
                  <ul class="dropdown-menu" style="display: none;">
                      <li class="nav-item"><a href="appointments_book.php" class="nav-link"> <span>Book Appointment</span> </a></li>
                      <li class="nav-item"><a href="appointments_oc.php" class="nav-link"> <span>Online Consultation</span> </a></li>
                      <li class="nav-item"><a href="appointments_walk_in.php" class="nav-link"> <span>Walk-in Appointment</span> </a></li>
                    </ul>
                </li>

            <li class="nav-item active">
              <a href="schedules.php" class="nav-link"><i class="fas fa-clock"></i><span>Schedules</span></a>
            </li>

          </ul>
        </div>
      </nav>

        <!-- Main Content -->
      <div class="main-content" style="min-height: 566px;">
        <section class="section">
          <div class="section-header">
            <h1>Add Barangay Health Worker Accounts</h1>
          
          </div>
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <form method="POST" action="../../backend/doctor_schedules.php">
                   <div class="card-header">
                 <h4></h4>
                  <div class="card-header-action">
                    <a href="schedules.php" class="btn btn-danger btn-sm">Return</a>
                  </div>
              </div>
                    <div class="card-body">

                      <input type="hidden" value="<?php echo $doctor_id ?>" name="doctorID">

                        <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>Day</label>
                              <select class="form-control" name="sched_day">
                                <option hidden selected>Select A Day</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                              </select>
                          </div>  
                        </div>
                          <div class="row">
                            <div class="form-group col-md-4 col-12">
                              <label>Start Time</label>
                              <input type="time" class="form-control" placeholder="Enter Schedule Start Time" name="sched_start">
                            </div>
                             <div class="form-group col-md-4 col-12">
                              <label>End Time</label>
                              <input type="time" class="form-control" placeholder="Enter Schedule End time" name="sched_end">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-left">
                      <button name="addDoctorSchedBtn" class="btn btn-primary">Submit</button>
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