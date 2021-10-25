<?php 


if(isset($_POST['dayOfWeek'])) {
  $appointment_docid = $_POST['test'];
  $test = $_POST['dayOfWeek'];

  $connection = mysqli_connect("localhost","root","","barangayhealth_db");
  $sqlSched = "SELECT * FROM doctor_schedule WHERE doctor_id = '$appointment_docid' AND schedule_day = '$test' ORDER BY schedule_day ";
  $result1 = mysqli_query($connection,$sqlSched);

  $output = '';
                            
  while($row2 = mysqli_fetch_assoc($result1)) {

  $schedule_id = $row2['schedule_id'];

  // doctor schedules
  $day = $row2['schedule_day'];
  $start_time = $row2['schedule_start_time'];
  $end_time = $row2['schedule_end_time'];

  // time format

  $format_start = date("h:i:A", strtotime($start_time));
  $format_end   = date("h:i:A", strtotime($end_time));


  echo "<option value=".$schedule_id.">".$format_start." to ".$format_end." </option>" ;

  $data = array(
		'option' => $output
	 );


  echo json_encode($data);

	}

}

?>