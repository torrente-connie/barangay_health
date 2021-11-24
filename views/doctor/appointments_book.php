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
            <li class="nav-item">
              <a href="dashboard.php" class="nav-link"><i class="fas fa-columns"></i><span>Dashboard</span></a>
            </li>
          
             <li class="nav-item active dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-user-friends"></i>
                  <span>Manage Patients</span>
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
                            <th>Appointment Booked By</th>
                            <!-- <th>Appointment Doctor</th> -->
                            <th>Patient Name</th>
                            <th>Medical Service</th>
                           <!--     <th>Appointment Date</th>
                            <th>Appointment Time</th> -->
                            <th>Appointment Status</th>
                            <th>Appointment Details</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>

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
                      WHERE a.appointment_type = 'bookappointment' AND d.user_id = '$doctor_id' AND a.appointment_status != 0
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

                            <span class="badge badge-danger badge-pill">Danger</span>

                          <?php 
                          // if status = accept
                          } else if($appointment_status == 3) { ?>

                            <span class="badge badge-info badge-pill">Accepted</span>

                          <?php } else if($appointment_status == 4) { ?>

                            <span class="badge badge-success badge-pill">Approved</span>

                          <?php } else if($appointment_status == 5) { ?>

                            <span class="badge badge-danger badge-pill">Reschedule</span>

                          <?php } ?>
                              
                          </td>
                          <!--    <td><?php //echo $appoint_schedule_date ?></td>
                          <td><?php //echo $format_start ?> - <?php //echo $format_end ?></td> -->
                          <td>
                            <button class="btn btn-info btn-block btn-sm" data-toggle="modal" data-target="#appointmentDetails"> View Details </button>
                          </td>
                          <td>

                          <?php  
                          // if status = pending
                          if($appointment_status == 1) {

                          ?>

                            <a class="btn btn-light text-dark btn-sm btn-block" data-toggle="modal" data-approve-id="<?php echo $appointment_id ?>">Approve</a>
                             <a class="btn btn-light text-dark btn-block btn-sm" data-toggle="modal" data-reschedule-id="<?php echo $appointment_id ?>"> Reschedule </a>


                          <?php 
                          // if status = cancel
                          } else if($appointment_status == 2) { ?>

                             <a class="btn btn-light text-dark btn-sm btn-block" data-toggle="modal" data-approve-id="<?php echo $appointment_id ?>">Approve</a>
                             <a class="btn btn-light text-dark btn-block btn-sm" data-toggle="modal" data-reschedule-id="<?php echo $appointment_id ?>"> Reschedule </a>

                          <?php 
                          // if status = accept
                          } else if($appointment_status == 3) { ?>

                             <a href="#approveAppointmentDoctor" class="btn btn-primary text-white  btn-sm btn-block" data-toggle="modal" data-approve-id="<?php echo $appointment_id ?>">Approve</a>
                             <a href="#rescheduleAppointmentDoctor" class="btn btn-danger text-white btn-block btn-sm" data-toggle="modal" data-reschedule-id="<?php echo $appointment_id ?>"> Reschedule </a>

                          <?php }
                          // if status = approve
                          else if($appointment_status == 4) { ?>

                             <a class="btn btn-light text-dark btn-sm btn-block" data-toggle="modal" data-approve-id="<?php echo $appointment_id ?>">Approve</a>

                             <a class="btn btn-light text-dark btn-block btn-sm" data-toggle="modal" data-reschedule-id="<?php echo $appointment_id ?>"> Reschedule </a>

                          <?php }
                          // if status = reschedule
                          else if($appointment_status == 5) { ?>

                           <a href="#approveAppointmentDoctor" class="btn btn-primary text-white  btn-sm btn-block" data-toggle="modal" data-approve-id="<?php echo $appointment_id ?>">Approve</a>
                             <a href="#rescheduleAppointmentDoctor" class="btn btn-danger text-white btn-block btn-sm" data-toggle="modal" data-reschedule-id="<?php echo $appointment_id ?>"> Reschedule </a>
                      
                          <?php } ?>

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
                        
                        <?php 

                        if($appointment_status == 1) {

                        ?>

                       <span class="badge badge-primary badge-pill">Pending</span>

                       <?php } else if($appointment_status == 2) { ?>

                       <span class="badge badge-danger badge-pill">Cancel</span>

                       <?php } else if($appointment_status == 3) { ?>

                       <span class="badge badge-info badge-pill">Accepted</span>

                       <?php } else if($appointment_status == 4) { ?>

                       <span class="badge badge-success badge-pill">Approved</span>

                       <?php } else if($appointment_status == 5) { ?>

                       <span class="badge badge-danger badge-pill">Reschedule</span>                        
                       <?php } ?>



                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Schedule Time: <?php echo $format_start ?> - <?php echo $format_end ?>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Reason: <?php echo $appointment_reason ?>
                      </li>
                    </ul>        
        
              </div>
            </div>
          </div>
        </div>

                   <!-- Modal for View Appointment Details -->
       <div class="modal fade" tabindex="-1" role="dialog" id="approveAppointmentDoctor">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Approve Appointment</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
              </div>
             <div class="card-body">

              <h4>Are you sure you want to approve this appointment?</h4>
              
              <form method="POST" action="../../backend/doctor_appointment_book.php">

                  <input type="hidden" name="approveID" id="approveID">

                  <div class="form-group mt-4">
                    <button type="submit" name="approveAppointmentSubmit" class="btn btn-success btn-block" tabindex="4">
                      Yes
                    </button>
                    <button class="btn btn-danger btn-block" tabindex="4" data-dismiss="modal">
                      No
                    </button>
                  </div>
                </form>

        
              </div>
            </div>
          </div>
        </div>

               <!-- Modal for View Appointment Details -->
       <div class="modal fade" tabindex="-1" role="dialog" id="rescheduleAppointmentDoctor">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Cancel Appointment</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
              </div>
             <div class="card-body">

              <h4>Are you sure you want to cancel this appointment?</h4>
              
              <form method="POST" action="../../backend/bhw_appointment_book.php">

                  <input type="hidden" name="rescheduleID" id="rescheduleID">

                  <div class="form-group mt-4">
                    <label for="reason">Reason</label>
                    <input id="reason" type="text" class="form-control" name="reason" tabindex="1" required="" autofocus="" placeholder="Please state the reason for the cancellation of the appointment..">
                  </div>

                  <div class="form-group">
                    <button type="submit" name="rescheduleAppointmentSubmit" class="btn btn-success" tabindex="4">
                      Submit
                    </button>
                    <button class="btn btn-danger" tabindex="4" data-dismiss="modal">
                      Close
                    </button>
                  </div>
                </form>

        
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

   <script>
      // tempo lang sani para maka display
      $('#rescheduleAppointmentDoctor').on('show.bs.modal', function(e) {
        var rescheduleID = $(e.relatedTarget).data('reschedule-id');
      $(e.currentTarget).find('input[id="rescheduleID"]').val(rescheduleID);
    });
    </script>

     <script>
      // tempo lang sani para maka display
      $('#approveAppointmentDoctor').on('show.bs.modal', function(e) {
        var approveID = $(e.relatedTarget).data('approve-id');
      $(e.currentTarget).find('input[id="approveID"]').val(approveID);
    });
    </script>


  </body>
</html>