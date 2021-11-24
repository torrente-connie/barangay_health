<?php

require("dbconn.php");


// code for add new doctor

if(isset($_POST['bookAppointmentSubmit'])) {
	
	$appointment_type = $_POST['book_appointment'];

	if($appointment_type == 'bookappointment') {
		bookAppointment();
	} else if($appointment_type == 'onlineappointment') {
		onlineConsultation();
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

	$sql = "INSERT INTO appointment (appointment_id,appointment_doctor_id,appointment_patient_id,appointment_patient_fname,appointment_patient_mname,appointment_patient_lname,appointment_patient_email,appointment_patient_pnum,appointment_selected_date,appointment_selected_time,appointment_selected_service,appointment_type,appointment_status,appointment_reason,appointment_bool) VALUES (NULL,'$get_doctor_id','$patient_user_id','$patient_firstname','$patient_middlename','$patient_lastname','$patient_email','$patient_phonenumber','$new_data','$appointmentsched_selected','$healthservices','$bookappointment','$appointment_status','$appointment_reason','$appointment_bool')";
	$result = mysqli_query($conn,$sql);


	if($result){
		 $alert="Successfully Booked An Appointment";
			header("Location:../home_schedules.php?s=".$alert);
		}else{
		 $alert="Error";
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
	$healthservices 			= "";
	$onlineconsultation 		= $_POST['book_appointment'];

	$appointment_status			= 1;
	$appointment_reason			= "";
	$appointment_bool			= 1;

	$old_date = explode('/', $date_selected); 
	$new_data = $old_date[2].'-'.$old_date[0].'-'.$old_date[1];

	$sql = "INSERT INTO appointment (appointment_id,appointment_doctor_id,appointment_patient_id,appointment_patient_fname,appointment_patient_mname,appointment_patient_lname,appointment_patient_email,appointment_patient_pnum,appointment_selected_date,appointment_selected_time,appointment_selected_service,appointment_type,appointment_status,appointment_reason,appointment_bool) VALUES (NULL,'$get_doctor_id','$patient_user_id','$patient_firstname','$patient_middlename','$patient_lastname','$patient_email','$patient_phonenumber','$new_data','$appointmentsched_selected','$healthservices','$onlineconsultation','$appointment_status','$appointment_reason','$appointment_bool')";
	$result = mysqli_query($conn,$sql);

	if($result){
		 $alert="Successfully Booked An Appointment";
			header("Location:../home_schedules.php?s=".$alert);
		}else{
		 $alert="Error";
			header("Location:../home_schedules.php?f=".$alert);
		}

 }



?>