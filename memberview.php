
<?php include '/core/init.php' ?>
<?php include '/searchEngine/functions.php' ?>
<!doctype html>
<html lang="en">
<?php include '/mainContent/head.php' ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700,400,600' rel='stylesheet' type='text/css'>
<link href="assets/css/customized.css" rel="stylesheet" media="screen">
<body>
<?php include '/mainContent/header.php' ?>
<?php

$userpen= $_GET['username'];
$selectuser = mysqli_query($connection,"SELECT id FROM user WHERE username = '$userpen'");
$usernameid = mysqli_fetch_assoc($selectuser);

$getbooks = mysqli_query($connection, "SELECT copy_id FROM user_lends_copies WHERE user_id='$usernameid[id]' AND status='open'");
$bookidget = mysqli_fetch_assoc($getbooks);
$bookcopyid = $bookidget['copy_id'];



$calculation1 = mysqli_query($connection,"SELECT due_date FROM user_lends_copies WHERE user_id='$usernameid[id]' AND copy_id = '$bookidget[copy_id]'");
$calculation = mysqli_fetch_assoc($calculation1);
$calcrows = mysqli_num_rows($calculation1);
$getpen = mysqli_query($connection,"SELECT penalty from user WHERE id='$usernameid[id]'");
$getpenaltydb = mysqli_fetch_assoc($getpen);
$getpenaltydbint = (int)$getpenaltydb['penalty'];

$getdatesp = mysqli_query($connection,"SELECT SUM(due_date) AS totaldates FROM user_lends_copies WHERE user_id='$usernameid[id]' status= 'open' ");
$datespen = mysqli_fetch_assoc($getdatesp);


