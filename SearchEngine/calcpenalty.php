<?php
$userpen= $_SESSION['username'];
$selectuser = mysqli_query($connection."SELECT id FROM user WHERE username = '$userpen'");
$usernameid = mysqli_fetch_assoc($selectuser);


$calculation1= mysqli_query($connection,"SELECT due_date FROM user_lends_copies WHERE user_id='$usernameid[id]'");
$calculation = mysqli_fetch_assoc($caculation1);



//Calculate the difference.
include '../../functions/dateformatting.php';
//Our "then" date.
$then = $calculation['due_date'];
//Convert it into a timestamp.
$then = strtotime($then);
 
//Get the current timestamp.
$now = time();
 
//Calculate the difference.
$difference = $now - $then;
 
//Convert seconds into days.
$days = floor($difference / (60*60*24) );
?>