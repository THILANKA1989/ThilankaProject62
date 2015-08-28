<?php
if(isset($_POST['submit'])){
	$userid= $_POST['userid'];
	$copyid = $_POST['copyid'];

	$set_success = array($userid,$copyid);
}else{
	$userid= "";
	$copyid = "";
}
require_once '../../../core/database/connect.php';
$errors = array();
$data = array();
$dt = time();
$mysql_date = strftime("%Y-%m-%d", $dt);
$dated = mysqli_query($connection,"SELECT * FROM user_lends_copies WHERE user_id = '$userid' AND status ='open' AND copy_id = '$copyid'");
$duedate=mysqli_fetch_assoc($dated);

$rowsnp = mysqli_num_rows($dated);

include '../../functions/dateformatting.php';
//Our "then" date.
$then = $duedate['due_date'];
//Convert it into a timestamp.
$then = strtotime($then);

//Get the current timestamp.
$now = time();

//Calculate the difference.
$difference = $now - $then;

//Convert seconds into days.
$days = floor($difference / (60*60*24) );
$selectpen = mysqli_query($connection,"SELECT penalty FROM user WHERE id= '$userid'");
$currpen = mysqli_fetch_assoc($selectpen);
$currentpenalty = $currpen['penalty'];
echo $currentpenalty;
$addition = (int)$days + (int)$currentpenalty;

if($userid == "" || $copyid == ""){
	switch($set_success){
		case $set_success[0] == "": $errors['userid'] = 'Userid is Required';

		case $set_access[2] == "": $errors['language'] = 'Copyid is required';
		break;
	}

	$data['success'] = false;
    $data['errors']  = $errors;
}else if($rowsnp == 0){
	$data['success'] = false;
    $data['errors']  = "UserID CopyID combination not matches";
}else{
	$updatestatus = "UPDATE user_lends_copies SET status = 'closed' WHERE user_id = '$userid'";
	if($connection->query($updatestatus) === TRUE){
		if($days>0){
			$data['success'] = true;
			$data['message'] = "You have".$days.".00 Rs"." "."of Penalty";

			$queryaddp = "UPDATE user SET penalty = '$addition' WHERE id='$userid'";
			if($connection->query($updatestatus) === TRUE){
				$data['success'] = true;
				$data['message'] = "Penalty added to the table"." ".$addition."00 Rs";
			}else{
				$errors = $connection->error;
				$data['success'] = false;
				$data['errors']  = $errors;
			}
		}else{
			$data['success'] = true;
			$data['message'] = "You have no Penalty";
		}
	}else{
		$errors = $connection->error;
		$data['success'] = false;
		$data['errors']  = $errors;
	}
	$connection->close();
}

echo json_encode($data);
?>
