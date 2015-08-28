<?php
if(isset($_POST['submit'])){
	$npost = $_POST['npost'];
}else{
	$npost = "";
}

require_once '../../../core/database/connect.php'; 
$postlen = strlen($npost);

$errors = array();
$data = array();
$dt = time();
 $mysql_date = strftime("%Y-%m-%d %H:%M:%S", $dt);

$admin_id = mysqli_query($connection,"SELECT id FROM admin WHERE username = 'admin'");
$id_admin = mysqli_fetch_assoc($admin_id);
if($npost == "" || $postlen>150){
	$data['success'] = false;
    $data['errors']  = "Characters must be between 1 to 150";
}else{
	$notice = "INSERT INTO notice(id,admin_id,noticetext,date_posted) VALUES(NULL,'$id_admin[id]','$npost','$mysql_date')";
	if($connection->query($notice)===TRUE){
		$data['success'] = true;
    	$data['message']  = "Notice added Successfully";
	}else{
		$errors = $connection->error;
	    $data['success'] = false;
	    $data['errors']  = $errors;
	}
}
echo json_encode($data);


?>