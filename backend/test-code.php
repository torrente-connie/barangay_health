<?php

require("dbconn.php");

if(isset($_POST['addStudentSubmit'])) {
	insertStudent();
}

function insertStudent() {
	$conn = dbConn();
	$stud_fname = $_POST['student_firstname'];
	$stud_lname = $_POST['student_lastname'];
	$stud_mname = $_POST['student_middlename'];
	$contact = $_POST['student_contactnumber'];
	
	// get unique id number 
	$getUniqueSql = "SELECT COUNT(*) FROM student
	";
	$getUniqueResult = mysqli_query($conn,$getUniqueSql);
	$displayUnique = mysqli_fetch_array($getUniqueResult);
	$getUniqueYear = date("Y");
	$username = 'SJCS'.''.$getUniqueYear.''.$displayUnique[0];
	$pass = md5($username);

    $sql = "INSERT INTO student (student_id,student_accountnumber,student_username,student_password,student_first_name,student_middle_name,student_last_name,student_contactnumber) VALUES
	(NULL,'$username','$username','$pass','$stud_fname','$stud_mname','$stud_lname','$contact')";

	 $result = mysqli_query($conn,$sql);

	if($result){
		$str="Added Student Information";
		header("Location:../views/admin/student.php?s=".$str);
		}else{
				$str="Error Adding Student";
				header("Location:../views/admin/student.php?f=".$str);
		}
 }

// soft delete for subject data
if(isset($_POST['updateStudentSubmit'])){
  studentUpdate();
}

function studentUpdate(){
  $conn = dbConn();
	$studentId 			= $_POST['student_id'];
	$firstname 			= $_POST['student_firstname'];
	$lastname 			= $_POST['student_lastname'];
	$middlename 		= $_POST['student_middlename'];
	$contact 			= $_POST['student_contactnumber'];
	
	$sql = "UPDATE `student` SET `student_first_name` = '$firstname' , `student_middle_name` = '$middlename', `student_last_name` = '$lastname' , `student_contactnumber` = '$contact' WHERE `student_id`= '$studentId' ";

  $result = mysqli_query($conn, $sql);

	if($result){
		$str="Updated Student Information";
		header("Location:../views/admin/student.php?s=".$str);
		}else{
		header("Location:../views/admin/student.php?f=".$str);
		}
}


?>