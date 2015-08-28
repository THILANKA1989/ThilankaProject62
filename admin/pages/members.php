<?php include '../../core/init.php'; ?>
<div class="dashtitle">
	<h2>Members</h2>
</div><br/
<h4>Register new Users</h4>
<form role="form" action="pages/processing/useradd.php" method="post" id="formbooks">
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
        <label for="Title">Username:</label>
        <input type="text" class="form-control" id="username" name="username">
      </div>
      <div class="form-group">
        <label for="Title">Email:</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>
      <div class="form-group">
        <label for="Title">Firstname:</label>
        <input type="text" class="form-control" id="fname" name="fname">
      </div>
      <div class="form-group">
        <label for="Title">Password:</label>
        <input type="password" class="form-control" id="pwd" name="pwd">
      </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
       <label for="Title">Mobile:</label>
       <input type="text" class="form-control" id="mobile" name="mobile">
    </div>
     <div class="form-group">
        <label for="Title">National ID:</label>
        <input type="text" class="form-control" id="nic" name="nic">
      </div>
     <div class="form-group">
        <label for="Title">Lastname:</label>
        <input type="text" class="form-control" id="lname" name="lname">
     </div>
       <div class="form-group">
        <label for="Title">Address:</label>
        <textarea type="text" class="form-control" id="address" name="address"></textarea>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <span id="errMessage"></span>
    <input type="submit" value="Add Member" id="submit" class="form-control blue" name="submit">
  </div>
</div>
</form>
<?php
$users = mysqli_query($connection, "SELECT DISTINCT us.firstname AS First, us.lastname AS Last,us.username AS Username,pc.profilepic AS Picture,us.id AS ID FROM user us JOIN picture pc ON pc.user_id = us.id
                                    WHERE us.type != 'admin'
                                  ORDER BY us.firstname DESC");
$userget = mysqli_fetch_assoc($users);
$numrows = mysqli_num_rows($users); 
?>
<div class="row libraryinfo">
<?php if($numrows > 0){  ?>
           <?php do { ?>
  <div class="col-md-4">
        <div class="memberimage2">
        <div class="pictp">
                  <span class="profilepic"><img src="<?php echo "../".$userget['Picture']; ?>" class="img-circle" width="100px" height="100px"></span>
              </div>
              <h4><?php echo $userget['First']." ".$userget['Last']; ?></h4>
              <p><?php echo $userget['Username']; ?></p>
            </div>
      </div>
 <?php } while($userget=mysqli_fetch_assoc($users)); }else{ ?>
                            <?php echo 'No Members'; }?>

</div>


                     
