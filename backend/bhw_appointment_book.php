<?php

require("dbconn.php");


// code for accept appointment
if(isset($_POST['acceptAppointmentSubmit'])) {
	
	$connection = dbConn();
	$acceptID = $_POST['acceptID'];
	$reason = "";
	
	$sql = "UPDATE appointment SET `appointment_status` = '3', `appointment_reason` = '$reason' WHERE appointment_id = '$acceptID' ";
	$result = mysqli_query($connection,$sql);

	if($result) {
	 	$alert="Appointment Book Accept by Barangay Health Worker";
			header("Location:../views/bhw/appointments_book.php?s=".$alert);
		}else{
		 $alert="Error";
			header("Location:../views/bhw/appointments_book.php?s=".$alert);
		}	
	}


// code for cancel appointment
if(isset($_POST['cancelAppointmentSubmit'])) {
	
	$connection = dbConn();
	$cancelID = $_POST['cancelID'];
	$reason = $_POST['reason'];

	$sql = "UPDATE appointment SET `appointment_status` = '2', `appointment_reason` = '$reason' WHERE appointment_id = '$cancelID' ";
	$result = mysqli_query($connection,$sql);

	if($result) {
	 	$alert="Appointment Book Cancel by Barangay Health Worker";
			header("Location:../views/bhw/appointments_book.php?s=".$alert);
		}else{
		 $alert="Error";
			header("Location:../views/bhw/appointments_book.php?s=".$alert);
		}	
	}


?>