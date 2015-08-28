<?php
if(isset($_POST['submit'])){
	$forum = $_POST['forum'];
}else{
	$forum = "";
}

$errors         = array();      // array to hold validation errors
$data           = array(); 
include '../core/init.php';
if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
}
$query = "SELECT id FROM user WHERE username = '$username'";
$qpost = mysqli_query($connection,$query);
$post_user = mysqli_fetch_assoc($qpost);
$forum_size = strlen($forum);
$dt = time();
$datetime = strftime("%Y-%m-%d %H:%M:%S", $dt);
$enteruser = $post_user['id'];
if($forum == "" || strlen($forum) < 10){
	 $data['success'] = false;
     $data['errors'] = 'Nee more than 10 characters';
}else if($forum_size>300){
	 $data['success'] = false;
     $data['errors'] = 'Nee less than 300 characters';
}else{
	$Query = "INSERT INTO posts(id,user_id,post,date_added) VALUES(NULL,{$enteruser},'{$forum}','{$datetime}')";
	if ($connection->query($Query) === TRUE) {
		 $data['success'] = true;
        $data['message'] = 'New Post Added';
	}else{
		$errors = $connection->error;
		echo $errors;
	}
			$connection->close();

}
    echo json_encode($data);
?>