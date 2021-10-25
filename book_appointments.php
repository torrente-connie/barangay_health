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


            $appointment_docid = $_GET['adid'];

            $sql = "SELECT * FROM user WHERE user_id = '$appointment_docid' ";
            $result = mysqli_query($connection,$sql);

            while($row = mysqli_fetch_assoc($result)) {
              $account_id = $row['user_account_id'];
              $account_type = $row['user_type'];

               // user full name
               $firstname    = ucfirst($row['user_firstname']);
               $middlename   = ucfirst($row['user_middlename']);
               $lastname     = ucfirst($row['user_lastname']);

               $fullname = $firstname.' '.$middlename[0].'.'.' '.$lastname;

               if($row['user_image'] == "") {
                $doctor_image = "img/avatar/avatar-1.png";
              } else {
                $doctor_image = $row['user_image'];
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
                    <img alt="image" src="assets/<?php echo $doctor_image ?>" class=" profile-widget-picture mt-1 mr-2" style="width:100px;height:100px;">
                    <div class="profile-widget-items">
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-value mb-2">Dr. <?php echo $fullname ?></div>
                        <div class="profile-widget-item-label">General Physician</div>
                      </div>
                    </div>
                  </div>
                  <div class="profile-widget-description">
                    <div class="profile-widget-name">Doctor Schedule</div>
                      <ul class="list-group list-group-flush">
                    <?php 

                    $sqlSched = "SELECT * FROM doctor_schedule WHERE doctor_id = '$appointment_docid' ORDER BY schedule_day ";
                    $result1 = mysqli_query($connection,$sqlSched);

                    $arrDays = array();
                    while($row2 = mysqli_fetch_assoc($result1)) {

                    // doctor schedules
                    $day = $row2['schedule_day'];
                    $start_time = $row2['schedule_start_time'];
                    $end_time = $row2['schedule_end_time'];

                    $convert_day = (int)$day;
                    array_push($arrDays,$convert_day);
                  
                    // time format

                    $format_start = date("h:i:A", strtotime($start_time));
                    $format_end   = date("h:i:A", strtotime($end_time));

                    if($day == 0) {
                      $display_day = "Sunday";
                    } else if($day == 1) {
                      $display_day = "Monday";
                    } else if($day == 2) {
                      $display_day = "Tuesday";
                    } else if($day == 3) {
                      $display_day = "Wednesday";
                    } else if($day == 4) {
                      $display_day = "Thursday";
                    } else if($day == 5) {
                      $display_day = "Friday";
                    } else if($day == 6) {
                      $display_day = "Saturday";
                    } 
        
                
                   ?> 


                    <li class="list-group-item"><?php echo $display_day ?> - <?php echo $format_start ?> to <?php echo $format_end?></li>
                   <?php } ?>

                

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
            <form action="backend/bookappointment.php" method="POST">
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
                            <input type="email" class="form-control" placeholder="Enter Email Address" name="patient_email">
                          </div>
                           <div class="form-group col-md-6 col-12">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" placeholder="Enter Phone Number" name="patient_phonenumber">
                          </div>
                        </div>
                         <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>Selected Date</label>
                            <input type="text" id="datepicker" class="form-control" placeholder="MM/DD/YYYY" name="selected_date">
                          </div>

                          <div class="form-group col-md-6 col-12">
                            <label>Selected Appointment Schedule</label>
                             <select class="form-control" name="selected_asched" id="selected_asched" required>
                             </select>
                          </div>
                        </div>
                         <div class="row">
                          <div class="form-group col-md-6 col-12">
                             <label>Select An Appointment Type</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="book_appointment" id="exampleRadios1" value="bookappointment" checked="">
                              <label class="form-check-label" for="exampleRadios1">
                                Book Appointment
                              </label>
                            </div>
                             <div class="form-check">
                              <input class="form-check-input" type="radio" name="book_appointment" value="onlineappointment" id="exampleRadios2" >
                              <label class="form-check-label" for="exampleRadios2">
                                Online Appointment
                              </label>
                            </div>
                          </div>
                        </div>

                      
                    </div>
                    <div class="card-footer text-left">
                      <button name="bookAppointmentSubmit" class="btn btn-primary">Submit</button>
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

      <footer class="main-footer" style="background-color:rgba(40, 102, 199, 0.97)">
        <div class="container">
        <div class="footer-left text-white">
          © 2021 BRGYHEALTH: Barangay Health Center Appointment, Scheduling and Online Consultation System
        </div> 
      </div>
      </footer>

  </div>

   <!-- Menu for Footer Links -->
    <?php require("scripts_footer.php"); ?>
    <!-- -->


  </body>
</html>

<script>  

//var disabledHolidayDays = ["2021-11-02","2021-11-09"];
var showDays = $.parseJSON('<?php echo json_encode($arrDays); ?>');

 function filterDays(date) {
    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
    return [showDays.indexOf(date.getDay()) > -1 ];
 }

 //  function filterDays(date) {
 //    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
 //    return [showDays.indexOf(date.getDay()) > -1 && disabledHolidayDays.indexOf(string) == -1 ];
 // }

var dateToday = new Date();
var weekday=new Array(7);
    weekday[1]=1;
    weekday[2]=2;
    weekday[3]=3;
    weekday[4]=4;
    weekday[5]=5;
    weekday[6]=6;
    weekday[7]=0;

   
  $("#datepicker").datepicker({
   minDate: dateToday,
   onSelect: function(dateText, inst) {
                var date = $(this).datepicker('getDate'),
                    day  = date.getDate(),
                    month = date.getMonth() + 1,
                    year =  date.getFullYear();
                var dayOfWeek = weekday[date.getUTCDay()+1];
                var appointmentID = <?php echo $appointment_docid ?>;
                //var 
                  //       $("#day").val(dayOfWeek);
                  //       $("#month").val(month); 
                  
                       $.ajax({
                      url: "book_selectappointmenttime.php",
                      type: "POST",
                      data: {
                         dayOfWeek: dayOfWeek,
                         appointmentID: appointmentID
                      },
                      success:function(data){
                        $("#selected_asched").html(data);
                      }, 
                      error:function(){
                        alert("fail")
                      }
                      }); 
                   },
  beforeShowDay: filterDays,
  });



 
</script>

<!-- sources: https://stackoverflow.com/questions/46317356/onselectiong-date-in-jquery-datepicker-i-need-to-get-day-and-month-in-form-text, https://stackoverflow.com/questions/53395634/how-to-disable-certain-days-of-the-week-on-a-jquery-datepicker-based-on-a-result -->