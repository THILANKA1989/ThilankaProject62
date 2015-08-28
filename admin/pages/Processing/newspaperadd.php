<?php
if(isset($_POST['submit'])){
	$name= $_POST['name'];
	$type= $_POST['typenp'];
	$date= $_POST['date'];

	$set_success = array($name,$type,$date);
}else{
	$name="";
	$type="";
	$date="";
}
	

require_once '../../../core/database/connect.php'; 
include '../../functions/dateformatting.php';
$errors = array();
$data = array();
$sisbn = "SELECT id from newspaper WHERE name = '$name'";
$sisbn_num = mysqli_query($connection,$sisbn);
$cpid = mysqli_fetch_assoc($sisbn_num);
$rows_np = mysqli_num_rows($sisbn_num);
$dt = time();
$mysql_date = strftime("%Y-%m-%d", $dt);
echo $mysql_date;
$datemy = strip_zeros($date);
$chnp = mysqli_query($connection,"SELECT id from newspaper_adds WHERE date_pub = '$datemy'");
$numrows = mysqli_num_rows($chnp);

strip_zeros($date);
if($name == "Add newspaper" || $type == ""|| $date = "" ){
	switch($set_success){
		case $set_success[0] == "": $errors['name'] = 'Title is Required';
	
		case $set_success[1] == "": $errors['type'] = 'Select a Type';

		case $set_success[1] == "": $errors['date'] = 'Enter date of Newspaper';
		break;
	}

	$data['success'] = false;
    $data['errors']  = $errors;
}else if($numrows > 0){
	$data['success'] = false;
    $data['errors']  = "This newspaper has Entered allready";
}else{
	$querynp = "INSERT INTO newspaper_adds(id,newspaper_id,type,date_pub) VALUES(NULL,'$cpid[id]','$type','$datemy')";
	if($connection -> query($querynp)){
		$data['success'] = true;
    	$data['message']  = "Record Created Successfully";
	}else{
		$errors = $connection->error;
		$data['success'] = false;
		$data['errors']  = $errors;
	}
	$connection->close();

	echo json_encode($data);
}
?>