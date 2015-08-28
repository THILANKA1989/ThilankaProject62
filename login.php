<?php include 'core/init.php' ?>

<?php

if(!empty($_POST)){
	$username = $_POST['username'];
	$password = $_POST['password'];

 }else{
 	$username = "";
 	$password = "";
 }

	if($username&&$password){
		$query = mysqli_query($connection,"SELECT * FROM user WHERE username='$username'");
		$numrows = mysqli_num_rows($query);

		if($numrows!=0){
			while($row = mysqli_fetch_assoc($query)){
				$dbUserName = $row['username'];
				$dbpassword = $row['password'];
			}

			if($username==$dbUserName&&md5($password)==$dbpassword){
				$_SESSION['username']=$username;
				?>
				<p style="color: green !important; font-size:14px !important;">Logged in Successfully<br/> <a href="index.php">Click Here</a></p> <?php
			}else{
				echo "Incorrect Password";
			}
		}else{
			die("That user not exist or banned");
		}
	}else{
		die("Please Enter username or password");
	}

?>
