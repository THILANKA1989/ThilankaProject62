<?php
if(isset($_SESSION['username'])){
  $user = $_SESSION['username'];

  $admins = mysqli_query($connection,"SELECT type FROM user WHERE username='$user'");
  $admin= mysqli_fetch_assoc($admins);
  $adminuser = $admin['type'];
  if($adminuser == 'admin'){
    $admin = 1;
  }else{
    $admin=0;
  }

}
?>
