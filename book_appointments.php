<?php

  require("scripts_header.php");

  // db connection
  require("backend/dbconn.php");
  $connection = dbConn();

  // get patient fullname 
  $sqlPatientName = "SELECT * FROM user WHERE user_id = '$patient_id' AND user_type = 'Patient' ";
  $resultPatientName = mysqli_query($connection,$sqlPatientName);

  while($rowPatientName = mysqli_fetch_assoc($resultPatientName)) {
    $pfname = $rowPatientName['user_firstname'];
    $pmname = $rowPatientName['user_middlename'];
    $plname = $rowPatientName['user_lastname'];
  }
  
?>

<body class="layout-3">
  <div id="app">
    <div class="main-wrapper container">
      <div class="navbar-bg" style="background-color:rgba(40, 102, 199, 0.97)"></div>
      <nav class="navbar navbar-expand-lg main-navbar" style="background-color:rgba(40, 102, 199, 0.97)">
        <a href="home_page.php" class="navbar-brand sidebar-gone-hide text-capitalize"><img class="sidebar-gone-hide" src="assets/img/bh-logo-2.png">
        </a>
        <img class="sidebar-gone-hide rounded-circle" src="assets/img/liloan-logo-2.png" style="height: 85px; width: 90px; padding:10px;">
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

            // profile dropdown here
            require("show_listdropdown.php"); 

          ?>

        
        </ul>
      </nav>

      <nav class="navbar navbar-secondary navbar-expand-lg">
        <div class="container">
          <ul class="navbar-nav">

            <li class="nav-item active">
              <a href="home_schedules.php" class="nav-link"><i class="fas fa-clock"></i><span>Schedules</span></a>
            </li>
           
            <li class="nav-item">
              <a href="home_appointments.php" class="nav-link"><i class="fas fa-calendar-check"></i><span>Appointments</span></a>
            </li>


          </ul>
        </div>
      </nav>

        <!-- Main Content -->
      <div class="main-content" style="min-height: 566px;">
        <section class="section">
          <div class="section-header">
            <h1>Book An Appointment</h1>
            </div>

  <div class="row">
    <div class="col-md-4">
   
        <div class="section-body">
            <div class="card">
              <div class="card-header">
                 <h4>Preview Selected Doctor</h4>
               </div>
           <div class="col-12 col-md-12 col-lg-12">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                    <img alt="image" src="assets/img/avatar/avatar-1.png" class=" profile-widget-picture mt-1 mr-2" style="width:100px;height:100px;">
                    <div class="profile-widget-items">
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-value mb-2">Dr. Remie Kaye B. Pulmones</div>
                        <div class="profile-widget-item-label">General Physician</div>
                      </div>
                    </div>
                  </div>
                  <div class="profile-widget-description">
                    <div class="profile-widget-name">Doctor Schedule</div>
                      <ul class="list-group list-group-flush">
                      <li class="list-group-item">Mon - 07:04:PM to 08:04:PM</li>
                      <li class="list-group-item">Tue - 07:04:PM to 08:04:PM</li>
                      <li class="list-group-item">Wed - 07:04:PM to 08:04:PM</li>
                    </ul>
                   
                  </div>
                </div>
              </div>  
                <!-- <div class="card-footer text-center">
                      <button class="btn btn-primary">View Doctor Information</button>
                  </div> -->
                 </div>
            </div>


          </div>
      

      <div class="col-md-8">
        <div class="section-body">
            <div class="card">
              <div class="card-header">
                 <h4>Choose An Appointment Schedule</h4>
               </div>
            <form action="#backend/bookappointment.php" method="POST">
               <div class="card-body">
                        <div class="row">
                          <div class="form-group col-md-4 col-12">
                            <label>First Name</label>
                            <input type="text" class="form-control" value="<?php echo $pfname ?>" name="patient_firstname">
                          </div>
                           <div class="form-group col-md-4 col-12">
                            <label>Middle Name</label>
                            <input type="text" class="form-control" value="<?php echo $pmname ?>" name="patient_middlename">
                          </div>
                           <div class="form-group col-md-4 col-12">
                            <label>Last Name</label>
                            <input type="text" class="form-control" value="<?php echo $plname ?>" name="patient_lastname">
                          </div>
                        </div>
                         <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Enter Email Address" name="bhw_email">
                          </div>
                           <div class="form-group col-md-6 col-12">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" placeholder="Enter Phone Number" name="bhw_phonenumber">
                          </div>
                        </div>
                         <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>Date of Birth</label>
                            <input type="date" class="form-control" name="bhw_dob">
                          </div>
                        </div>
                    </div>
                    <div class="card-footer text-left">
                      <button name="bookAppointmentBtn" class="btn btn-primary">Submit</button>
                       <a href="home_schedules.php" class="btn btn-danger">Cancel</a>
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