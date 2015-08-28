<?php
if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$description = $_POST['description'];

}else{
	$name = "";
	$description = "";
}
echo $name;
	$set_success = array($name,$description);
 require_once '../../../core/database/connect.php'; 

//$date_published = strip_slash(strftime($datepub));
//echo $date_published;
$errors = array();
$data = array();

$checkaut = mysqli_query($connection,"SELECT id FROM authors WHERE name='$name'");
$rowsaut = mysqli_num_rows($checkaut);

$target_dir = "../../../assets/images/authors/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);			
$target_file_exsist = substr($target_file,31);

if($name == "" || $description == ""){
		switch($set_success){
		case $set_success[0] == "": $errors['name'] = 'Name is Required';
		case $set_success[1] == "": $errors['description'] = 'Description is Required';
		}

		$data['success'] = false;
	    $data['errors']  = $errors;
}else if($rowsaut > 0 ){
		$data['success'] = false;
	    $data['errors']  = "This author already exist";
}else{
	$picture = "assets/images/authors/writer_icon.jpg";
	$queryaut = "INSERT INTO authors(id,name,description,picture) VALUES(NULL,'$name','$description','$picture')";
	if($target_file_exsist != ""){

				if(isset($_POST['submit'])) {
				    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			    	if(file_exists($target_file)){
			    		$uploadOk = 0;
			    		$data['success'] = false;
			    		$data['errors']  = "Sorry, file already exists.";

			    		
						if($connection->query($queryaut) === TRUE) {
						    $data['success'] = true;
						    $data['message'] = "New record created successfully with Default Cover Image";
						}else{
							$data['success'] = false;
				    		$data['errors']  = 'Default Cover Image set Failed';
						}

			    	}else if($_FILES["fileToUpload"]["size"] > 500000){
			    		$uploadOk = 0;
			    		$data['success'] = false;
			    		$data['errors']  = "Sorry, file Size is too High.";

			    		
						if($connection->query($queryaut) === TRUE) {
						    $data['success'] = true;
						    $data['message'] = "New record created successfully with Default Cover Image";
						}else{
							$data['success'] = false;
				    		$data['errors']  = 'Default Cover Image set Failed';
						}

				    }else if($check == false) {
				        $uploadOk = 0;
				        $data['success'] = false;
			    		$data['errors']  = "File is not an image.";

						if($connection->query($queryaut) === TRUE) {
						    $data['success'] = true;
						    $data['message'] = "New record created successfully with Default Cover Image";
						}else{
							$data['success'] = false;
				    		$data['errors']  = 'Default Cover Image set Failed';
						}
				    }else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpg"
						&& $imageFileType != "gif" ){
				        $uploadOk = 0;
				        $data['success'] = false;
			    		$data['errors']  = "only JPG, JPEG, PNG & GIF files are allowed";

			    		
						if($connection->query($queryaut) === TRUE) {
						    $data['success'] = true;
						    $data['message'] = "New record created successfully with Default Cover Image";
						}else{
							$data['success'] = false;
				    		$data['errors']  = 'Default Cover Image set Failed';
						}
				    }else{
				    	 if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			        	   $data['success'] = true;
						   $data['message'] = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
						   $file_url = "'$target_file'";
						   $sub = substr($file_url, 10 );
						   $queryauthor = "INSERT INTO authors(id,name,description,picture) VALUES(NULL,'$name','$description','$sub)";
						   if($connection->query($queryauthor) === TRUE){
						   		$data['success'] = true;
						    	$data['message'] = "New record created successfully with Image Selected";
						   }else{
						   		if($connection->query($queryaut) === TRUE) {
								    $data['success'] = true;
								    $data['message'] = "New record created successfully with Default Cover Image";
								}else{
									$data['success'] = false;
						    		$data['errors']  = 'Default Cover Image set Failed';
								}
						   }

				        }else{
						 $errors = $connection->error;
						 $data['success'] = false;
						 $data['errors']  = $errors;
					}
				}
			}	

		}				

}
echo json_encode($data);
?>