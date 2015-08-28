<?php
if(isset($_POST['submit'])){
	$publisher = $_POST['publisher'];
}else{
	$publisher = "";
}
 require_once '../../../core/database/connect.php'; 
$ispub = mysqli_query($connection,"SELECT * FROM publishers WHERE name='$publisher'");
$rowsnum = mysqli_num_rows($ispub);
$errors = array();
$data = array();
if($publisher == ""){
	$data['success'] = false;
    $data['errors']  = "Please enter publisher name";
}else if($rowsnum > 0){
	$data['success'] = false;
    $data['errors']  = "This publisher already exist";
}else{
	$addpub = "INSERT INTO publishers(id,name) VALUES (NULL,'$publisher')";
	if($connection->query($addpub) === TRUE){
			$data['success'] = True;
    		$data['Message']  = "New publisher added";
		}else{
			$errors = $connection->error;
			$data['success'] = false;
			$data['errors']  = $errors;
		}
}
	echo json_encode($data);
?>