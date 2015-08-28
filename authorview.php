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


    $author= $_GET['authorname'];
  $authorget = mysqli_query($connection,"SELECT * FROM authors WHERE name = '$author'");
  $row = mysqli_fetch_assoc($authorget);

  $borrows =mysqli_query($connection,"SELECT DISTINCT au.name AS Name, au.description AS Description,au.id AS ID, bu.book_id AS BookID, bk.title AS Book,bk.isbn AS ISBN,cat.name AS Category, bk.date_added AS dateadded FROM authors au JOIN books_authors bu ON bu.author_id = au.id JOIN books bk ON bk.id = bu.book_id
    JOIN category cat ON
    bk.category_id = cat.id
    WHERE au.id = '$row[id]' ");
  $allborrows=mysqli_fetch_assoc($borrows);
  $numrowsbr = mysqli_num_rows($borrows); ?>


<div class="content">
<!-- profile info basic -->
<div class="row libraryinfo">
    <div class="col-md-4">
        <div class="profileimage">
              <img src="<?php echo $row['picture']; ?>" >
              <h4 class="heading3 headingbook"><?php  echo $row['name'];  ?></h4>
        </div>
     </div>
     <div class="col-md-8">
      <div class="bookinfo" style="height: 450px !important">
         <h3 class="headingbook"><?php echo $row['name']; ?></h3>
       <div class="bookinfolist">
          <ul class="listbook" style="zoom: 1.1;">
              <li><strong>Name: </strong><?php echo  $allborrows['Name']; ?></li>
              <li><strong>Description: </strong><?php echo  $allborrows['Description']; ?></li>
              <li><strong>ID: </strong><?php echo  $allborrows['ID']; ?></li>
              <li><strong>Number of Books: </strong><?php echo   $numrowsbr; ?></li>
          </ul>

      </div>
     </div>
  </div>
  </div>
<!-- profile info basic -->
<!-- related -->
<?php

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
        WHERE aut.id = '$row[id]'
        ORDER BY bk.date_released DESC LIMIT 4
          ");
   ?>
 


<div class="row libraryinfo">
  <?php   $sqlbookc = mysqli_fetch_assoc($rsc);
    $tot_rows = mysqli_num_rows($rsc); 
    ?>
   <section class="spotlight animatedParent" data-appear-top-offset='-30' data-sequence='500'>
   <h3 class="section-title"><i class="fa fa-diamond animatedbounceIn"></i> Latest Books of this Author</h3>
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
                        <li class="animated fadeInLeftShort" data-id='1'><strong>Category: </strong><?php echo $sqlbookc['Category'] ?></li>
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
<!--list of books-->
<div class="row libraryinfo">
  <h4>List of Books of <?php echo $row['name']; ?></h4>
 <table class="table table-bordered table-responsive">
          <th>
            <td>Title</td>
            <td>ISBN</td>
            <td>Author</td>
            <td>AuthorID</td>
            <td>Category</td>
            <td>Added Time</td>
          </th>
          <?php if($numrowsbr > 0){  ?>
                        <?php do { ?>
          <tr>
            <td><?php echo $allborrows['BookID'];?></td>
            <td><a href="bookview.php?bookisbn=<?php echo $allborrows['ISBN'];  ?>" ><?php echo $allborrows['Book'];?></a></td>
            <td><?php echo $allborrows['ISBN'];?></td>
            <td><?php echo $allborrows['Name'];?></td>
            <td><?php echo $allborrows['ID'];?></td>
            <td><?php echo $allborrows['Category'];?></td>
            <td><?php echo $allborrows['dateadded'];?></td>
            
</tr>
<?php } while($allborrows=mysqli_fetch_assoc($borrows)); }else{ ?>
                            <?php echo 'No Books'; }?>
</table>
</div>
<!-- list of books -->
</div>

<?php include 'mainContent/footer.php';?>




 <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="assets/js/css3-animate-it.js"></script>
</html>