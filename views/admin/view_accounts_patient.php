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


            // patient information 
            $patient_id = $_GET['pid'];

            $sql = "SELECT * FROM user WHERE user_id = '$patient_id' ";
            $result = mysqli_query($connection,$sql);

            while($row = mysqli_fetch_assoc($result)) {
              $account_id = $row['user_account_id'];
              $account_type = $row['user_type'];

               // user full name
               $firstname    = ucfirst($row['user_firstname']);
               $middlename   = ucfirst($row['user_middlename']);
               $lastname     = ucfirst($row['user_lastname']);

               $fullname = $firstname.' '.$middlename[0].'.'.' '.$lastname;

               if($row['user_image'] == '') {
                $account_image = "../../assets/img/avatar/avatar-1.png";
              } else {
                $account_image = $row['user_image'];
              }

               // user info
               $email = $row['user_email'];
               $phonenumber = $row['user_cnum'];

            }


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
                    <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-user-friends"></i><span>Accounts</span></a>
                    <ul class="dropdown-menu" style="display: none;">
                      <li class="nav-item active"><a href="accounts_patient.php" class="nav-link"> <span>Patient</span> </a></li>
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
            <h1>Patient Medical Record</h1>
          </div>
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                    <img alt="image" src="../<?php echo $account_image ?>" class="rounded-circle profile-widget-picture" style="width:100px;height:100px">
                    <div class="profile-widget-items">
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Account ID</div>
                        <div class="profile-widget-item-value"><?php echo $account_id ?></div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Account Type</div>
                        <div class="profile-widget-item-value"><?php echo $account_type ?></div>
                      </div>
                    </div>
                  </div>
                  <div class="profile-widget-description">
                    <div class="profile-widget-name"> <?php echo $fullname ?> </div>
                      <ul class="list-group list-group-flush">
                      <li class="list-group-item">Email: <?php echo $email ?></li>
                      <li class="list-group-item">Phone: <?php echo $phonenumber ?></li>
                     
                    </ul>
                   
                  </div>
                  <div class="card-footer text-center">
                    <hr>
                  </div>
                </div>
              </div>


              <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <div class="card-header">
                     <h4>Medical Records</h4>
                        <div class="card-header-action">
                          <a href="accounts_patient.php" class="btn btn-danger btn-sm">Return</a>
                        </div>
                     </div>
                    <div class="card-body">
                     <div class="table-responsive">
                      <table class="table table-hover table-bordered" id="table-subject" style="overflow-y:scroll;height:300px; display:block; " >
                        <thead class="thead-light">
                          <tr>
                            <th></th>
                            <th>Checked By</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>

                      <?php 

                      ?>

                        <tr>
                          <td><button class="btn btn-primary">VIEW</button></td>
                          <td style="width:300px;">Remie Kaye Pulmones</td>
                          <td style="width:150px;">8/6/2021</td>
                        </tr>

                         <tr>
                          <td><button class="btn btn-primary">VIEW</button></td>
                          <td style="width:300px;">Remie Kaye Pulmones</td>
                          <td style="width:150px;">8/6/2021</td>
                        </tr>

                         <tr>
                          <td><button class="btn btn-primary">VIEW</button></td>
                          <td style="width:300px;">Remie Kaye Pulmones</td>
                          <td style="width:150px;">8/6/2021</td>
                        </tr>

                      
                      <?php  ?>

                        </tbody>
                      </table>
                    </div>
                      
                    </div>
                    <div class="card-footer text-right">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

       <div class="section-body">
            <div class="card">
              <div class="card-header">
                 <h4>Appointment History</h4>
                  <div class="card-header-action">
                    <a href="#class_add.php" class="btn btn-primary btn-sm">Print</a>
                  </div>
              </div>

            <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover table-bordered" id="table-subject">
                        <thead class="thead-light">
                          <tr>
                            <th>Medical Service</th>
                            <th>Doctor</th>
                            <th>Appointment Type</th>
                            <th>Appointment Time</th>
                            <th>Appointment Date</th>
                          </tr>
                        </thead>
                        <tbody>

                      <?php 

                      // query for appointment
                      $sql = "SELECT * FROM appointment a
                      JOIN user d
                      ON a.appointment_doctor_id = d.user_id
                      JOIN service s 
                      ON a.appointment_service_id = s.service_id
                      WHERE a.appointment_user_id = '$patient_id'
                      ";
                      $result = mysqli_query($connection,$sql);

                      while($row = mysqli_fetch_assoc($result)) {
                    
                      $service_name = $row['service_name'];

                      $appointment_type = $row['appointment_consultation_type'];

                      ?>

                        <tr>
                          <td><?php echo $service_name ?></td>
                          <td>Remie Kaye Pulmones</td>
                          <td><?php echo $appointment_type ?></td>
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