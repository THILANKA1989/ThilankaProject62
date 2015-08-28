<?php include '../mainContent/head.php'; ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700,400,600' rel='stylesheet' type='text/css'>
<div class="card">
<?php include '../core/init.php' ?>
<?php $result = mysqli_query($connection,"SELECT name FROM `category`"); ?>
<?php while ($row=mysqli_fetch_array($result)){ ?>
	<div class="col-md-4">
	<div class="cardslot">
  		<a href="categoryview.php?catid=<?php echo $row['name'];?>"><img src="assets/images/category.jpg"></a>				
  		<?php $value = $row['name']; ?>
   		<h3><?php echo $row['name'] ?></i></h3>
	</div>
	</div>
<?php }  ?> 
</div>