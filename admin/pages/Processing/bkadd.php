<?php

if(isset($_POST['submit'])){
	$category = $_POST['category'];
	$publisher = $_POST['publisher'];
	$price = $_POST['price'];
	$description = $_POST['description'];
	$author = $_POST['author'];
	$datepub = $_POST['datepub'];
	$title = $_POST['title'];
	$isbn = $_POST['isbn'];
	$location = $_POST['location'];
	$language = $_POST['language'];

	$set_success = array($isbn,$category,$title,$publisher,$datepub,$author,$language,$location,$price);
}else{
	$category = "";
	$publisher = "";
	$price = "";
	$description = "";
	$author = "";
	$datepub = "";
	$title = "";
	$isbn = "";
	$location ="";
	$language ="";
}

 require_once '../../../core/database/connect.php'; 

//$date_published = strip_slash(strftime($datepub));
//echo $date_published;
$exsisting_bk = mysqli_query($connection,"SELECT * FROM books WHERE isbn='$isbn'");
$numrows = mysqli_num_rows($exsisting_bk);

$errors = array();
$data = array();

if($isbn == "" || $category == "select category" || $title ==  "" || $publisher == "select publisher" || $datepub ==  "" || $author == "select author" || $language == "select language" || $location == "select location" || $price == ""){
	switch($set_success){
		case $set_success[0] == "": $errors['isbn'] = 'ISBN is Required';
		 
		case $set_success[1] == "select category": $errors['category'] = 'Category is Required';
		
		case $set_success[2] == "": $errors['title'] = 'Title is Required';
		
		case $set_success[3] == "select publisher": $errors['publisher'] = 'Publisher is Required';
		
		case $set_success[4] == "": $errors['datepub'] = 'Published Date is Required';
		
		case $set_success[5] == "select author": $errors['author'] = 'Author name is Required';
	
		case $set_success[6] == "select language": $errors['language'] = 'Language is Required';
		
		case $set_success[7] == "select location": $errors['location'] = 'Location is Required';
		
		case $set_success[8] == "": $errors['price'] = 'Price is Required';
		break;
	}

	$data['success'] = false;
    $data['errors']  = $errors;

}else if($numrows >= 1){
	$errors['numrows'] = "This book allready Exist, please add it as a copy";
	$data['success'] = false;
    $data['errors']  = $errors;

}else{
	$select_author = mysqli_query($connection,"SELECT id FROM authors WHERE name='$author'");
	$select_language = mysqli_query($connection,"SELECT id FROM languages WHERE name='$language'");
	$select_location = mysqli_query($connection,"SELECT id FROM locations WHERE name='$location'");
	$select_publisher = mysqli_query($connection,"SELECT id FROM publishers WHERE name='$publisher'");
	$select_category = mysqli_query($connection,"SELECT id FROM category WHERE name='$category'");

	$category_id = mysqli_fetch_assoc($select_category);
	$author_id = mysqli_fetch_assoc($select_author);
	$location_id = mysqli_fetch_assoc($select_location);
	$publisher_id = mysqli_fetch_assoc($select_publisher);
	$lang_id = mysqli_fetch_assoc($select_language);
	$dt = time();
	$mysql_datetime = strftime("%Y-%m-%d %H:%M:%S", $dt);

	include '../../../core/functions/dateformatting.php';
	$date = strip_slash($datepub);

	$query = "INSERT INTO books (isbn, title, description, category_id, price, publisher_id, date_released, date_added) values('$isbn', '$title', '$description', '$category_id[id]', '$price', '$publisher_id[id]', '$date', '$mysql_datetime')";
	if ($connection->query($query) === TRUE) {
		 $data['success'] = true;
		 $data['message'] = "New record on books created successfully";
	    $author_add = mysqli_insert_id($connection);
	    $author_query = "INSERT INTO books_authors (book_id,author_id) values('$author_add','$author_id[id]')";

		if ($connection->query($author_query) === TRUE) {
			   $data['success'] = true;
			   $data['message'] = "New record created successfully";
		}else{
			$data['success'] = false;
    		$data['errors']  = 'Author Addition Failed';
		}

		$copy_query = "INSERT INTO copies(id,book_id,date_added) VALUES (NULL,'$author_add','$mysql_datetime')";
		if($connection->query($copy_query) === TRUE) {
			   $data['success'] = true;
			   $data['message'] = "New record created successfully";
		}else{
			$data['success'] = false;
    		$data['errors']  = 'copy Addition Failed';
		}

		$bk_location= "INSERT INTO books_locations(book_id,location_id) VALUES('$author_add','$location_id[id]')";
		if($connection->query($bk_location) === TRUE) {
			   $data['success'] = true;
			   $data['message'] = "New record successfully";
		}else{
			$data['success'] = false;
    		$data['errors']  = 'Locations Addition Failed';
		}

		$bk_lang = "INSERT INTO books_languages (book_id,lang_id) VALUES ('$author_add','$lang_id[id]')";
		if($connection->query($bk_lang) === TRUE) {
			   $data['success'] = true;
			   $data['message'] = "New record created successfully";
		}else{
			$data['success'] = false;
    		$data['errors']  = 'Languages Addition Failed';
		}

			$target_dir = "../../../assets/covers/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			
			$target_file_exsist = substr($target_file,23);

			if($target_file_exsist != ""){

				if(isset($_POST['submit'])) {
				    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			    	if(file_exists($target_file)){
			    		$uploadOk = 0;
			    		$data['success'] = false;
			    		$data['errors']  = "Sorry, file already exists.";

			    		$bk_cover = "INSERT INTO books_covers(book_id,cover_id) VALUES('$author_add','1')";
						if($connection->query($bk_cover) === TRUE) {
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

			    		$bk_cover = "INSERT INTO books_covers(book_id,cover_id) VALUES('$author_add','1')";
						if($connection->query($bk_cover) === TRUE) {
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

			    		$bk_cover = "INSERT INTO books_covers(book_id,cover_id) VALUES('$author_add','1')";
						if($connection->query($bk_cover) === TRUE) {
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

			    		$bk_cover = "INSERT INTO books_covers(book_id,cover_id) VALUES('$author_add','1')";
						if($connection->query($bk_cover) === TRUE) {
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
							$admag = "INSERT INTO covers (id,name) VALUES (NULL,'$sub)";
							if($connection->query($admag) === TRUE){
								$rcov = mysqli_insert_id($connection);
								$bk_cover = "INSERT INTO books_covers(book_id,cover_id) VALUES('$author_add','$rcov')";
								if($connection->query($bk_cover) === TRUE){
									 $data['success'] = true;
					    			 $data['message'] = "New record created successfully";
								}else{
									$data['success'] = false;
			    					$data['errors']  = 'New Cover Image set Failed';
								}
							}else{
						    	$errors = $connection->error;
						    	$data['success'] = false;
						    	$data['errors']  = $errors;
							}
							}
						}

					}

			}else{
				$bk_cover = "INSERT INTO books_covers(book_id,cover_id) VALUES('$author_add','1')";
				if($connection->query($bk_cover) === TRUE) {
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
		$connection->close();
	}

	echo json_encode($data);
?>

