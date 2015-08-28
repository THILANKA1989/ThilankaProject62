<?php
if(isset($_POST['submit'])){
	$title = $_POST['title'];
	$language = $_POST['language'];

	$set_success = array($title,$language);
}else{
	$title = "";
	$datepub = "";
	$language = "";
}
 require_once '../../../core/database/connect.php'; 
 $errors = array();
 $data = array();
 $sisbn = "SELECT * from magazines WHERE name = '$title'";
 $sisbn_num = mysqli_query($connection,$sisbn);
 $cpid = mysqli_fetch_assoc($sisbn_num);
 $rows_mag = mysqli_num_rows($sisbn_num);
 $dt = time();
 $mysql_date = strftime("%Y-%m-%d %H:%M:%S", $dt);

 // Check if image file is a actual image or fake image
 
if($title == "" || $language == "" ){
	switch($set_success){
		case $set_success[0] == "": $errors['title'] = 'Title is Required';
	
		case $set_access[2] == "": $errors['language'] = 'Select a Language';
		break;
	}

	$data['success'] = false;
    $data['errors']  = $errors;
}else if($rows_mag>0){
	$data['success'] = false;
    $data['errors']  = "This magazine already exsist, Go to"."#/dashboard";
}else{

	$target_dir = "../../../assets/covers/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    	if(file_exists($target_file)){
    		$uploadOk = 0;
    		$data['success'] = false;
    		$data['errors']  = "Sorry, file already exists.";
    	}else if($_FILES["fileToUpload"]["size"] > 500000){
    		$uploadOk = 0;
    		$data['success'] = false;
    		$data['errors']  = "Sorry, file already exists.";
	    }else if($check == false) {
	        $uploadOk = 0;
	        $data['success'] = false;
    		$data['errors']  = "File is not an image.";
	    }else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ){
	        $uploadOk = 0;
	        $data['success'] = false;
    		$data['errors']  = "only JPG, JPEG, PNG & GIF files are allowed";
	    }else{
	    	 if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        	   $data['success'] = true;
			   $data['message'] = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

			   $file_url = "'$target_file'";
				$sub = substr($file_url, 10 );



				$admag = "INSERT INTO covers (id,name) VALUES (NULL,'$sub)";
				if($connection->query($admag) === TRUE){
					$rcov = mysqli_insert_id($connection);
					$mag_query = "INSERT INTO magazines (id,name,language,cover) VALUES (NULL,'$title','$language','$rcov')";
					if ($connection->query($mag_query) === TRUE) {
						   $data['success'] = true;
						   $data['message'] = "New record created successfully";
				
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
					$connection->close();

    		} else {
        	   $data['success'] = false;
    		   $data['errors']  = "Sorry, there was an error uploading your file.";
    		}
	    }
	 }

	
	}


echo json_encode($data);

?>