<?php

if(isset($_POST['submit'])){
	$isbn = $_POST['isbn'];
	$cpnum = $_POST['cpnum'];

	$set_success = array($isbn,$cpnum);
}else{
	$isbn = "";
	$date_added = "";
	$cpnum = "";
}

 require_once '../../../core/database/connect.php'; 
 $errors = array();
 $data = array();

 $sisbn = "SELECT id from books WHERE isbn = '$isbn'";
 $sisbn_num = mysqli_query($connection,$sisbn);
 $cpid = mysqli_fetch_assoc($sisbn_num);
 $rows_isbn = mysqli_num_rows($sisbn_num);
 $dt = time();
 $mysql_date = strftime("%Y-%m-%d %H:%M:%S", $dt);
 
 if( $isbn = "" || $cpnum == "" ){
 	switch($set_success){
		case $set_success[0] == "": $errors['isbn'] = 'ISBN is Required';
		
		case $set_success[1] == "": $errors['cpnum'] = 'Enter number of copies';
		break;  
	}

	$data['success'] = false;
    $data['errors']  = $errors;
 }else if($rows_isbn == 0){
 	$data['success'] = false;
    $data['errors']  = 'Book not found add this book to library first';
 }else{
 	$numcp = (int)$cpnum;
 	$countcp = 0;
 	while($numcp > $countcp){
 		$addcp_query = "INSERT INTO copies(id,book_id,date_added) VALUES (NULL,'$cpid[id]','$mysql_date')";
 		if ($connection->query($addcp_query) === TRUE) {
 			echo "New record created successfully"."<br/>";
			$data['success'] = true;
			$data['message'] = 'Success!';
		}else{
	    	$errors = $connection->error;
	    	$data['success'] = false;
	    	$data['errors']  = $errors;
		}
			$countcp++;
		}
			$connection->close();
 	}

echo json_encode($data);

?>