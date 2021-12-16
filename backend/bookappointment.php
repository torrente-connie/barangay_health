<?php

require("dbconn.php");


// code for add new doctor

if(isset($_POST['bookAppointmentSubmit'])) {
	
	$appointment_type = $_POST['book_appointment'];

	if($appointment_type == 'bookappointment') {
		bookAppointment();
	} else if($appointment_type == 'onlineappointment') {
		onlineConsultation();
	} else if($appointment_type == 'walkinappointment') {
		walkInConsultation();
	}
}

function bookAppointment() {
	$conn = dbConn();
	
	$get_doctor_id				= $_POST['selected_doctor_id'];
	$patient_user_id 			= $_POST['patient_user_id']; // who made the booking
	$patient_firstname 			= $_POST['patient_firstname']; // info of patient
	$patient_middlename 		= $_POST['patient_middlename']; 
	$patient_lastname 			= $_POST['patient_lastname'];
	$patient_email				= $_POST['patient_email']; 
	$patient_phonenumber		= $_POST['patient_phonenumber'];
	$date_selected 				= $_POST['selected_date'];
	$appointmentsched_selected	= $_POST['selected_asched'];
	$healthservices 			= $_POST['selected_service'];
	$bookappointment 			= $_POST['book_appointment'];

	$appointment_status			= 1;
	$appointment_reason			= "";
	$appointment_bool			= 1;

	$old_date = explode('/', $date_selected); 
	$new_data = $old_date[2].'-'.$old_date[0].'-'.$old_date[1];

	// appointment code;
	$appointment_code 			= "";
    $appointment_code_status    = 0;

	$sql = "INSERT INTO appointment (appointment_id,appointment_doctor_id,appointment_patient_id,appointment_patient_fname,appointment_patient_mname,appointment_patient_lname,appointment_patient_email,appointment_patient_pnum,appointment_selected_date,appointment_selected_time,appointment_selected_service,appointment_type,appointment_status,appointment_reason,appointment_code,appointment_code_status,appointment_bool) VALUES (NULL,'$get_doctor_id','$patient_user_id','$patient_firstname','$patient_middlename','$patient_lastname','$patient_email','$patient_phonenumber','$new_data','$appointmentsched_selected','$healthservices','$bookappointment','$appointment_status','$appointment_reason','$appointment_code','$appointment_code_status','$appointment_bool')";
	$result = mysqli_query($conn,$sql);


	// notification message

	$notif_pname = $patient_firstname.' '.$patient_middlename.'. '.$patient_lastname;
	$notif_pdate = $new_data;

	$notif_message = "Patient ".$notif_pname." Has Successfully Booked Face to Face Appointment On" .$notif_pdate;

	$notif_admin = 0;
	$notif_patient = $patient_user_id;
	$notif_doctor = $get_doctor_id;
	$notif_bhw = 0;

	$notif_status = 0;
	$notif_usertype = 'bhw';
	// current date time
	date_default_timezone_set('Asia/Manila');
    $notif_datetime = date('Y/m/d H:i:s');

	$insertNotification = "INSERT INTO notification (`notification_id`,`notification_admin_id`,`notification_patient_id`,`notification_doctor_id`,`notification_bhw_id`,`notification_message`,`notification_status`,`notification_usertype`,`notification_datetime`) VALUES (NULL,'$notif_admin','$notif_patient','$notif_doctor','$notif_bhw','$notif_message','$notif_status','$notif_usertype','$notif_datetime')";
	$resultNotification = mysqli_query($conn,$insertNotification);

	if($result AND $resultNotification){
		 $alert="Successfully Booked A Face to Face Appointment";
		 sendEmailNotification($patient_user_id,$get_doctor_id);
			header("Location:../home_schedules.php?s=".$alert);
		}else{
		 $alert="Error";
          //var_dump($conn);
          //var_dump($sql);
         header("Location:../home_schedules.php?f=".$alert);
		}
 }

 function onlineConsultation() {

 	$conn = dbConn();
	
	$get_doctor_id				= $_POST['selected_doctor_id'];
	$patient_user_id 			= $_POST['patient_user_id']; // who made the booking
	$patient_firstname 			= $_POST['patient_firstname']; // info of patient
	$patient_middlename 		= $_POST['patient_middlename']; 
	$patient_lastname 			= $_POST['patient_lastname'];
	$patient_email				= $_POST['patient_email']; 
	$patient_phonenumber		= $_POST['patient_phonenumber'];
	$date_selected 				= $_POST['selected_date'];
	$appointmentsched_selected	= $_POST['selected_asched'];
	$healthservices 			= "Virtual Consultation";
	$onlineconsultation 		= $_POST['book_appointment'];

	$appointment_status			= 1;
	$appointment_reason			= "";
	$appointment_bool			= 1;

	$old_date = explode('/', $date_selected); 
	$new_data = $old_date[2].'-'.$old_date[0].'-'.$old_date[1];

    	// appointment code;
	$appointment_code 			= "";
    $appointment_code_status    = 0;

	$sql = "INSERT INTO appointment (appointment_id,appointment_doctor_id,appointment_patient_id,appointment_patient_fname,appointment_patient_mname,appointment_patient_lname,appointment_patient_email,appointment_patient_pnum,appointment_selected_date,appointment_selected_time,appointment_selected_service,appointment_type,appointment_status,appointment_reason,appointment_code,appointment_code_status,appointment_bool) VALUES (NULL,'$get_doctor_id','$patient_user_id','$patient_firstname','$patient_middlename','$patient_lastname','$patient_email','$patient_phonenumber','$new_data','$appointmentsched_selected','$healthservices','$onlineconsultation','$appointment_status','$appointment_reason','$appointment_code','$appointment_code_status','$appointment_bool')";
	$result = mysqli_query($conn,$sql);

	// notification message

	$notif_pname = $patient_firstname.' '.$patient_middlename.'. '.$patient_lastname;
	$notif_pdate = $new_data;

	$notif_message = "Patient ".$notif_pname." Has Successfully Booked Virtual Consultation On  "  .$notif_pdate;

	$notif_admin = 0;
	$notif_patient = $patient_user_id;
	$notif_doctor = $get_doctor_id;
	$notif_bhw = 0;

	$notif_status = 0;
	$notif_usertype = 'bhw';
	// current date time
	date_default_timezone_set('Asia/Manila');
    $notif_datetime = date('Y/m/d H:i:s');

	$insertNotification = "INSERT INTO notification (`notification_id`,`notification_admin_id`,`notification_patient_id`,`notification_doctor_id`,`notification_bhw_id`,`notification_message`,`notification_status`,`notification_usertype`,`notification_datetime`) VALUES (NULL,'$notif_admin','$notif_patient','$notif_doctor','$notif_bhw','$notif_message','$notif_status','$notif_usertype','$notif_datetime')";
	$resultNotification = mysqli_query($conn,$insertNotification);


	if($result AND $resultNotification) {
		 $alert="Successfully Booked A Virtual Consultation Appointment";
			header("Location:../home_schedules.php?s=".$alert);
		}else{
		 $alert="Error";
         header("Location:../home_schedules.php?f=".$alert);
		}
	}

