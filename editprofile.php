<?php include 'core/init.php' ?>
<?php include 'searchEngine/functions.php' ?>
<!doctype html>
<html lang="en">
<?php include 'mainContent/head.php' ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700,400,600' rel='stylesheet' type='text/css'>
<link href="assets/css/customized.css" rel="stylesheet" media="screen">
<body>


<?php include 'mainContent/header.php'; ?>
<!-- main content -->
<?php

$username = $_GET['username'];
$querybasic = mysqli_query($connection,"SELECT * FROM user WHERE username= '{$username}'");
$currentdata= mysqli_fetch_assoc($querybasic);


?>
<div class="content">
     		<!--- form edit -->
          <h4>Edit Info</h4>
            <form role="form" action="pages/useredit.php" method="post" id="formbooks" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="Title">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $currentdata['id']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="Title">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $currentdata['email']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="Title">Firstname:</label>
                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $currentdata['firstname']; ?>">
                  </div>
                   <div class="form-group">
                   <label for="Title">Mobile:</label>
                   <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $currentdata['mobile']; ?>">
                </div>
                <div class="form-group">
                  	  <label for="Title">Password:</label>
                      <input type="password" class="form-control" id="pwd" name="pwd" value="">
                  </div>
              </div>
              <div class="col-md-6">

                 <div class="form-group">
                    <label for="Title">National ID:</label>
                    <input type="text" class="form-control" id="nic" name="nic" value="<?php echo $currentdata['nationalid']; ?>">
                  </div>
                 <div class="form-group">
                    <label for="Title">Lastname:</label>
                    <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $currentdata['lastname']; ?>">
                 </div>
                   <div class="form-group">
                    <label for="Title">Address:</label>
                    <textarea type="text" class="form-control" id="address" name="address" value="<?php echo $currentdata['address']; ?>"></textarea>
                  </div>

                  	<div class="form-group">
				        <label for="Title">Profile Picture:</label>
				          <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
				     </div>
				  <div class="form-group">
                  	  <label for="Title">Confirm Password:</label>
                      <input type="password" class="form-control" id="cpwd" name="cpwd" value="">
                  </div>

              </div>
            </div>
            <div class="row"><div class="col-md-12"><h4>Note: If you changed 'username' or 'Password' You will be logged out automatically and login again with new username or password</h4></div></div>
            <div class="row">
              <div class="col-md-12">
                <span id="errMessage"></span>
                <input type="submit" value="Edit" id="submit" class="form-control blue" name="submit">
              </div>
            </div>
            </form>
          <!-- form edit -->
</div>
<!-- content -->



<?php include '/mainContent/scripts.php' ?>


 <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="/assets/js/css3-animate-it.js"></script>

<?php include '/mainContent/footer.php';?>
