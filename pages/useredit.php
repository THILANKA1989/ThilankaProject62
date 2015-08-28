<?php
require_once '../core/init.php'; //call to database function
if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$mobile = $_POST['mobile'];
	$fname = $_POST['fname'];
	$lname= $_POST['lname'];
	$address = $_POST['address'];
	$nic = $_POST['nic'];
	$email = $_POST['email'];
	$id= $_POST['id'];
	$pwd = $_POST['pwd'];
	$cpwd = $_POST['cpwd'];

	$set_seccess = array($username,$mobile,$fname,$address,$nic,$email);
}else{
	$username ="";
	$mobile = "";
	$fname ="";
	$lname="";
	$address ="";
	$nic ="";
	$email ="";
}

$querybasic = mysqli_query($connection,"SELECT * FROM user WHERE id= '$id'");
$currentdata= mysqli_fetch_assoc($querybasic); //get user's data
$errors = array();
$data = array();

$niclength = strlen($nic);
$nic_v = substr($nic,9);
$mobilelength = strlen($mobile);
$target_dir = "../assets/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$checkfile = substr($target_file,17);
if(strlen($username) < 6){
	$data['success'] = false;
    $data['errors']  = "username must be 6 or more Characters";
}else if($niclength != 10 || $nic_v != 'V' || $mobilelength != 10){
	$data['success'] = false;
    $data['errors']  = "Mobile number must have 10 numbers or Insert Valid NIC";
}else{
	if($currentdata['username'] == $username){
		$data['success'] = false;
    	$data['message']  = "username didn't changed";
	}else{
		$queryupdateuname= "UPDATE user SET username = '$username' WHERE id='$id'";
	  if($connection->query($queryupdateuname) === TRUE){
			   		 $data['success'] = True;
    				 $data['Message']  = "New Username is updated you have to logout";
    				 header('location: ../logout.php');
		}else{
			   		 $data['success'] = false;
    				 $data['errors']  = "New Username update failed";
		}
	}

	if($currentdata['mobile'] != $mobile){ //check the mobile number is changed
	$queryupdatemobile= "UPDATE user SET mobile = '$mobile' WHERE id='$id'";
	  if($connection->query($queryupdatemobile) === TRUE){
			   		 $data['success'] = True;
    				 $data['errors']  = "New Mobile is updated";
		}else{
			   		 $data['success'] = false;
    				 $data['errors']  = "New mobile update failed";
		}
	}

	if($currentdata['firstname'] != $fname){ //check the firstname is changed
	$queryupdatefn= "UPDATE user SET firstname = '$fname' WHERE id='$id'";
	  if($connection->query($queryupdatefn) === TRUE){
			   		 $data['success'] = True;
    				 $data['errors']  = "New First Name is updated";
		}else{
			   		 $data['success'] = false;
    				 $data['errors']  = "New Firstname update failed";
		}
	}

	if($currentdata['lastname'] != $lname){ //check the last name is changed
	$queryupdateln= "UPDATE user SET lastname = '$lname' WHERE id='$id'";
	  if($connection->query($queryupdateln) === TRUE){
			   		 $data['success'] = True;
    				 $data['errors']  = "New Lastname is updated";
		}else{
			   		 $data['success'] = false;
    				 $data['errors']  = "New Lastname update failed";
		}
	}

	if($address != ""){ //check a new address is entered
	$queryupdatea= "UPDATE user SET address = '$address' WHERE id='$id'";
	  if($connection->query($queryupdatea) === TRUE){
			   		 $data['success'] = True;
    				 $data['errors']  = "New Address is updated";
		}else{
			   		 $data['success'] = false;
    				 $data['errors']  = "New Address update failed";
		}
	}

	if($currentdata['nationalid'] != $nic){ //check nic is changed
	$queryupdaten= "UPDATE user SET nationalid = '$nic' WHERE id='$id'";
	  if($connection->query($queryupdaten) === TRUE){
			   		 $data['success'] = True;
    				 $data['errors']  = "New NIC is updated";
		}else{
			   		 $data['success'] = false;
    				 $data['errors']  = "New NIC update failed";
		}
	}


	if($currentdata['email'] != $email){
	$queryupdatemail= "UPDATE user SET email = '$email' WHERE id='$id'";
	  if($connection->query($queryupdatemail) === TRUE){
			   		 $data['success'] = True;
    				 $data['errors']  = "New Email is updated";
		}else{
			   		 $data['success'] = false;
    				 $data['errors']  = "New Email update failed";
		}
	}

	if($cpwd == ""|| $pwd == ""){ //password confirmation
		$data['success'] = true;
    	$data['errors']  = "Password has not changed";
	}else if($pwd == $cpwd & strlen($pwd) > 6 ){ // check for minimum length of password
		$password = md5($pwd);
		$cpassword = md5($cpwd);
	$queryupdatemobile= "UPDATE user SET password = '$password' WHERE id='$id'";
	  if($connection->query($queryupdatemobile) === TRUE){
			   		 $data['success'] = True;
    				 $data['errors']  = "New password is updated";
    				 header('location: ../logout.php');

		}else{
			   		 $data['success'] = false;
    				 $data['errors']  = "New password update failed";
		}
	}else{
		 $data['success'] = false;
    	 $data['errors']  = "username password not match or Password smaller than 6 characters";
	}


}

if($checkfile != ""){ //check whether file is selected to upload
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    	if(file_exists($target_file)){
    		$uploadOk = 0;
    		$data['success'] = false;
    		$data['errors']  = "Sorry, file already exists.";
    	}else if($_FILES["fileToUpload"]["size"] > 500000){ //chech the file size
    		$uploadOk = 0;
    		$data['success'] = false;
    		$data['errors']  = "Sorry, file already exists.";
	    }else if($check == false) { //check the file is real
	        $uploadOk = 0;
	        $data['success'] = false;
    		$data['errors']  = "File is not an image.";
	    }else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ){ // check the file type is valid
	        $uploadOk = 0;
	        $data['success'] = false;
    		$data['errors']  = "only JPG, JPEG, PNG & GIF files are allowed";
	    }else{
	    	 if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        	   $data['success'] = true;
			   $data['message'] = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

			   $file_url = "'$target_file'";
			   $sub = substr($file_url,4); //get the path of uploaded file
			
			 
			   $admag = "UPDATE picture SET profilepic = '$sub WHERE user_id = '$id' ";
			   if($connection->query($admag) === TRUE){
			   		 $data['success'] = True;
    				 $data['message']  = "New image is updated";
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
echo json_encode($data); //pass data to json by encoding
