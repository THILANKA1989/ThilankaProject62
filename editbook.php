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

$isbn = $_GET['username'];
$querybasic = mysqli_query($connection,"SELECT * FROM books WHERE isbn= '$isbn'");
$currentdata= mysqli_fetch_assoc($querybasic);
$currentcatid = $currentdata['category_id'];
$getcategory = mysqli_query($connection,"SELECT name FROM category WHERE id='$currentcatid' ");
$getcat= mysqli_fetch_assoc($getcategory);

$currentpubid = $currentdata['publisher_id'];
$getpublisher = mysqli_query($connection,"SELECT name FROM publishers WHERE id='$currentpubid' ");
$getpub= mysqli_fetch_assoc($getpublisher);

?>
<div class="content">
     		<!--- form edit -->
          <h4>Edit Info</h4>
            <form role="form" action="pages/bkedit.php" method="post" id="formbooks" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="Title">Book Title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo  $currentdata['title']; ?>">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $currentdata['id']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="Title">ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo $currentdata['isbn']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="Title">Category:</label>
                    <input type="text" class="form-control" id="category" name="category" value="<?php echo $getcat['name']; ?>">
                  </div>
                   <div class="form-group">
                   <label for="Title">Publisher:</label>
                   <input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo $getpub['name']; ?>">
                </div>

              </div>
              <div class="col-md-6">

                 <div class="form-group">
                    <label for="Title">Price:</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $currentdata['price']; ?>">
                  </div>
                 <div class="form-group">
                    <label for="Title">Published Date:</label>
                    <input type="date" class="form-control" id="datepub" name="datepub" value="<?php echo $currentdata['date_released']; ?>">
                 </div>

                <div class="form-group">
				              <label for="Title">Upload Cover:</label>
				              <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
				        </div>
                 <div class="form-group">
                   <label for="Title">Author:</label>
                   <input type="text" class="form-control" id="Author" name="Author" value="<?php echo $getpub['name']; ?>">
                </div>
              </div>
            </div>
            <div class="row"><div class="col-md-12"><h4>Note: If you updated 'ISBN' successfully you will be redirected to Homepage</h4></div></div>
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

<?php include '/mainContent/footer.php';?>

<?php include '/mainContent/scripts.php' ?>


 <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="/assets/js/css3-animate-it.js"></script>
<script src="assets/js/css3-animate-it.js"></script>
</html>
