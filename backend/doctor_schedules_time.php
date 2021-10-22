<?php 


if(isset($_POST['addDoctorSchedTimeSubmit'])) {
	addDoctorSched();
}


function addDoctorSched() {
	
	$get_test_time = $_POST['test_time'];

	var_dump($get_test_time);

}






?>