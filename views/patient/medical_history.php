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
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-calendar-check"></i>
                  <span>Appointments</span>
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

                 <li class="nav-item active">
                   <a href="medical_history.php" class="nav-link"><i class="fas fa-pen"></i><span>Medical History</span></a>
                </li>

          </ul>
        </div>
      </nav>
        <!-- Main Content -->
      <div class="main-content" style="min-height: 566px;">
        <section class="section">
          <div class="section-header">
            <h1>Medical History</h1>
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
                          <tr class="text-center">
                            <th>Assigned Patient</th>
                            <th>Medical Service</th>
                            <th>Appointment Type</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Medical Description</th>
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
                      p.user_account_id as patient_account,
                      p.user_id as patient_id,
                      a.appointment_id as appointment_id,
                      mh.medical_history_id as medical_history_id,
                      mh.medical_history_user_id as mh_user_id,
                      mh.medical_history_doctor_id as mh_doctor_id,
                      mh.medical_history_appointment_id as mh_appointment_id,
                      mh.medical_history_pfname as mh_pfname,
                      mh.medical_history_pmname as mh_pmname,
                      mh.medical_history_plname as mh_plname,
                      mh.medical_history_page as mh_page,
                      mh.medical_history_pallergy as mh_pallergy,
                      mh.medical_history_psymptoms as mh_psymptoms,
                      mh.medical_history_ptemp as mh_ptemp,
                      mh.medical_history_pheart as mh_pheart,
                      mh.medical_history_pbp as mh_pbp,
                      mh.medical_history_pulse as mh_pulse,
                      mh.medical_history_pcomments as mh_pcomments,
                      mh.medical_history_pprescription as mh_pprescription,
                      mh.medical_history_appointment_type as mh_atype,
                      mh.medical_history_medical_service as mh_mservice,
                      mh.medical_history_date as mh_date,
                      mh.medical_history_stime as mh_stime,
                      mh.medical_history_etime as mh_etime,
                      mh.medical_history_datetime as mh_datetime,
                      mh.medical_history_status as mh_status,
                      mh.medical_history_bool as mh_bool
                      FROM medical_history mh
                      JOIN user p 
                      ON mh.medical_history_user_id = p.user_id 
                      JOIN user d 
                      ON mh.medical_history_doctor_id = d.user_id
                      JOIN appointment a 
                      ON mh.medical_history_appointment_id = a.appointment_id
                      WHERE mh.medical_history_user_id = '$patient_id' AND mh.medical_history_status = 1
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
                      $book_patient_account      = $row['patient_account'];
                      $book_patient_firstname    = ucfirst($row['patient_fname']);
                      $book_patient_middlename   = ucfirst($row['patient_mname']);
                      $book_patient_lastname     = ucfirst($row['patient_lname']);

                      $book_patient_name = $book_patient_firstname.' '.$book_patient_middlename.'.'.' '.$book_patient_lastname;

                      // user patient fullname
                      $mh_firstname    = ucfirst($row['mh_pfname']);
                      $mh_middlename   = ucfirst($row['mh_pmname']);
                      $mh_lastname     = ucfirst($row['mh_plname']);

                      $mh_name = $mh_firstname.' '.$mh_middlename.'.'.' '.$mh_lastname;

                      // format date and time
                      $date = $row['mh_date'];
                      $format_start = date("h:i:A", strtotime($row['mh_stime']));
                      $format_end   = date("h:i:A", strtotime($row['mh_etime']));


                        //
                        $mh_id = $row['medical_history_id'];
                        $mh_mservice = $row['mh_mservice'];
                        $mh_atype = $row['mh_atype'];

                        if($mh_atype == "bookappointment") {
                          $atype = "Face to Face Appointment";
                        } else if($mh_atype == "onlineappointment") {
                          $atype = "Virtual Consultation";
                        } else if($mh_atype = "walkinappointment") {
                          $atype = "Walk-In Appointment";
                        }

                      ?>

                        <tr>
                          <td><?php echo $mh_name ?></td>
                          <td><?php echo $mh_mservice ?></td>
                          <td><?php echo $atype ?></td>
                          <td><?php echo $date ?></td>
                          <td><?php echo $format_start ?> - <?php echo $format_end ?></td>
                          <td>
                            <a href="#patients_add_description.php?plid=<?php echo $mh_id ?>" class="btn btn-primary btn-sm btn-block"> View </a> 
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