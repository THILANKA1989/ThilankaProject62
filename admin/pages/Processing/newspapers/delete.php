<?php

$id = $_GET['delete'];

require_once '../../../../core/init.php';
$delbook = "DELETE FROM newspaper_adds where id='$id'";

$data=array();
$errors=array();


if($connection->query($delbook) === TRUE){
	$data['success'] = true;
    $data['errors']  = 'Record deleted Successfully';
}else{
	$errors = $connection->error;
	$data['success'] = false;
	$data['errors']  = $errors;
	$connection->close();
}
echo json_encode($data);
?>