function walkInConsultation() {
	$conn = dbConn();
	
	$patient_account_id 		= $_POST['patient_account_id'];


	if(empty($patient_account_id)) {
		$patient_user_id = 0;
	} else {
		$accountID = $patient_account_id;
		$sqlAccountId = "SELECT * FROM user WHERE user_account_id = '$accountID' AND user_type = 'Patient' ";
		$resultAccountId = mysqli_query($conn,$sqlAccountId);
		$rowAccountId = mysqli_fetch_assoc($resultAccountId);

		if(mysqli_num_rows($resultAccountId) > 0) {
			$patient_user_id = $rowAccountId['user_id'];
		} else {
			$alert="Only Add Patient Account";
       		header("Location:../home_schedules.php?f=".$alert);
		}	
		
	}

	$get_doctor_id				= $_POST['selected_doctor_id'];
	$patient_firstname 			= $_POST['patient_firstname']; // info of patient
	$patient_middlename 		= $_POST['patient_middlename']; 
	$patient_lastname 			= $_POST['patient_lastname'];
	$patient_email				= $_POST['patient_email']; 
	$patient_phonenumber		= $_POST['patient_phonenumber'];
	$date_selected 				= $_POST['selected_date'];
	$appointmentsched_selected	= $_POST['selected_asched'];
	$healthservices 			= $_POST['selected_service'];
	$bookappointment 			= $_POST['book_appointment'];

	$appointment_status			= 1;
	$appointment_reason			= "";
	$appointment_bool			= 1;

	$old_date = explode('/', $date_selected); 
	$new_data = $old_date[2].'-'.$old_date[0].'-'.$old_date[1];

	// appointment code;
	$appointment_code 			= "";
    $appointment_code_status    = 0;

	$sql = "INSERT INTO appointment (appointment_id,appointment_doctor_id,appointment_patient_id,appointment_patient_fname,appointment_patient_mname,appointment_patient_lname,appointment_patient_email,appointment_patient_pnum,appointment_selected_date,appointment_selected_time,appointment_selected_service,appointment_type,appointment_status,appointment_reason,appointment_code,appointment_code_status,appointment_bool) VALUES (NULL,'$get_doctor_id','$patient_user_id','$patient_firstname','$patient_middlename','$patient_lastname','$patient_email','$patient_phonenumber','$new_data','$appointmentsched_selected','$healthservices','$bookappointment','$appointment_status','$appointment_reason','$appointment_code','$appointment_code_status','$appointment_bool')";
	$result = mysqli_query($conn,$sql);

	// notification message

	$notif_pname = $patient_firstname.' '.$patient_middlename.'. '.$patient_lastname;
	$notif_pdate = $new_data;

	$notif_message = "Patient ".$notif_pname." Has Successfully Booked Walk-In Appointment On  "  .$notif_pdate;

	$notif_admin = 0;
	$notif_patient = $patient_user_id;
	$notif_doctor = $get_doctor_id;
	$notif_bhw = 0;

	$notif_status = 0;
	$notif_usertype = 'bhw';
	// current date time
	date_default_timezone_set('Asia/Manila');
    $notif_datetime = date('Y/m/d H:i:s');

	$insertNotification = "INSERT INTO notification (`notification_id`,`notification_admin_id`,`notification_patient_id`,`notification_doctor_id`,`notification_bhw_id`,`notification_message`,`notification_status`,`notification_usertype`,`notification_datetime`) VALUES (NULL,'$notif_admin','$notif_patient','$notif_doctor','$notif_bhw','$notif_message','$notif_status','$notif_usertype','$notif_datetime')";
	$resultNotification = mysqli_query($conn,$insertNotification);


	if($result AND $resultNotification) {
		 $alert="Successfully Booked An Appointment";
			header("Location:../home_schedules.php?s=".$alert);
		}else{
		 $alert="Error";
        //  var_dump($conn);
        //  var_dump($sql);
        	header("Location:../home_schedules.php?f=".$alert);
		}
 	}

