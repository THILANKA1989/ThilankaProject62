<?php include 'core/init.php' ?>
<?php include 'searchEngine/functions.php' ?>
<!doctype html>
<html lang="en">
<?php include 'mainContent/head.php' ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700,400,600' rel='stylesheet' type='text/css'>
<link href="assets/css/customized.css" rel="stylesheet" media="screen">
<body>


<?php include 'mainContent/header.php'; ?>

<!-- carousel-->
<div id="myCarousel" class="carousel slide">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active animatedParent">
            <img src="assets/images/slide1.jpg">
        </div>
        <div class="item">
            <img src="assets/images/slide2.jpg">
        </div>
        <div class="item">
            <img src="assets/images/slide3.jpg">
        </div>
        <div class="item">
            <img src="assets/images/slide4.jpg">
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
<!--Carousel End -->
<div class="stripblue">
  <h4 class="heading4">Welcome to TMM Library and Hasangasena Youth Club Salawa.</h4>
</div>
<!-- main content -->
<div class="content">
<?php include 'mainContent/titlebar.php' ?>
<!-- user profile -->
<?php
include 'core/functions/checkadmin.php';
if(isset($_SESSION['username'])){
$userpen= $_SESSION['username'];
$selectuser = mysqli_query($connection,"SELECT id FROM user WHERE username = '$userpen'");
$usernameid = mysqli_fetch_assoc($selectuser);


$calculation1 = mysqli_query($connection,"SELECT due_date FROM user_lends_copies WHERE user_id='$usernameid[id]' AND status='open'");
$calculation = mysqli_fetch_assoc($calculation1);
$calcrows = mysqli_num_rows($calculation1);

$getpen = mysqli_query($connection,"SELECT penalty from user WHERE id='$usernameid[id]'");
$getpenaltydb = mysqli_fetch_assoc($getpen);
$getpenaltydbint = (int)$getpenaltydb['penalty'];

$user = $_SESSION['username'];
$userget = mysqli_query($connection,"SELECT * FROM user WHERE username = '$user'");
  $row = mysqli_fetch_assoc($userget);
  $idofuser = mysqli_query($connection,"SELECT id FROM user WHERE username = '$user'");
  $userid = mysqli_fetch_assoc($idofuser);
  $picture = mysqli_query($connection,"SELECT profilepic FROM picture WHERE user_id = '$userid[id]'");
  $picturelink = mysqli_fetch_assoc($picture);

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



if($calcrows>0){
//Calculate the difference.
//Our "then" date.
$then = $calculation['due_date'];
//Convert it into a timestamp.
$then = strtotime($then);

//Get the current timestamp.
$now = time();

//Calculate the difference.
$difference = $now - $then;

//Convert seconds into days.
$day = floor($difference / (60*60*24) );
$days = $day;
}else{
  $days = $getpenaltydbint;
}
}
if(isset($admin)){
  if(isset($_SESSION['username']) & $admin == 0 ){
    $user= $_SESSION['username'];
  $userget = mysqli_query($connection,"SELECT firstname,lastname FROM user WHERE username = '$user'");
  $row = mysqli_fetch_assoc($userget);
  $idofuser = mysqli_query($connection,"SELECT id FROM user WHERE username = '$user'");
  $userid = mysqli_fetch_assoc($idofuser);
  $picture = mysqli_query($connection,"SELECT profilepic FROM picture WHERE user_id = '$userid[id]'");
  $picturelink = mysqli_fetch_assoc($picture);

   $borrows =mysqli_query($connection,"SELECT uc.copy_id AS copyID, uc.user_id AS User,bk.title AS Book, bk.id AS bookID, uc.status AS Status,uc.date_lend AS bdate,uc.due_date AS ddate,uc.id AS ID,bk.isbn AS ISBN
          FROM user_lends_copies uc
          JOIN copies cp ON
            uc.copy_id = cp.id
          JOIN books bk ON
            cp.book_id = bk.id
          WHERE user_id = '$userid[id]'
          ORDER BY bdate DESC");
  $allborrows=mysqli_fetch_assoc($borrows);
  $numrowsbr = mysqli_num_rows($borrows);




  ?>
<!-- summary -->
   <table class="table table-bordered table-responsive tablehide">
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
<!-- borrowedbooks -->

 
  
  <div class="row setmargin">

     <div class="col-lg-3">
    <div class="bestpenalty libraryinfo">
      <div class="memberimage">
        <div class="pictp">
                  <span class="profilepic"><a href="memberview.php?username=<?php echo $_SESSION['username'];?>"><img src="<?php echo $picturelink['profilepic']; ?>" class="img-circle" width="100px" height="100px"></a></span>
              </div>
              <a href="memberview.php?username=<?php echo $_SESSION['username'];?>" class="memberclick"><h4><?php  echo $row['firstname']." ".$row['lastname']; ?></h4></a>
            </div>
            <div class="buttonscontact">
        <button type="button" class="btn btn-success emailmember"><a href="memberview.php?username=<?php echo $_SESSION['username'];?>" class="memberclick">View Profile</a></button>
        <button type="button" class="btn btn-success viewmember"><a href="editprofile.php?username=<?php echo $_SESSION['username'];?>" id="#my_modal" target-data="#my_modal">Edit Profile</a></button>
            </div>
    </div>
    <h4 class="libraryinfo2"><?php echo $_SESSION['username'];?></h4>
  </div>
     <div class="col-lg-9">
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
      </div>
    
  </div>
<br/>

<!-- user profile -->

<?php }
} ?>
<?php
if(isset($admin)){
if($admin == 1){
 ?>
    <div class="row">
      <div class="col-md-12">
        <a href="admin/index.php"><h4  class="longbutton">Go to Dashboard</h4></a>
      </div>
    </div>
    <?php

}
}
?>

<!-- admin notice and calender -->
<div class="libraryinfo">
  <div class="row">
    <div class="col-md-3 padset within">
     <h4 class="titlestrip"><strong>TMML Library</strong></h4>
     <p><strong>Thiroma Madhurangani memorial Library</strong> is a rural Library
     It is situated in <strong>Ranavirugama</strong> which is a scheme opened in year 2002
     <strong>specially for families of Army soldiers who disabled or lost their lives</strong>
     <br/>
     We have a <strong>youth club called hasngasena</strong> and a small library. This website was created to inform you about us and
      and take your help to development of our library.
      We <strong>hope more help from you to develop this library.</strong></p>
    </div>
    <div class="col-md-3 padset within">
     <h4 class="titlestrip"><strong>Hasanga Sena Youth Club</strong></h4>
     <p>
      Our <strong>youth club is responsible for the maintanance of library, Organizing events of our village and serve people activiely who are disables in our village.</strong>
      we are currently connected to <strong>Sri Lankan Youth.</strong> We are organized as a youthclub in<strong> 2015 </strong>. We have
      Deligates to maintain several areas. And we have a<strong> sports club also called "Warriors United".</strong> We have won big events in this region as a sport club. And we served lot of people who need help.
    </div>
    <div class="col-md-3 padset within">
     <h4 class="titlestrip"><strong>Our Computer Unit</strong></h4>
     <p>We have <strong>only 3 computers </strong> in our <strong>IT center</strong>. Despite we have lack of resources we are able to educate our younger sisters and brothers with it. The creator of this web site, and our fellow member is currently working as the computer instructure for this village children
     We has done lot of service. And we hope some help with computer resources. The Ranaviru Sewa Authority donated us cutrrent computers to our library and computer unit.</p>
    </div>
    <div class="col-md-3 padset within last-within">
     <h4 class="titlestrip"><strong>Our resources</strong></h4>
     <p>In our library we have only 300+ books and its not sufficient for us. And in our computer unit we have only 3 computers. But we were able to make lot of use from this resources.
     We need to <strong>train the Children of our village</strong> to survive in a competitive  environment. This website is to make kids familliar with books and
     enhance their keeness in using our rural library. And we have a montessori and dancing acedamy also. All that users need to get the use of our library.
     </p>
    </div>
  </div>
</div>


<!-- admin notice and calender -->
<!--spotlight -->
<section class="spotlight animatedParent" data-appear-top-offset='-30' data-sequence='500'>
   <h3 class="section-title"><i class="fa fa-diamond animatedbounceIn"></i> Latest Additions</h3>
   <div class="row">
 <div class="jumbo">

       <?php if($tot_rows > 0){  ?>
       <?php do { ?>

           <div class="col-md-3 animatedbounceIn">
               <span class="product-image">
                  <?php $isbnget = $rows['ISBN']; ?>
                   <a href="bookview.php?bookisbn=<?php echo $isbnget;  ?>" id="bookid"><img src="<?php echo $rows['Cover'] ?>" class="img-thumbnail product-img" alt=""></a>
                </span>
                   <ul class="iteminfo">
                        <li class="animated fadeInLeftShort" data-id='1'><strong>Title: </strong><?php echo $rows['Title'] ?></li>
                        <li class="animated fadeInLeftShort" data-id='1'><strong>Category: </strong><?php echo $rows['Category'] ?></li>
                        <li class="animated fadeInLeftShort" data-id='2'><strong>Author: </strong><a href="authorview.php?authorname=<?php echo $rows['Author']; ?>"><?php echo $rows['Author']; ?></a></li>
                        <li class="animated fadeInLeftShort" data-id='3'><strong>ISBN: </strong><?php echo $rows['ISBN'] ?></li>
                        <li class="animated fadeInLeftShort" data-id='3'><strong>Copies: </strong><?php echo $rows['Copies'] ?></li>
                  </ul>
            </div>

        <?php } while($rows=mysqli_fetch_assoc($rs)); }else{ ?>
        <?php echo 'No Results'; }?>
       </div>

</section>

<!--spotlight -->


<!--forum-->
<section class="forum-posts">
<h3 class="setion-title"><i class="fa fa-comments-o"></i> Posts and News</h3>
  <div class="dashboard">
    <div class="row animatedParent">
        <div class="col-md-8 posts animated fadeInLeft">
          <?php
$query = "SELECT DISTINCT pc.profilepic As Picture, us.username As Username, pst.date_added As Date, pst.post As Post,pst.id AS ID FROM posts pst JOIN picture pc ON pc.user_id = pst.user_id JOIN user us ON us.id = pst.user_id ORDER BY pst.date_added DESC";
$showq = mysqli_query($connection,$query);
$rows = mysqli_fetch_assoc($showq);
$numrows = mysqli_num_rows($showq);
$posted_time = $rows['Date'];
$count=0;
$dt = time();
$datetime = strftime("%Y-%m-%d %H:%M:%S", $dt);

?>
<?php if($numrows > 0){  ?>
    <?php do { ?>

          <div class="container">
           <div class="row  userpost">
            <div class="col-md-2">
                <span class="profilepic"><img src="<?php echo $rows['Picture']; ?>" class="img-circle" width="100px" height="100px"></span>
            </div>
            <div class="col-md-10">
                <p><?php echo $rows['Username']; ?></p>
               <span><p><a href="#" class="forumpost_text"><a href="forumview.php?id=<?php echo $rows['ID']; ?>" class="forumlink"><?php echo $rows['Post']; ?></a></p></span>
            </div>
            <div class="timeposted pull-right  posted"><?php echo $rows['Date']; ?></div>
          </div>
        </div>
<?php } while($rows=mysqli_fetch_assoc($showq)); }else{ ?>
        <?php echo 'No Posts'; }?>

        </div>
        <div class="col-md-4 news animated fadeInRight">
            <div class="Notice">

              <a  data-chrome="nofooter transparent" class="twitter-timeline" href="https://twitter.com/hasangasena" data-widget-id="595118627147239424">Tweets by @hasangasena</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

            </div>
        </div>

    </div>
  </div>
</section>
<!--forum-->

</div>
<!-- main content -->
<?php include 'mainContent/footer.php';?>




 <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="assets/js/css3-animate-it.js"></script>
</html>
