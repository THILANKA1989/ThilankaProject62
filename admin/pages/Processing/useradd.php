<?php

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$fname = $_POST['fname'];
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
	$lname = $_POST['lname'];
	$nic = $_POST['nic'];
	$mobile = $_POST['mobile'];
	$address = $_POST['address'];

	$set_success = array($username,$fname,$email,$pwd,$lname,$nic,$mobile);
}else{
	$username = "";
	$fname =  ""; "";
	$email = "";
	$pwd = "";
	$lname = "";
	$nic = "";
	$mobile = "";
}

require_once '../../../core/database/connect.php'; 
 $errors = array();
 $data = array();

$userq = "SELECT username FROM user WHERE username='$username'";
$user_s = mysqli_query($connection,$userq);
$numrows = mysqli_num_rows($user_s);
$niclength = strlen($nic);
$nic_v = substr($nic,9);
$mobilelength = strlen($mobile);

$set_num = array($niclength,$nic_v,$mobilelength);
$dt = date("Y-m-d");
$pwd =md5($pwd);


if( $username == "" || $fname == "" || $email == "" || $pwd == "" || $lname == "" || $nic == "" || $mobile == ""){
	switch($set_success){
		case $set_success[0] == "": $errors['username'] = 'Username is Required'.'<br/>';
		
		case $set_success[1] == "": $errors['fname'] = 'Firstname is required'.'<br/>';
		
		case $set_success[2] == "": $errors['email'] = 'Email is required'.'<br/>';
		
		case $set_success[3] == "": $errors['pwd'] = 'Password is required'.'<br/>';
	
		case $set_success[4] == "": $errors['lname'] = 'Lastname is required'.'<br/>';
	
		case $set_success[5] == "": $errors['nic'] = 'National ID number is required'.'<br/>';
		
		case $set_success[6] == "": $errors['mobile'] = 'Mobile number is required'.'<br/>';
		break;
	}

	$data['success'] = false;
    $data['errors']  = $errors;

}else if($numrows>0){
	$data['success'] = false;
    $data['errors']  = 'That user exist already';
}else if($niclength != 10 || $nic_v != 'V' || $mobilelength != 10){

	switch($set_num){
		case $set_num[0] != 10: $errors['nic'] = 'Insert a Valid national ID with 10 total length'.'<br/>';
		
		case $set_num[1] != 'V': $errors['nic'] = 'insert a Valid National ID with V'.'<br/>';
		
		case $set_num[2] != 10: $errors['mobile'] = 'Mobile Number must have 10 numbers'.'<br/>';
		break;
	}

	$data['success'] = false;
    $data['errors']  = $errors;
}else{
	$user_query = "INSERT INTO user (id,username,nationalid,firstname,lastname,address,mobile,email,password,date_added)
	VALUES(NULL,'$username','$nic','$fname','$lname','$address','$mobile','$email','$pwd','$dt')";
	if ($connection->query($user_query) === TRUE) {
		$data['success'] = true;
 		$user_get = mysqli_insert_id($connection);
 		$insert_pic = "INSERT INTO picture (id,user_id,profilepic) VALUES (NULL,'$user_get','assets/images/default.jpg')";
 		if ($connection->query($insert_pic) === TRUE) {
			$data['success'] = true;
	 		$data['message'] = "New record created successfully and Default profile picture added";
	 	}else{
	 		$data['success'] = false;
	   		$data['errors']  = "Failed to add default profile picture";
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