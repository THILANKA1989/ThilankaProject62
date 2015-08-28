<?php

if(isset($_POST['submit'])){
	$loc2 = $_POST['loc2'];
	$loc1 = $_POST['loc1'];
	$set_seccess = array($loc1,$loc2);
}else{
	$loc2 = "";
	$loc1 = "";
}
 require_once '../../../core/database/connect.php'; 
$errors = array();
$data = array();


if($loc1 == "" & $loc2 == ""){
	$data['success'] = false;
    $data['errors']  = "Please enter one location atleast";
}else{
	if($loc1 != ""){
		$queryinsert = "INSERT INTO locations(id,name) VALUES (NULL,'$loc1')";
		if($connection->query($queryinsert) === TRUE){
			$data['success'] = True;
    		$data['Message']  = "New Location updated";
		}else{
			$errors = $connection->error;
			$data['success'] = false;
			$data['errors']  = $errors;
		}
	}

	if($loc2 != ""){
		$queryinsert2 = "INSERT INTO locations(id,name) VALUES (NULL,'$loc2')";
		if($connection->query($queryinsert2) === TRUE){
			$data['success'] = True;
    		$data['Message']  = "New Location updated";
		}else{
			$errors = $connection->error;
			$data['success'] = false;
			$data['errors']  = $errors;
		}
	}
	
	echo json_encode($data);
}
?>