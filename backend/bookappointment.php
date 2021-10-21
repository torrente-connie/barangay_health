<?php

require("dbconn.php");


// code for add new doctor

if(isset($_POST['bookAppointmentSubmit'])) {
	bookAppointment();
}

function bookAppointment() {
	$conn = dbConn();
	
	$patient_firstname 			= $_POST['patient_firstname'];
	$patient_middlename 		= $_POST['patient_middlename'];
	$patient_lastname 			= $_POST['patient_lastname'];
	$patient_email				= $_POST['patient_email']; 
	$patient_phonenumber		= $_POST['patient_phonenumber'];
	$date_selected 				= $_POST['selected_date'];
	$appointmentsched_selected	= $_POST['selected_asched'];
	$bookappointment 			= $_POST['book_appointment'];


	$sql = "INSERT INTO appointment ()"


	// if($result){
	// 	 $alert="Added New Barangay Health Worker";
	// 		header("Location:../views/admin/accounts_bhw.php?s=".$alert);
	// 	}else{
	// 	 $alert="Error Cannot Add This Doctor";
	// 		header("Location:../views/admin/accounts_bhw.php?f=".$alert);
	// 	}
 }



?>