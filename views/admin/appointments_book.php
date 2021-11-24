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
            <li class="nav-item">
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

          <!--  <li class="nav-item">
              <a href="activity_logs.php" class="nav-link"><i class="fas fa-clipboard-list"></i><span>Activity Logs</span></a>
             </li> -->

             <li class="nav-item active dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-calendar-check"></i>
                  <span>Appointments</span>
                </a>
                  <ul class="dropdown-menu" style="display: none;">
                      <li class="nav-item active"><a href="appointments_book.php" class="nav-link"> <span>Book Appointment</span> </a></li>
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
            <h1>Book Appointments</h1>
            </div>

   
        <div class="section-body">
            <div class="card">
              <div class="card-header">
                 <h4></h4>
                  <div class="card-header-action">
                  </div>
              </div>

               <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover table-bordered" id="table-subject">
                        <thead class="thead-light">
                          <tr>
                            <th>Patient Name</th>
                            <th>Medical Service</th>
                            <th>Doctor</th>
                            <th>Appointment Time</th>
                            <th>Appointment Date</th>
                          </tr>
                        </thead>
                        <tbody>

                      <?php 

                      // query for appointment
                      $sql = "SELECT 
                      d.user_firstname  as doc_fname, 
                      d.user_middlename as doc_mname, 
                      d.user_lastname   as doc_lname,
                      p.user_firstname  as patient_fname,
                      p.user_middlename as patient_mname,
                      p.user_lastname   as patient_lname,
                      s.service_name
                      FROM appointment a
                      JOIN user d
                      ON a.appointment_doctor_id = d.user_id
                      JOIN service s 
                      ON a.appointment_service_id = s.service_id
                      JOIN user p 
                      ON a.appointment_user_id = p.user_id
                      WHERE a.appointment_consultation_type = 'Book Appointment'
                      ";
                      $result = mysqli_query($connection,$sql);

                      while($row = mysqli_fetch_assoc($result)) {
                    
                      // doctor fullname
                      $doc_firstname    = ucfirst($row['doc_fname']);
                      $doc_middlename   = ucfirst($row['doc_mname']);
                      $doc_lastname     = ucfirst($row['doc_lname']);

                      $doc_name = $doc_firstname.' '.$doc_middlename.'.'.' '.$doc_lastname;

                      // patient fullname
                      $patient_firstname    = ucfirst($row['patient_fname']);
                      $patient_middlename   = ucfirst($row['patient_mname']);
                      $patient_lastname     = ucfirst($row['patient_lname']);

                      $patient_name = $patient_firstname.' '.$patient_middlename.'.'.' '.$patient_lastname;

                      
                      // service info
                      $service_name = $row['service_name'];


                      ?>

                        <tr>
                          <td><?php echo $patient_name ?></td>
                          <td><?php echo $service_name ?></td>
                          <td><?php echo $doc_name ?></td>
                          <td>12:00PM - 1:30PM</td>
                          <td>8/6/2021</td>
                         
                         </tr>
                      
                      <?php } ?>

                        </tbody>
                      </table>
                    </div>
              </div>
              
              <div class="card-footer bg-whitesmoke"> </div>
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