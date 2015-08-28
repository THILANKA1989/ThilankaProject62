<?php
include '../core/functions/dateformatting.php';
require_once '../core/init.php';
if(isset($_POST['submit'])){
	$title = $_POST['title'];
	$id = $_POST['id'];
	$publisher = $_POST['publisher'];
	$category= $_POST['category'];
	$price = $_POST['price'];
	$isbn = $_POST['isbn'];
  $datepub = $_POST['datepub'];

	$set_seccess = array(	$title,
  $id,
  	$publisher,
  $category,
  $price,
  	$isbn);
}else{
  $title = "";
  $id = "";
  $publisher = "";
  $category = "";
  $price = "";
  $isbn = "";
}

$pubdate = strip_slash($datepub);

$querybasic = mysqli_query($connection,"SELECT * FROM books WHERE id= '$id'");
$currentdata= mysqli_fetch_assoc($querybasic);
 $errors = array();
 $data = array();

 if($currentdata['title'] != $title){
 $queryupdatetitle= "UPDATE books SET title = '$title' WHERE id='$id'";
   if($connection->query($queryupdatetitle) === TRUE){
             $data['success'] = True;
            $data['errors']  = "New Title is updated";
   }else{
             $data['success'] = false;
            $data['errors']  = "New Title update failed";
   }
 }

 if($currentdata['price'] != $price){
 $queryupdateprice= "UPDATE books SET price = '$price' WHERE id='$id'";
   if($connection->query($queryupdateprice) === TRUE){
             $data['success'] = True;
            $data['errors']  = "New Price is updated";
   }else{
             $data['success'] = false;
            $data['errors']  = "New Price update failed";
   }
 }

 if($currentdata['date_released'] != $datepub){
 $queryupdatedate= "UPDATE books SET date_released = '$pubdate' WHERE id='$id'";
   if($connection->query($queryupdatedate) === TRUE){
             $data['success'] = True;
            $data['errors']  = "New Date Released is updated";
   }else{
             $data['success'] = false;
            $data['errors']  = "New Date Released update failed";
   }
 }


 $getcategory = mysqli_query($connection,"SELECT id FROM category WHERE name='$category' ");
 $getcat= mysqli_fetch_assoc($getcategory);
 $newcat = $getcat['id'];

 $getpublisher = mysqli_query($connection,"SELECT id FROM publishers WHERE name='$publisher' ");
 $getpub= mysqli_fetch_assoc($getpublisher);
 $newpub = $getpub['id'];
 if($currentdata['publisher_id'] != $newpub){
 $queryupdatepub= "UPDATE books SET publisher_id = '$getpub' WHERE id='$id'";
   if($connection->query($queryupdatepub) === TRUE){
             $data['success'] = True;
            $data['errors']  = "New Publisher is updated";
   }else{
             $data['success'] = false;
            $data['errors']  = "New Publisher update failed";
   }
 }

 if($currentdata['category_id'] != $newcat){
 $queryupdatecat= "UPDATE books SET category_id = '$newcat' WHERE id='$id'";
   if($connection->query($queryupdatecat) === TRUE){
             $data['success'] = True;
            $data['errors']  = "New Category is updated";
   }else{
             $data['success'] = false;
            $data['errors']  = "New Category update failed";
   }
 }

 if($currentdata['isbn'] != $isbn){
 $queryupdateisbn= "UPDATE books SET isbn = '$isbn' WHERE id='$id'";
   if($connection->query($queryupdateisbn) === TRUE){
             $data['success'] = True;
            $data['errors']  = "New ISBN is updated";
   }else{
             $data['success'] = false;
            $data['errors']  = "New ISBN update failed";
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
             $setnew = "UPDATE books_covers SET cover_id = '$getidcov' WHERE book_id = '$id'";
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
