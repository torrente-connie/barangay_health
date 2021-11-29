<?php

require("dbconn.php");


// code for accept appointment
if(isset($_POST['approveAppointmentSubmit'])) {
	
	$connection = dbConn();
	$approveID = $_POST['approveID'];
	$reason = "";
	
	$sql = "UPDATE appointment SET `appointment_status` = '4', `appointment_reason` = '$reason' WHERE appointment_id = '$approveID' ";
	$result = mysqli_query($connection,$sql);

	if($result) {
	 	$alert="Appointment Book Approve by Doctor ";
			header("Location:../views/doctor/appointments_oc.php?s=".$alert);
		}else{
		 $alert="Error";
			header("Location:../views/doctor/appointments_oc.php?s=".$alert);
		}	
	}


// code for cancel appointment
if(isset($_POST['rescheduleAppointmentSubmit'])) {
	
	$connection = dbConn();
	$rescheduleID = $_POST['rescheduleID'];
	$reason = $_POST['reason'];

	$sql = "UPDATE appointment SET `appointment_status` = '5', `appointment_reason` = '$reason' WHERE appointment_id = '$rescheduleID' ";
	$result = mysqli_query($connection,$sql);

	if($result) {
	 	$alert="Appointment Book Cancel by Barangay Health Worker";
			header("Location:../views/doctor/appointments_oc.php?s=".$alert);
		}else{
		 $alert="Error";
			header("Location:../views/doctor/appointments_oc.php?s=".$alert);
		}	
	}


?>