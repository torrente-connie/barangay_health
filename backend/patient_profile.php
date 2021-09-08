<?php

require("dbconn.php");

if(isset($_POST['editPatientProfile'])) {
	editPatientProfile();
}


function editPatientProfile() {
  $conn 	= dbConn();
  $id 		= $_POST['user_id'];
  $fname 	= $_POST['firstname'];
  $mname 	= $_POST['middlename'];
  $lname 	= $_POST['lastname'];
  $email	= $_POST['email'];
  $phone	= $_POST['phone'];

  $sql = "UPDATE user SET `user_firstname` = '$fname', `user_middlename` = '$mname', `user_lastname` = '$lname', `user_cnum` = '$phone', `user_email` = '$email' WHERE `user_id` = '$id' ";
  $result = mysqli_query($conn,$sql);

  if($result){
	$alert="Added New Schedule";
		header("Location:../views/patient/show_profile.php?s=".$alert);
	  }else{
	$alert="Error";
		header("Location:../views/patient/show_profile.php?s=".$alert);
	   }


}




?>