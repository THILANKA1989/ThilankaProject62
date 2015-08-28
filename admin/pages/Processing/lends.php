<?php

if(isset($_POST['submit'])){
	$userid= $_POST['userid'];
	$copyid = $_POST['copyid'];

	$set_success = array($userid,$copyid);
}else{
    $userid="";
    $copyid ="";
}


require_once '../../../core/database/connect.php';
$errors = array();
$data = array();
 $dt = time();
 $mysql_date = strftime("%Y-%m-%d %H:%M:%S", $dt);

$datenow = new DateTime();
$datenow -> modify('+2 week');
$dated = $datenow->format('Y-m-d');

$date = new DateTime();
$dateb = $date->format('Y-m-d');


$checkopen = mysqli_query($connection,"SELECT user_id FROM user_lends_copies WHERE user_id='$userid' AND status='open'");
$numrowcheck = mysqli_num_rows($checkopen);

$checkcpy = mysqli_query($connection, "SELECT user_id FROM user_lends_copies WHERE copy_id='$copyid' AND status='open'");
$numrowcp = mysqli_num_rows($checkcpy);

$queryuid = mysqli_query($connection,"SELECT * FROM user WHERE id='$userid'");
$numrows = mysqli_num_rows($queryuid);

$querycp = mysqli_query($connection,"SELECT * FROM copies WHERE id='$copyid'");
$numrowscopies = mysqli_num_rows($querycp);

if($userid == "" || $copyid == ""){
	switch($set_success){
		case $set_success[0] == "": $errors['userid'] = 'UserID is Required';

		case $set_access[1] == "": $errors['copyid'] = 'CopyID is Required';
		break;
	}

	$data['success'] = false;
    $data['errors']  = $errors;
}else if($numrows == 0){
		$data['success'] = false;
    	$data['errors']  = "Wrong userID";
}else if($numrowscopies == 0){
		$data['success'] = false;
    	$data['errors']  = "Wrong CopyID";
}else if($numrowcheck>1){
		$data['success'] = false;
    	$data['errors']  = "That user has borrowed maximum number of books. New record cannot be added";
}else if($numrowcp>0){
		$data['success'] = false;
		$data['errors']  = "That copy not exist in the library. Check carefull";
}else{
	$enterdeal = "INSERT INTO user_lends_copies(id,user_id,copy_id,date_lend,due_date,status) VALUES (NULL,'$userid','$copyid','$dateb','$dated','open')";
	if($connection->query($enterdeal) === TRUE){
		  $data['success'] = true;
		  $data['message'] = "New record created successfully";
	}else{
		$errors = $connection->error;
				    	$data['success'] = false;
				    	$data['errors']  = $errors;
					}
					$connection->close();

}

echo json_encode($data);
?>
