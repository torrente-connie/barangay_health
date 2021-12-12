<?php 
  
  // session info here
  session_start();

  $doctor_id = $_SESSION['doctor_id']; // get session doctor id
  $doctor_fullname = $_SESSION['doctor_fullname']; // get session doctor fullname
  $doctor_image = $_SESSION['doctor_image'];

  if($_SESSION['doctor_image'] == '') {
    $doctor_image = "../../assets/img/avatar/avatar-1.png";
  } else {
    $doctor_image = $doctor_image;
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
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-calendar-check"></i>
                  <span>Manage Appointments</span>
                </a>
                  <ul class="dropdown-menu" style="display: none;">
                      <li class="nav-item"><a href="appointments_book.php" class="nav-link" style="padding-right:0 !important"> <span>Face to Face Appointment</span> </a></li>
                      <li class="nav-item"><a href="appointments_oc.php" class="nav-link"> <span>Virtual Consultation</span> </a></li>
                      <li class="nav-item"><a href="appointments_walk_in.php" class="nav-link"> <span>Walk-in Appointment</span> </a></li>
                    </ul>
                </li>

              <li class="nav-item">
                   <a href="online_consultation.php" class="nav-link"><i class="fas fa-notes-medical"></i><span>Virtual Consultation</span></a>
               </li>


            <li class="nav-item">
              <a href="patients.php" class="nav-link"><i class="fas fa-user-friends"></i><span>Manage Patients</span></a>
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
                  <h4>On-going Appoinments</h4>
                  <div class="card-header-action">
                    <a href="view_completed_appointments.php" class="btn btn-primary">View Completed Appointments </a>
                  </div>
                </div>
                
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tbody>
                      <tr>
                            <th>Appointment Booked By</th>
                            <!-- <th>Appointment Doctor</th> -->
                            <th>Patient Name</th>
                            <th>Medical Service</th>
                           <!--  <th>Appointment Date</th>
                            <th>Appointment Time</th> -->
                            <th>Appointment Status</th>
                            <th>Appointment Details</th> 
                            <th></th>
                          </tr>

                       <?php 

                      $sql = "SELECT 
                      d.user_id as doctor_id,
                      d.user_account_id as doctor_account,
                      d.user_firstname  as doc_fname, 
                      d.user_middlename as doc_mname, 
                      d.user_lastname   as doc_lname,
                      p.user_firstname  as patient_fname,
                      p.user_middlename as patient_mname,
                      p.user_lastname   as patient_lname,
                      p.user_id as patient_id,
                      p.user_account_id as patient_account,
                      a.appointment_id as appointment_id,
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
                      a.appointment_type as appointment_type,
                      a.appointment_status as appointment_status,
                      a.appointment_reason as appointment_reason
                      FROM appointment a
                      JOIN user d 
                      ON a.appointment_doctor_id = d.user_id 
                      JOIN user p 
                      ON a.appointment_patient_id = p.user_id 
                      JOIN doctor_schedule_time dst 
                      ON a.appointment_selected_time = dst.schedule_time_id
                      WHERE d.user_id = '$doctor_id' AND a.appointment_status IN (7) 
                      ORDER BY a.appointment_id ASC
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

                      // id
                      $appointment_id = $row['appointment_id'];

                      // reason
                      $appointment_reason = $row['appointment_reason'];

                      $appointment_status = $row['appointment_status'];

                      ?>

                    
                        <tr>
                          <td><a href="#" style="text-decoration: none;"><?php echo $patient_name ?></a></td>
                          <!-- <td><?php //echo $doc_name ?></td> -->
                          <td><?php echo $appoint_patient_name ?></td>
                          <td><?php echo $appoint_service ?></td>
                          <td>
                          <?php  
                          // if status = pending
                          if($appointment_status == 1) {

                          ?>
                            <span class="badge badge-primary badge-pill">Pending</span>

                          <?php 
                          // if status = cancel
                          } else if($appointment_status == 2) { ?>

                            <span class="badge badge-danger badge-pill">Cancel</span>
                            <p>Reason: <?php echo $appointment_reason ?></p>

                          <?php 
                          // if status = accept
                          } else if($appointment_status == 3) { ?>

                            <span class="badge badge-info badge-pill">Accepted</span>

                          <?php } else if($appointment_status == 4) { ?>

                            <span class="badge badge-success badge-pill">Approved</span>

                          <?php } else if($appointment_status == 5) { ?>

                            <span class="badge badge-danger badge-pill">Reschedule</span>

                          <?php } else if($appointment_status == 6) { ?>

                          
                          <?php } else if($appointment_status == 7) { ?>

                            <span class="badge badge-primary badge-pill">Confirmed</span>

                          <?php } ?>
                              
                          </td>
                         <!--  <td><?php //echo $appoint_schedule_date ?></td>
                          <td><?php //echo $format_start ?> - <?php //echo $format_end ?></td> -->
                          <td>
                                <button class="btn btn-info btn-sm btn-block appointmentDetailsDoctor" id='<?php echo $appointment_id ?>'> View Details </button> 
                          </td> 
                          <td>

                          <?php  
                          // if status = pending
                          if($appointment_status == 1) {

                          ?>

                        
                          <?php 
                          // if status = cancel
                          } else if($appointment_status == 2) { ?>

                           
                          <?php 
                          // if status = accept
                          } else if($appointment_status == 3) { ?>

                              <button class="btn btn-primary btn-sm btn-block approveAppointmentDoctor" id='<?php echo $appointment_id ?>'> Approve </button> 

                             <button class="btn btn-danger btn-sm btn-block rescheduleAppointmentDoctor" id='<?php echo $appointment_id ?>'> Reschedule </button> 

                          <?php }
                          // if status = approve
                          else if($appointment_status == 4) { ?>

              
                          <?php }
                          // if status = reschedule
                          else if($appointment_status == 5) { ?>

                           <a href="#approveAppointmentDoctor" class="btn btn-primary text-white  btn-sm btn-block" data-toggle="modal" data-approve-id="<?php echo $appointment_id ?>">Approve</a>
                             <a href="#ssrescheduleAppointmentDoctor" class="btn btn-danger text-white btn-block btn-sm" data-toggle="modal" data-reschedule-id="<?php echo $appointment_id ?>"> Reschedule </a>
                      
                          <?php } ?>

                          </td>
                        </tr>

                    <?php } ?>

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