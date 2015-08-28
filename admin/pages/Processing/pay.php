<?php
if(isset($_POST['submit'])){
	$userid = $_POST['userid'];
	$payment = $_POST['paid'];

	$set_success = array($userid,$payment);
}else{
	$userid = "";
	$payment = "";
}
require_once '../../../core/database/connect.php'; 
$errors = array();
$data = array();
$dt = time();
$mysql_date = strftime("%Y-%m-%d", $dt);
$dated = mysqli_query($connection,"SELECT penalty FROM user WHERE id='$userid'");
$duedate=mysqli_fetch_assoc($dated);
$rowsnp = mysqli_num_rows($dated);

if($userid == "" || $payment == ""){
	switch($set_success){
		case $set_success[0] == "": $errors['userid'] = 'Userid is Required';
	
		case $set_access[1] == "": $errors['paid'] = 'Paid Amount required';
		break;
	}

	$data['success'] = false;
    $data['errors']  = $errors;
}else if($rowsnp == 0){
	$data['success'] = false;
    $data['errors']  = 'That User Not Exist';
}else{
	$query = "INSERT INTO payments(id,penalty,user_id,date) VALUES (NULL,'$payment','$userid','$mysql_date')";
	if($connection->query($query)){
		$payment = (int)$payment;
		$selectcurr = mysqli_query($connection,"SELECT penalty from user WHERE id = '$userid' ");
		$currvalue = mysqli_fetch_assoc($selectcurr);
		$incurr = (int)$currvalue['penalty'];
		$paymentnow = $incurr - $payment;
			if($paymentnow<0){
				$updatepayment = "UPDATE user SET penalty = '0' WHERE id='$userid'";
			}else{
				$updatepayment = "UPDATE user SET penalty = '$paymentnow' WHERE id='$userid'";
			}
		if($connection->query($updatepayment )){
			$data['success'] = true;
			$data['message'] = "Your record updated with penalty of ".$paymentnow.".00Rs";
		}else{
			$errors = $connection->error;
			$data['success'] = false;
			$data['errors']  = $errors;
		}
	}else{
		$errors = $connection->error;
		$data['success'] = false;
		$data['errors']  = $errors;
	}
}

echo json_encode($data);
?>