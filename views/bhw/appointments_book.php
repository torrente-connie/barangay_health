<?php 
  
  // session info here
  session_start();

  $bhw_id = $_SESSION['bhw_id']; // get session bhw id
  $bhw_fullname = $_SESSION['bhw_fullname']; // get session bhw fullname
  $bhw_image = $_SESSION['bhw_image'];

  if($_SESSION['bhw_image'] == '') {
    $bhw_image = "../../assets/img/avatar/avatar-1.png";
  } else {
    $bhw_image = $bhw_image;
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
                            <th>Appointment Booked By</th>
                            <th>Appointment Doctor</th>
                            <th>Patient Name</th>
                            <th>Medical Service</th>
                           <!--     <th>Appointment Date</th>
                            <th>Appointment Time</th> -->
                            <th>Appointment Details</th>
                            <th>Appointment Status</th>
                          </tr>
                        </thead>
                        <tbody>

                      <?php 

                      $sql = "SELECT 
                      d.user_account_id as doctor_account,
                      d.user_firstname  as doc_fname, 
                      d.user_middlename as doc_mname, 
                      d.user_lastname   as doc_lname,
                      p.user_firstname  as patient_fname,
                      p.user_middlename as patient_mname,
                      p.user_lastname   as patient_lname,
                      p.user_account_id as patient_account,
                      a.appointment_patient_fname as appoint_pfname,
                      a.appointment_patient_mname as appoint_pmname,
                      a.appointment_patient_lname as appoint_plname,
                      a.appointment_patient_email as appoint_pemail,
                      a.appointment_patient_pnum as appoint_ppnum,
                      a.appointment_selected_date as appoint_date,
                      a.appointment_selected_time as appoint_dst_id, 
                      dst.schedule_start_time as appoint_start_time,
                      dst.schedule_end_time as appoint_end_time,
                      a.appointment_selected_service as appoint_service,
                      a.appointment_type as appointment_type
                      FROM appointment a
                      JOIN user d 
                      ON a.appointment_doctor_id = d.user_id 
                      JOIN user p 
                      ON a.appointment_patient_id = p.user_id 
                      JOIN doctor_schedule_time dst 
                      ON a.appointment_selected_time = dst.schedule_time_id
                      WHERE a.appointment_type = 'bookappointment'
                      ";

                      $result = mysqli_query($connection,$sql);

                      while($row = mysqli_fetch_assoc($result)) {
                    
                      // doctor fullname
                      $doc_account      = $row['doctor_account'];
                      $doc_firstname    = ucfirst($row['doc_fname']);
                      $doc_middlename   = ucfirst($row['doc_mname']);
                      $doc_lastname     = ucfirst($row['doc_lname']);

                      $doc_name = $doc_firstname.' '.$doc_middlename.'.'.' '.$doc_lastname;

                      // user patient fullname
                      $patient_account      = $row['patient_account'];
                      $patient_firstname    = ucfirst($row['patient_fname']);
                      $patient_middlename   = ucfirst($row['patient_mname']);
                      $patient_lastname     = ucfirst($row['patient_lname']);

                      $patient_name = $patient_firstname.' '.$patient_middlename.'.'.' '.$patient_lastname;

                      // appointed patient
                      $appoint_pfname    = ucfirst($row['appoint_pfname']);
                      $appoint_pmname   = ucfirst($row['appoint_pmname']);
                      $appoint_plname     = ucfirst($row['appoint_plname']);

                      $appoint_patient_name = $appoint_pfname.' '.$appoint_pmname.'.'.' '.$appoint_plname;

                      // the appointed patient name
                      $appoint_patient_email = $row['appoint_pemail'];
                      $appoint_patient_email = $row['appoint_ppnum'];

                      // appointment schedules
                      $time_schedule_id = $row['appoint_dst_id'];
                      $appoint_schedule_date = $row['appoint_date'];

                      $appoint_start_time = $row['appoint_start_time'];
                      $appoint_end_time = $row['appoint_end_time'];

                      // appointment service and booking appointment type
                      $appoint_service = $row['appoint_service'];
                      $appoint_type = $row['appointment_type'];

                      // format time
                      $format_start = date("h:i:A", strtotime($appoint_start_time));
                      $format_end   = date("h:i:A", strtotime($appoint_end_time));

                      // for tool tip
                      $acname_tooltip = $patient_name;

                      ?>

                        <tr>
                          <td><a href="#" style="text-decoration: none;"><?php echo $patient_name ?></a></td>
                          <td><?php echo $doc_name ?></td>
                          <td><?php echo $appoint_patient_name ?></td>
                          <td><?php echo $appoint_service ?></td>
                          <!--    <td><?php //echo $appoint_schedule_date ?></td>
                          <td><?php //echo $format_start ?> - <?php //echo $format_end ?></td> -->
                          <td>
                            <button class="btn btn-info btn-block btn-sm" data-toggle="modal" data-target="#appointmentDetails"> View Details </button>
                          </td>
                          <td>
                            <a class="btn btn-primary text-white btn-sm">Accept</a>
                            <a class="btn btn-danger text-white btn-sm">Cancel</a>
                          </td>
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


    <!-- Modal for View Appointment Details -->
       <div class="modal fade" tabindex="-1" role="dialog" id="appointmentDetails">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">View Appointment Details</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
              </div>
             <div class="card-body">
              
               <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Date: 10/27/2021
                        <span class="badge badge-success badge-pill">Completed</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Schedule Time: <?php echo $format_start ?> - <?php echo $format_end ?>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Status: 
                      </li>
                    </ul>        
        
              </div>
            </div>
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