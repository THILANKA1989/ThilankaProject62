<?php include '/core/init.php' ?>
<?php?>
<?php include '/searchEngine/functions.php' ?>
<!doctype html>
<html lang="en">
<?php include '/mainContent/head.php' ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700,400,600' rel='stylesheet' type='text/css'>
<link href="assets/css/customized.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<body>


<?php include '/mainContent/header.php' ?>

<div class="content">




<?php   $isbn = $_GET['bookisbn'];
 ?>

  <?php

$sample_rate = 100;
if(mt_rand(1,$sample_rate) == 1) {
    $query = mysql_query(" UPDATE books SET views = views + $sample_rate WHERE isbn = '$isbn' ");
    $getviews = mysqli_query($connection,"SELECT views FROM books WHERE isbn = '$isbn'");
    $view = mysqli_fetch_assoc($getviews);
    $views = $view['views'];

}else{
  $views = "N/A";
}

$connect_error='Sorry, something Error';
$connection=mysqli_connect("localhost","root","") or die($connect_error);
mysqli_select_db($connection,'library') or die($connect_error);
$rs = mysqli_query($connection,"SELECT DISTINCT bk.title As Title, YEAR(bk.date_released) AS Year, bk.price AS Price, cat.name AS Category, pub.name AS Publisher, aut.name AS Author,co.name AS Cover, cp.count AS Copies,bk.isbn AS ISBN, bk.description AS Description,bk.id AS ID,loc.name AS Location
        FROM books bk
                JOIN (SELECT book_id, COUNT(*) as count FROM copies GROUP BY book_id) cp
                  ON bk.id = cp.book_id
        JOIN category cat
          ON cat.id = bk.category_id
        JOIN publishers pub
                  ON pub.id = bk.publisher_id
        JOIN books_covers bk_co
          ON bk_co.book_id = bk.id
        JOIN covers co
          ON co.id = bk_co.cover_id
        JOIN books_authors bk_aut
          ON bk_aut.book_id = bk.id
        JOIN authors aut
          ON aut.id = bk_aut.author_id
        JOIN books_languages bk_lan
          ON bk_lan.book_id = bk.id
        JOIN languages lan
          ON lan.id = bk_lan.lang_id
        JOIN books_locations bk_loc
          ON bk_loc.book_id = bk.id
        JOIN locations loc
          ON loc.id = bk_loc.location_id
        WHERE bk.isbn = '$isbn'
          ");

    $sqlbookrows = mysqli_fetch_assoc($rs);
     $idbook = $sqlbookrows['ID'];
    $countavailable = mysqli_query($connection,"SELECT DISTINCT copy_id, COUNT(*) as countcp, uc.copy_id AS CopyID, bk.id AS bookID, cp.id AS cid FROM user_lends_copies AS uc JOIN copies cp ON cp.id = uc.copy_id JOIN books bk ON bk.id = cp.book_id WHERE status='open' AND bk.id ='$idbook'");
$countcp = mysqli_fetch_assoc($countavailable);
  ?>


<div class="row libraryinfo">
  <div class="col-md-4">
    <div class="coverimage">
      <img src="<?php echo $sqlbookrows['Cover']; ?>" class="img-thumbnail product-img" alt="coverimage">
    </div>
  </div>
  <div class="col-md-8">
    <div class="bookinfo">
      <h3 class="headingbook"><?php echo $sqlbookrows['Title']; ?></h3>
      <?php
      include 'core/functions/checkadmin.php';
      ?>
      <?php
      if(isset($admin)){
          if($admin == 1){ ?>
              <button type="button" class="btn btn-success viewmemberedit"><a href="editbook.php?username=<?php echo $sqlbookrows['ISBN']; ?>" id="#my_modal" target-data="#my_modal">Edit Book</a></button>
        <?php }
      } ?>
       <div class="bookinfolist">
                     <ul class="listbook" style="zoom: 1.1;">
                          <li><strong>Title: </strong><?php echo $sqlbookrows['Title']; ?></li>
                          <li><strong>Category: </strong><a href="categoryview.php?catid=<?php echo $sqlbookrows['Category'];?>"><?php echo $sqlbookrows['Category']; ?></a></li>
                          <li><strong>Author: </strong><?php echo $sqlbookrows['Author']; ?></li>
                          <li><strong>ISBN: </strong><?php echo $sqlbookrows['ISBN']; ?></li>
                          <li><strong>Year: </strong><?php echo $sqlbookrows['Year']; ?></li>
                          <li><strong>Price: </strong><?php echo $sqlbookrows['Price']; ?></li>
                          <li><strong>Publisher: </strong><?php echo $sqlbookrows['Publisher'] ?></li>
                          <li><strong>Book ID: </strong><?php echo $sqlbookrows['ID'];?></li>
                          <li><strong>Copies: </strong><?php echo $sqlbookrows['Copies'];?></li>
                    </ul>
                </div>
    </div>

  </div>

</div>
<!-- end of book info panel -->
<!-- description -->
<div class="row libraryinfo">
  <div class="col-md-6">
   <div class="desciptbook">
      <strong>Description: </strong><p><?php  echo $sqlbookrows['Description']; ?></p>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-3">
      </div>
      <div class="col-md-3">
      </div>
       <div class="col-md-3">
        <button onclick="saveData()" name="like" class="btn btn-success dashaddnews"><i class="fa fa-thumbs-o-up fa-2"></i> Like</button>
      </div>
    </div>
  </div>
</div>

<!-- description -->

<!-- views availibility -->
<div class="row libraryinfo">
  <div class="col-md-4">
      <p class="heading2">
<?php if($countcp['countcp'] < $sqlbookrows['Copies']){
      echo 'Available';
       }else{
      echo 'Unavailable';
        } ?>
   </p>
  </div>
  <div class="col-md-4">
    <p class="heading2"><?php echo $sqlbookrows['Location']; ?></p>
  </div>
  <div class="col-md-4">
    <p class="heading2">5 Likes</p>
  </div>
</div>
<!-- views availibility -->
<!-- related -->
<?php
$cat = $sqlbookrows['Category'];
$notisbn = $sqlbookrows['ISBN'];
$rsc = mysqli_query($connection,"SELECT DISTINCT bk.title As Title, YEAR(bk.date_released) AS Year, bk.price AS Price, cat.name AS Category, pub.name AS Publisher, aut.name AS Author,co.name AS Cover, cp.count AS Copies,bk.isbn AS ISBN
        FROM books bk
                JOIN (SELECT book_id, COUNT(*) as count FROM copies GROUP BY book_id) cp
                  ON bk.id = cp.book_id
        JOIN category cat
          ON cat.id = bk.category_id
        JOIN publishers pub
                  ON pub.id = bk.publisher_id
        JOIN books_covers bk_co
          ON bk_co.book_id = bk.id
        JOIN covers co
          ON co.id = bk_co.cover_id
        JOIN books_authors bk_aut
          ON bk_aut.book_id = bk.id
        JOIN authors aut
          ON aut.id = bk_aut.author_id
        JOIN books_languages bk_lan
          ON bk_lan.book_id = bk.id
        JOIN languages lan
          ON lan.id = bk_lan.lang_id
        JOIN books_locations bk_loc
          ON bk_loc.book_id = bk.id
        JOIN locations loc
          ON loc.id = bk_loc.location_id
        WHERE cat.name = '$cat' AND bk.isbn != '$notisbn'
        ORDER BY bk.title ASC LIMIT 4
          ");
   ?>



<div class="row libraryinfo">
  <?php   $sqlbookc = mysqli_fetch_assoc($rsc);
    $tot_rows = mysqli_num_rows($rsc);
    ?>
   <section class="spotlight animatedParent" data-appear-top-offset='-30' data-sequence='500'>
   <h3 class="section-title"><i class="fa fa-diamond animatedbounceIn"></i> Related Books</h3>
   <div class="row">
 <div class="jumbo">
     <?php if($tot_rows > 0){  ?>
       <?php do { ?>


           <div class="col-md-3 animatedbounceIn">
               <span class="product-image">
                  <?php $isbnget = $sqlbookc['ISBN']; ?>
                   <a href="bookview.php?bookisbn=<?php echo $isbnget;  ?>" id="bookid"><img src="<?php echo $sqlbookc['Cover'] ?>" class="img-thumbnail product-img" alt=""></a>
                </span>
                   <ul class="iteminfo">
                        <li class="animated fadeInLeftShort" data-id='1'><strong>Title: </strong><?php echo $sqlbookc['Title'] ?></li>
                        <li class="animated fadeInLeftShort" data-id='1'><strong>Category: </strong><a href="categoryview.php?catid=<?php echo $sqlbookc['Category'];?>"><?php echo $sqlbookc['Category'] ?></a></li>
                        <li class="animated fadeInLeftShort" data-id='2'><strong>Author: </strong><?php echo $sqlbookc['Author'] ?></li>
                        <li class="animated fadeInLeftShort" data-id='3'><strong>ISBN: </strong><?php echo $sqlbookc['ISBN'] ?></li>
                        <li class="animated fadeInLeftShort" data-id='3'><strong>Copies: </strong><?php echo $sqlbookc['Copies'] ?></li>
                  </ul>
             </div>
        <?php } while($sqlbookc=mysqli_fetch_assoc($rsc)); }else{ ?>
        <?php echo 'No Results'; }?>

         </div>
         </div>
        </section>
</div>
<!-- related -->

<!-- copies -->
<?php

$rscp = mysqli_query($connection,"SELECT DISTINCT bk.title As Title, YEAR(bk.date_released) AS Year, bk.price AS Price, cat.name AS Category, pub.name AS Publisher, aut.name AS Author, bk.isbn AS ISBN, cp.id AS CopyID, bk.id AS bookID, DATE_FORMAT(cp.date_added,'%Y %D %M %h:%i:%s') AS DateAdded
        FROM copies cp
                JOIN books bk
                  ON bk.id = cp.book_id
        JOIN category cat
          ON cat.id = bk.category_id
        JOIN publishers pub
                  ON pub.id = bk.publisher_id
        JOIN books_covers bk_co
          ON bk_co.book_id = bk.id
        JOIN books_authors bk_aut
          ON bk_aut.book_id = bk.id
        JOIN authors aut
          ON aut.id = bk_aut.author_id
        JOIN books_languages bk_lan
          ON bk_lan.book_id = bk.id
        JOIN languages lan
          ON lan.id = bk_lan.lang_id
        JOIN books_locations bk_loc
          ON bk_loc.book_id = bk.id
        JOIN locations loc
          ON loc.id = bk_loc.location_id
        WHERE bk.isbn = '$isbn'
        ORDER BY cp.id ASC
          ");
      $rowscp = mysqli_fetch_assoc($rscp);
      $numrowscp = mysqli_num_rows($rscp);


?>
<div class="row libraryinfo">
  <h4>List of Copies of <?php echo $sqlbookrows['Title']; ?></h4>
 <table class="table table-bordered table-responsive">
          <th>
            <td>Title</td>
            <td>Book ID</td>
            <td>Author</td>
            <td>Category</td>
            <td>Price</td>
            <td>Added Time</td>
            <td>Publisher</td>
            <td>Published Year</td>
          </th>
          <?php if($numrowscp > 0){  ?>
                        <?php do { ?>
          <tr>
            <td><?php echo $rowscp['CopyID'];?></td>
            <td><?php echo $rowscp['Title'];?></td>
            <td><?php echo $rowscp['bookID'];?></td>
            <td><?php echo $rowscp['Author'];?></td>
            <td><a href="categoryview.php?catid=<?php echo $rowscp['Category'];?>"><?php echo $rowscp['Category'];?></a></td>
            <td><?php echo $rowscp['Price'];?></td>
            <td><?php echo $rowscp['DateAdded'];?></td>
            <td><?php echo $rowscp['Publisher'];?></td>
            <td><?php echo $rowscp['Year'];?></td>
</tr>
<?php } while($rowscp=mysqli_fetch_assoc($rscp)); }else{ ?>
                            <?php echo 'No Books'; }?>
</table>
</div>


<!-- copies -->
</div>
<!-- main content -->
<?php include '/mainContent/footer.php';?>

<?php include '/mainContent/scripts.php' ?>


 <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="/assets/js/css3-animate-it.js"></script>
<script src="assets/js/css3-animate-it.js"></script>
</html>
<script>
  function saveData(){
      $.ajax({
        type: "POST",
        url: "your_php_page.php",
        data: { name: $("select[name='players']").val()},
        success:function( msg ) {
         alert( "Data Saved: " + msg );
        }
       });
  }
  
</script>