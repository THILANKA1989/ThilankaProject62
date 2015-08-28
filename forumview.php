
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

$idpost = $_GET['id'];
$sel = mysqli_query($connection,"SELECT post from posts WHERE id='$idpost' ");
$selectpost = mysqli_fetch_assoc($sel);


$joined = mysqli_query($connection, "SELECT DISTINCT us.username AS Username,us.firstname AS fname,us.lastname AS lname, pc.profilepic AS Picture, pt.post AS Post, pt.date_added AS DateAdded, pt.id AS ID FROM posts pt
										JOIN user us ON
										us.id=pt.user_id
										JOIN picture pc ON
										pc.user_id = us.id
										WHERE pt.id= '$idpost'
										ORDER BY pt.date_added DESC
										");
$joineduser = mysqli_fetch_assoc($joined);
$then = $joineduser['DateAdded'];
//Convert it into a timestamp.
$then = strtotime($then);
 
//Get the current timestamp.
$now = time();
 
//Calculate the difference.
$difference = $now - $then;
 
//Convert seconds into days.
$days = floor($difference);
if($days>0 & $days<60){
	$days = $days;
	$seconds = 1;
}else if($days>59 & $days<3600){
	$days = floor($difference / (60) );
	$minutes = 1;
}else if($days>3600 & $days<3600*24){
	$days = floor($difference / (60*60) );
	$hours = 1;
}else if($days>3600*24 & $days<3600*24*30){
	$days = floor($difference / (60*60*24) );
	$day = 1;
}else{
	$months = 1;
}


?>

<div class="content">
<div class="memberimage2">
	<div class="pictp">
		<span class="profilepic"><img src="<?php echo $joineduser['Picture']; ?>" class="img-circle" width="100px" height="100px"></span>
	</div>
	<span class="settle"><h4><?php  echo $joineduser['fname']." ".$joineduser['lname']; ?></h4></span>
</div>

	<div class="libraryinfo">
		<p><?php echo $selectpost['post']."<br/>";?></p>
		<span class="pull-right">
			<?php if(isset($seconds)){
					echo $days." "."Seconds ago";
				}else if(isset($minutes)){
					echo $days." "."Minutes ago";
				}else if(isset($hours)){
					echo $days." "."Hours ago";
				}else if(isset($day)){
					echo $days." "."Days ago";
				}else if(isset($months)){
					echo $days." "."Months ago";
				}else{
					echo $joineduser['DateAdded'];
				}
				?>
		</span>

	</div>

	<?php
	$postid = $joineduser['ID'];
	$queryuserget = mysqli_query($connection, "SELECT user_id FROM user_forum_comments WHERE post_id='$postid'");
	$useridcomment = mysqli_fetch_assoc($queryuserget);
	$useridcom = $useridcomment['user_id'];

	
	$commentget = mysqli_query($connection,"SELECT ufc.comment AS Comment, ufc.date_added AS DateAdd, uss.firstname AS fname, uss.lastname AS lname, pic.profilepic AS Picture,pst.id AS postID FROM user_forum_comments ufc
								JOIN user uss
								ON uss.id = ufc.user_id
								JOIN picture pic
								ON pic.user_id = uss.id
								JOIN posts pst
								ON pst.id = ufc.post_id
								WHERE ufc.post_id = '$postid'
								ORDER BY ufc.date_added DESC
								LIMIT 10
								");
	$usercomment = mysqli_fetch_assoc($commentget);
	$numcom = mysqli_num_rows($commentget);
	?>

<?php if($numcom > 0){  ?>
    <?php do { ?>
<div class="container">
           <div class="row  userpost">
            <div class="col-md-2">
                <span class="profilepic"><img src="<?php echo $usercomment['Picture']; ?>" class="img-circle" width="100px" height="100px"></span>
            </div>
            <div class="col-md-10">
                <p><?php  echo $usercomment['fname']." ".$usercomment['lname']; ?></p>
               <span><p><?php echo $usercomment['Comment']; ?></p></span>
            </div>
            <div class="timeposted pull-right  posted"><?php echo $usercomment['DateAdd']; ?></div>
          </div>
        </div>
<?php } while($usercomment=mysqli_fetch_assoc($commentget)); }else{ ?>
        <?php echo 'No Comments'; }?>


<div class="container">
  <div class="row userpost">
    <form method="post" role="form" id="forumform" class="contact-form" row="3" action="process/addforumcomment.php">
                    <div class="row">
                    <span id="errMessage"></span>
                      <div class="col-md-12">
                      <div class="form-group">
                            <textarea class="form-control textarea" rows="3" name="forum" id="forum" placeholder="Post your Comment"></textarea>
                      </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                      <button type="submit" name="submit" id="#submit" class="btn main-btn pull-right">Post</button>
                  </div>
                  </div>
                </form>
  </div>
</div>
		
</div>



<?php include 'mainContent/footer.php';?>




 <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="assets/js/css3-animate-it.js"></script>
</html>