if($calcrows>0){
//Calculate the difference.
//Our date.
$then = $datespen['totaldates'];
//Convert it into a timestamp.
$then = strtotime($then);
 
//Get the current timestamp.
$now = time();
 
//Calculate the difference.
$difference = $now - $then;

//Convert seconds into days.
$day = floor($difference / (60*60*24) );
$days = $day+$getpenaltydbint;
}else{

  $days = $getpenaltydbint;
}





  if(isset($_SESSION['username'])){
    $user= $_GET['username'];
  $userget = mysqli_query($connection,"SELECT * FROM user WHERE username = '$user'");
  $row = mysqli_fetch_assoc($userget);
  $idofuser = mysqli_query($connection,"SELECT id FROM user WHERE username = '$user'");
  $userid = mysqli_fetch_assoc($idofuser);
  $picture = mysqli_query($connection,"SELECT profilepic FROM picture WHERE user_id = '$userid[id]'");
  $picturelink = mysqli_fetch_assoc($picture);


  $borrows =mysqli_query($connection,"SELECT uc.copy_id AS copyID, uc.user_id AS User,bk.title AS Book, bk.id AS bookID, uc.status AS Status,uc.date_lend AS bdate,uc.due_date AS ddate,uc.id AS ID, bk.isbn AS ISBN
  			  FROM user_lends_copies uc
  			  JOIN copies cp ON
  			  	uc.copy_id = cp.id
  			  JOIN books bk ON
  			  	cp.book_id = bk.id
  			  WHERE user_id = '$userid[id]'
  			  ORDER BY bdate DESC");
  $allborrows=mysqli_fetch_assoc($borrows);
  $numrowsbr = mysqli_num_rows($borrows);

  $borrowspen =mysqli_query($connection,"SELECT uc.copy_id AS copyID, uc.user_id AS User,bk.title AS Book, bk.id AS bookID, uc.status AS Status,uc.date_lend AS bdate,uc.due_date AS ddate,uc.id AS ID, bk.isbn AS ISBN
          FROM user_lends_copies uc
          JOIN copies cp ON
            uc.copy_id = cp.id
          JOIN books bk ON
            cp.book_id = bk.id
          WHERE user_id = '$userid[id]'
          AND
          status = 'open'
          ORDER BY bdate DESC");
  $allborrowspen=mysqli_fetch_assoc($borrowspen);
  $numrowspen = mysqli_num_rows($borrowspen);
  

?>


<div class="content">

<!-- profile info basic -->

	<div class="row libraryinfo">
		<div class="col-md-4">
		    <div class="profileimage">
	            <img src="<?php echo $picturelink['profilepic']; ?>" >
	            <h4 class="heading3 headingbook"><?php  echo $row['firstname']." ".$row['lastname']; ?></h4>

		    </div>
		 </div>
		 <div class="col-md-8">
			<div class="bookinfo" style="height: 450px !important">
				 <h3 class="headingbook"><?php echo $row['username']; ?></h3>
         <button type="button" class="btn btn-success viewmemberedit"><a href="editprofile.php?username=<?php echo $_SESSION['username'];?>" id="#my_modal" target-data="#my_modal">Edit Profile</a></button>

       <div class="bookinfolist">
                     <ul class="listbook" style="zoom: 1.1;">
                          <li><strong>Username: </strong><?php echo $row['username']; ?></li>
                          <li><strong>ID: </strong><?php echo $row['id']; ?></li>
                          <li><strong>Firstname: </strong><?php echo $row['firstname']; ?></li>
                           <li><strong>Lastname: </strong><?php echo $row['lastname']; ?></li>
                           <li><strong>Address: </strong><?php echo $row['address']; ?></li>
                          <li><strong>Mobile: </strong><?php echo $row['mobile']; ?></li>
                          <li><strong>Email: </strong><?php echo $row['email'] ?></li>
                    </ul>
                </div>

			</div>
		 </div>
	</div>
<!-- profile info basic -->
<!-- Penalty -->
<div class="libraryinfo row">
<h4>Currently Borrowed Books</h4>
   <table class="table table-bordered table-responsive">
          <th>
            <td>Copy ID</td>
            <td>Username</td>
            <td>Book Title</td>
            <td>BookID</td>
            <td>Borrowed Date</td>
            <td>Due Date</td>
            <td>Penalty</td>
          </th>
          <?php if($numrowspen > 0){  ?>
          <?php $total=0; ?>
                        <?php do { ?>
          <tr>
            <td><?php echo $allborrowspen['ID'];?></td>
            <td><?php echo $allborrowspen['copyID'];?></td>
            <td><?php echo $allborrowspen['User'];?></td>
            <td><?php echo $allborrowspen['Book'];?></td>
            <td><?php echo $allborrowspen['bookID'];?></td>
            <td><?php echo $allborrowspen['bdate'];?></td>
            <td><?php echo $allborrowspen['ddate'];?></td>
            <td><?php
            $thenspc = $allborrowspen['ddate'];
            //Convert it into a timestamp.
            $thenspc = strtotime($thenspc);
             
            //Get the current timestamp.
            $now = time();
             
            //Calculate the difference.
            $difference = $now - $thenspc;

            //Convert seconds into days.
            $dayspc = floor($difference / (60*60*24) );
            if($dayspc<0){  
            
            echo "N/A";
            }else{
             echo $dayspc.".00";
             } ?></td>
    </tr>
     <?php $total = $total+ $dayspc; ?>
<?php } while($allborrowspen=mysqli_fetch_assoc($borrowspen)); }else{ ?>
                            <?php echo 'No Books with Penalties'; }?>
       <tr>
        
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
          <td>Unpaid penalty</td>
         <td><?php echo $getpenaltydbint.".00Rs"; ?></td>
       </tr>                      

</table>
  
</div>
<!--penalty-->
<!-- summary -->
  <div class="libraryinfo row">
  	<div class="col-lg-4">
      <div class="carduser">
        <div class="totalpenalty">
          <div class="numberprice">
            <h1 class="pricepen"><?php 
              if($total<0){
                echo $getpenaltydbint.".00Rs"; 
              }else{
                echo $total+$getpenaltydbint.".00Rs"; 
              } ?></h1>
          </div>
          <h4>Total Penalty</h4>
        </div>
      </div>
      </div>
      <div class="col-lg-4">
      <div class="carduser">
        <div class="totalpenalty">
           <div class="titlecircle">
           <h2 class="pricepen2"><a href="bookview.php?bookisbn=<?php echo $allborrows['ISBN']; ?>" class="bluetitle"><?php echo $allborrows['Book']?></a></h2>
          </div>
          <h4>Recent Book</h4>
        </div>
      </div>
      </div>
      <div class="col-lg-4">
      <div class="carduser">
        <div class="totalpenalty">
           <div class="numberprice">
            <h1 class="pricepen"><?php echo $numrowsbr; ?></h1>
          </div>
          <h4>Number of Borrows</h4>
        </div>
      </div>
      </div>
    </div>
<!-- summary -->

<!-- lending history -->
<div class="libraryinfo row">
<h4>Borrowing history</h4>
	 <table class="table table-bordered table-responsive">
          <th>
          	<td>Copy ID</td>
            <td>Username</td>
            <td>Book Title</td>
            <td>BookID</td>
            <td>Status</td>
            <td>Borrowed Date</td>
            <td>Due Date</td>
          </th>
          <?php if($numrowsbr > 0){  ?>
                        <?php do { ?>
          <tr>
            <td><?php echo $allborrows['ID'];?></td>
            <td><?php echo $allborrows['copyID'];?></td>
            <td><?php echo $allborrows['User'];?></td>
            <td><?php echo $allborrows['Book'];?></td>
            <td><?php echo $allborrows['bookID'];?></td>
            <td><?php echo $allborrows['Status'];?></td>
            <td><?php echo $allborrows['bdate'];?></td>
            <td><?php echo $allborrows['ddate'];?></td>
		</tr>
<?php } while($allborrows=mysqli_fetch_assoc($borrows)); }else{ ?>
                            <?php echo 'No Borrows'; }?>
</table>
	
</div>
<!-- lending history -->
<?php }else{ ?>
	<div class="libraryinfo"><h4 class="heading2"><br/><br/><br/>Please Login or Register</h4></div>
<?php } ?>
</div>

<?php include '/mainContent/footer.php';?>

<?php include '/mainContent/scripts.php' ?>


 <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="/assets/js/css3-animate-it.js"></script>
<script src="assets/js/css3-animate-it.js"></script>
</html>