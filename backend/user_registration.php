<?php

require("dbconn.php");


// add new schedules for doctor

if(isset($_POST['registerUser'])) {
	registerUser();
}


function registerUser() {
	$conn = dbConn();

	$email 			= $_POST['email'];
	$first_name 	= $_POST['first_name'];
	$middle_name 	= $_POST['middle_name'];
	$last_name 		= $_POST['last_name'];
	$password 	    = $_POST['password'];


	  // user type,status and bool 
    $user_type = 'Patient';
    $dob  = "";
    $pnum = "";
    $user_status = 1;
    $user_bool = 1;


	// get unique id number, username and password 
	$getUniqueSql = "SELECT COUNT(*) FROM user 
	WHERE user_type = 'Patient' ";
	$getUniqueResult = mysqli_query($conn,$getUniqueSql);
	$displayUnique = mysqli_fetch_array($getUniqueResult);
	$getUniqueYear = date("Y");
	$getUniqueAccNum = '080';
	$user_uname = 'BH'.''.$getUniqueYear.''.$getUniqueAccNum.''.$displayUnique[0];
	$user_pass = md5($password);

	 $sql = "INSERT INTO user (user_id,user_account_id,user_email,user_password,user_firstname,user_middlename,user_lastname,user_dob,user_cnum,user_type,user_status,user_bool) VALUES
	(NULL,'$user_uname','$email','$user_pass','$first_name','$middle_name','$last_name','$dob','$pnum','$user_type','$user_status','$user_bool')";

	$result = mysqli_query($conn,$sql);

	if($result){
		 $alert="Added New Account";
			header("Location:../login.php?s=".$alert);
		}else{
		 $alert="Error";
			header("Location:../login.php?s=".$alert);
		}

}


?>