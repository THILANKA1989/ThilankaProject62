<?php
	function register_user($register_data){
		$register_data['password'] = md5($register_data['password']);
		print_r($register_data);
	}

	function logged_in(){
		return(isset($_SESSION['user_id'])) ? true : false;
	}

	function user_exists($username){
		$username = secure($username);
		return (mysql_result(mysql_query("SELECT COUNT('id') FROM 'user' WHERE 'username'='$username'"),0)==1) ? true : false; 
	}
	
	function user_id_from_username($username){
		$username = secure($username);
		return mysql_result(mysql_query("SELECT 'id' FROM 'user' WHERE 'username' = '$username'"),0, 'user_id');
	}
	
	function login($username,$password){
		$user_id = user_id_from_username($username);
		$username = secure($username);
		$password = md5($password);
		
		return(mysql_result(mysql_query("SELECT COUNT('id') FROM 'user' WHERE 'username' = '$username' AND 'password = '$password' "),0)==1) ? $user_id : false;
	}
?>