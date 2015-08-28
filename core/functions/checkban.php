<?php
$usernameban = mysqli_query($connection, "SELECT id FROM user WHERE username='$username'");
$isuser = mysqli_fetch_assoc($usernameban);
$userid = $isuser['id'];
$queryban = mysqli_query($connection,"SELECT * FROM ban WHERE id='$userid'");
$numrowbanned = mysqli_num_rows($queryban);

if($numrowbanned>0){
  $banned = 1;
}else{
  $banned = 0;
}
?>
