<?php 
include '../core/functions/dateformatting.php';
require_once '../core/init.php';
?>
<?php
if(isset($_POST['submit'])){
	$id = $_POST['id'];
	$title = $_POST['title'];
}else{
	$id = "";
	$title = "";
}

$querybasic = mysqli_query($connection,"SELECT * FROM magazines WHERE id= '$id'");
$currentdata= mysqli_fetch_assoc($querybasic);
 $errors = array();
 $data = array();

if($currentdata['name'] != $title){
 $queryupdatetitle= "UPDATE magazines SET name = '$title' WHERE id='$id'";
   if($connection->query($queryupdatetitle) === TRUE){
             $data['success'] = True;
            $data['errors']  = "New Title is updated";
   }else{
             $data['success'] = false;
            $data['errors']  = "New Title update failed";
   }
 }

  $target_dir = "../assets/covers/";
 $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
 $uploadOk = 1;
 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
 $checkfile = substr($target_file,16);

 if($checkfile != ""){
 	if(isset($_POST["submit"])) {
 	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
     	if(file_exists($target_file)){
     		$uploadOk = 0;
     		$data['success'] = false;
     		$data['errors']  = "Sorry, file already exists.";
     	}else if($_FILES["fileToUpload"]["size"] > 500000){
     		$uploadOk = 0;
     		$data['success'] = false;
     		$data['errors']  = "Sorry, Too large.";
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
 			   $sub = substr($file_url,4);


 			   $admag = "INSERT INTO covers(id,name) VALUES(NULL,'$sub)";

 			   if($connection->query($admag) === TRUE){
 			   		 $data['success'] = True;
             $getidcov = mysqli_insert_id($connection);
             $setnew = "UPDATE magazines SET cover = '$getidcov' WHERE id = '$id'";
              if($connection->query($setnew) === TRUE){
                 $data['message']  = "New image is updated";
              }else{
                $data['success'] = false;
                $data['errors']  = "New image update failed";
              }

 			   }else{
 			   		 $data['success'] = false;
     				 $data['errors']  = "New image upload failed";
 			   }

 	    	 }else{
 	    	 	$data['success'] = false;
     			$data['errors']  = "New image Move failed";
 	    	 }
 		}

 	}



 }else{
 	$data['success'] = false;
     $data['message']  = "No file has Selected and Current Image not changed";
 }
 echo json_encode($data);

?>