function sendEmailNotification($patientId,$doctorId) {

	   require '../assets/mailer/PHPMailerAutoload.php';
       require '../assets/mailer/credential.php';

       // $email = "louisadolfo08@gmail.com";
       $email = "cc112.torrente@gmail­.com";

	        // Instantiation and passing `true` enables exceptions
	    $mail = new PHPMailer;

	    $mail->SMTPDebug = 1;

	    // new
	    $mail->Mailer = "smtp";
	    $mail->SMTPOptions = array(
	    'ssl' => array(
	        'verify_peer' => false,
	        'verify_peer_name' => false,
	        'allow_self_signed' => true
	    )
	    );
	                                                          // Send using SMTP
	    $mail->IsSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = EMAIL;                              // SMTP username
	    $mail->Password = PASS;                               // SMTP password
	    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	    //$mail->Port = 587 / 465 / 25;  
	    $mail->Port = 587;   
	                                              // TCP port to connect to

	    //Recipients
	    $mail->setFrom(EMAIL, 'EMAIL NOTIFICATION BRGYHEALTH: Barangay Health Center Appointment, Scheduling and Online Consultation System');
	    $mail->addAddress($email);     // Add a recipient
	    $mail->addReplyTo(EMAIL);
	 
	    // Content
	    $mail->isHTML(true);   
	    // Set email format to HTML

	   // if($_GET['studentID'] == '$id') {
	   //   $url = "http://" . $_SERVER['HTTP_POST'] . "localhost/mca_new_db/reset_password.php?email=$email&SID=$id";
	   //  }

	   // if($_GET['teacherID'] == '$id') {
	   //    $url = "http://" . $_SERVER['HTTP_POST'] . "localhost/mca_new_db/reset_password.php?email=$email&TID=$id";
	   // }

	    date_default_timezone_set('Asia/Manila');
 	    $get_date = date('Y/m/d');

	    $mail->Subject = 'You Have Successfully Book An Appointment For Face to Face Appointment';
	    $mail->Body    = "Your Appointment Schedule:". $get_date.".Please Dont Forgot to Wear Face Mask and Face Shield and Also Always Follow Health Protocol";
	 
	    if(!$mail->send()) {
	            echo 'Message could not be sent.';
	            echo 'Mailer Error: ' . $mail->ErrorInfo;
	        } else {
	            $str = 'Reset password link has been sent to your email';
	            header("location:../home_schedules.php?success=".$str);
	        }


}


?>