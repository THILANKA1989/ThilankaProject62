<?php
if(isset($_POST['submit'])){
	$category = $_POST['category'];
}else{
	$category = "";
}
 require_once '../../../core/database/connect.php'; 
$ispub = mysqli_query($connection,"SELECT * FROM category WHERE name='$category'");
$rowsnum = mysqli_num_rows($ispub);
$errors = array();
$data = array();
if($category == ""){
	$data['success'] = false;
    $data['errors']  = "Please enter category name";
}else if($rowsnum > 0){
	$data['success'] = false;
    $data['errors']  = "This category already exist";
}else{
	$addpub = "INSERT INTO category(id,name) VALUES (NULL,'$category')";
	if($connection->query($addpub) === TRUE){
			$data['success'] = True;
    		$data['Message']  = "New category added";
		}else{
			$errors = $connection->error;
			$data['success'] = false;
			$data['errors']  = $errors;
		}
}
	echo json_encode($data);
?>