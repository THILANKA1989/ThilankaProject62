<?php include 'core/init.php' ?>
<?php include 'searchEngine/functions.php' ?>
<?php
include 'core/functions/checkadmin.php';
 if(isset($admin)){
  if($admin == 0){
    header('location: index.php');
  }
}else{
  header('location: index.php');
} ?>
<!doctype html>
<html lang="en">
<?php include 'mainContent/head.php' ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700,400,600' rel='stylesheet' type='text/css'>
<link href="assets/css/customized.css" rel="stylesheet" media="screen">
<body>

<?php include 'mainContent/header.php'; ?>
<!-- main content -->
<?php

$id = $_GET['ID'];
$querybasic = mysqli_query($connection,"SELECT * FROM magazines WHERE id= '$id'");
$currentdata= mysqli_fetch_assoc($querybasic);


?>
<div class="content">

     		<!--- form edit -->
          <h4>Edit Info</h4>
            <form role="form" action="pages/magedit.php" method="post" id="formeditmags" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="Title">Magazine Title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo  $currentdata['name']; ?>">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $currentdata['id']; ?>">
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
				              <label for="Title">Upload new Cover:</label>
				              <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
				        </div>
              </div></div>
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
 <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="assets/js/css3-animate-it.js"></script>

  <div class="backset"></div>
<?php include 'mainContent/scripts.php' ?>

<?php include 'mainContent/footer.php';?>
</html>
